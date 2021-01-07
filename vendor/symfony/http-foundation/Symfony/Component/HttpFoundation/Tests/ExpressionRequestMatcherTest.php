<?php
namespace Symfony\Component\HttpFoundation\Tests;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\HttpFoundation\ExpressionRequestMatcher;
use Symfony\Component\HttpFoundation\Request;
class ExpressionRequestMatcherTest extends \PHPUnit_Framework_TestCase
{
    public function testWhenNoExpressionIsSet()
    {
        $expressionRequestMatcher = new ExpressionRequestMatcher();
        $expressionRequestMatcher->matches(new Request());
    }
    public function testMatchesWhenParentMatchesIsTrue($expression, $expected)
    {
        $request = Request::create('/foo');
        $expressionRequestMatcher = new ExpressionRequestMatcher();
        $expressionRequestMatcher->setExpression(new ExpressionLanguage(), $expression);
        $this->assertSame($expected, $expressionRequestMatcher->matches($request));
    }
    public function testMatchesWhenParentMatchesIsFalse($expression)
    {
        $request = Request::create('/foo');
        $request->attributes->set('foo', 'foo');
        $expressionRequestMatcher = new ExpressionRequestMatcher();
        $expressionRequestMatcher->matchAttribute('foo', 'bar');
        $expressionRequestMatcher->setExpression(new ExpressionLanguage(), $expression);
        $this->assertFalse($expressionRequestMatcher->matches($request));
    }
    public function provideExpressions()
    {
        return array(
            array('request.getMethod() == method', true),
            array('request.getPathInfo() == path', true),
            array('request.getHost() == host', true),
            array('request.getClientIp() == ip', true),
            array('request.attributes.all() == attributes', true),
            array('request.getMethod() == method && request.getPathInfo() == path && request.getHost() == host && request.getClientIp() == ip &&  request.attributes.all() == attributes', true),
            array('request.getMethod() != method', false),
            array('request.getMethod() != method && request.getPathInfo() == path && request.getHost() == host && request.getClientIp() == ip &&  request.attributes.all() == attributes', false),
        );
    }
}
