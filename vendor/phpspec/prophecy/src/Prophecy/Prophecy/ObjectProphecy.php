<?php
namespace Prophecy\Prophecy;
use SebastianBergmann\Comparator\ComparisonFailure;
use Prophecy\Comparator\Factory as ComparatorFactory;
use Prophecy\Call\Call;
use Prophecy\Doubler\LazyDouble;
use Prophecy\Argument\ArgumentsWildcard;
use Prophecy\Call\CallCenter;
use Prophecy\Exception\Prophecy\ObjectProphecyException;
use Prophecy\Exception\Prophecy\MethodProphecyException;
use Prophecy\Exception\Prediction\AggregateException;
use Prophecy\Exception\Prediction\PredictionException;
class ObjectProphecy implements ProphecyInterface
{
    private $lazyDouble;
    private $callCenter;
    private $revealer;
    private $comparatorFactory;
    private $methodProphecies = array();
    public function __construct(
        LazyDouble $lazyDouble,
        CallCenter $callCenter = null,
        RevealerInterface $revealer = null,
        ComparatorFactory $comparatorFactory = null
    ) {
        $this->lazyDouble = $lazyDouble;
        $this->callCenter = $callCenter ?: new CallCenter;
        $this->revealer   = $revealer ?: new Revealer;
        $this->comparatorFactory = $comparatorFactory ?: ComparatorFactory::getInstance();
    }
    public function willExtend($class)
    {
        $this->lazyDouble->setParentClass($class);
        return $this;
    }
    public function willImplement($interface)
    {
        $this->lazyDouble->addInterface($interface);
        return $this;
    }
    public function willBeConstructedWith(array $arguments = null)
    {
        $this->lazyDouble->setArguments($arguments);
        return $this;
    }
    public function reveal()
    {
        $double = $this->lazyDouble->getInstance();
        if (null === $double || !$double instanceof ProphecySubjectInterface) {
            throw new ObjectProphecyException(
                "Generated double must implement ProphecySubjectInterface, but it does not.\n".
                'It seems you have wrongly configured doubler without required ClassPatch.',
                $this
            );
        }
        $double->setProphecy($this);
        return $double;
    }
    public function addMethodProphecy(MethodProphecy $methodProphecy)
    {
        $argumentsWildcard = $methodProphecy->getArgumentsWildcard();
        if (null === $argumentsWildcard) {
            throw new MethodProphecyException(sprintf(
                "Can not add prophecy for a method `%s::%s()`\n".
                "as you did not specify arguments wildcard for it.",
                get_class($this->reveal()),
                $methodProphecy->getMethodName()
            ), $methodProphecy);
        }
        $methodName = $methodProphecy->getMethodName();
        if (!isset($this->methodProphecies[$methodName])) {
            $this->methodProphecies[$methodName] = array();
        }
        $this->methodProphecies[$methodName][] = $methodProphecy;
    }
    public function getMethodProphecies($methodName = null)
    {
        if (null === $methodName) {
            return $this->methodProphecies;
        }
        if (!isset($this->methodProphecies[$methodName])) {
            return array();
        }
        return $this->methodProphecies[$methodName];
    }
    public function makeProphecyMethodCall($methodName, array $arguments)
    {
        $arguments = $this->revealer->reveal($arguments);
        $return    = $this->callCenter->makeCall($this, $methodName, $arguments);
        return $this->revealer->reveal($return);
    }
    public function findProphecyMethodCalls($methodName, ArgumentsWildcard $wildcard)
    {
        return $this->callCenter->findCalls($methodName, $wildcard);
    }
    public function checkProphecyMethodsPredictions()
    {
        $exception = new AggregateException(sprintf("%s:\n", get_class($this->reveal())));
        $exception->setObjectProphecy($this);
        foreach ($this->methodProphecies as $prophecies) {
            foreach ($prophecies as $prophecy) {
                try {
                    $prophecy->checkPrediction();
                } catch (PredictionException $e) {
                    $exception->append($e);
                }
            }
        }
        if (count($exception->getExceptions())) {
            throw $exception;
        }
    }
    public function __call($methodName, array $arguments)
    {
        $arguments = new ArgumentsWildcard($this->revealer->reveal($arguments));
        foreach ($this->getMethodProphecies($methodName) as $prophecy) {
            $argumentsWildcard = $prophecy->getArgumentsWildcard();
            $comparator = $this->comparatorFactory->getComparatorFor(
                $argumentsWildcard, $arguments
            );
            try {
                $comparator->assertEquals($argumentsWildcard, $arguments);
                return $prophecy;
            } catch (ComparisonFailure $failure) {}
        }
        return new MethodProphecy($this, $methodName, $arguments);
    }
    public function __get($name)
    {
        return $this->reveal()->$name;
    }
    public function __set($name, $value)
    {
        $this->reveal()->$name = $this->revealer->reveal($value);
    }
}