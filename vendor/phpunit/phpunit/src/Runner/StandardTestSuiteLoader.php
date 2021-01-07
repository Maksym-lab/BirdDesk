<?php
class PHPUnit_Runner_StandardTestSuiteLoader implements PHPUnit_Runner_TestSuiteLoader
{
    public function load($suiteClassName, $suiteClassFile = '')
    {
        $suiteClassName = str_replace('.php', '', $suiteClassName);
        if (empty($suiteClassFile)) {
            $suiteClassFile = PHPUnit_Util_Filesystem::classNameToFilename(
                $suiteClassName
            );
        }
        if (!class_exists($suiteClassName, false)) {
            $loadedClasses = get_declared_classes();
            $filename = PHPUnit_Util_Fileloader::checkAndLoad($suiteClassFile);
            $loadedClasses = array_values(
                array_diff(get_declared_classes(), $loadedClasses)
            );
        }
        if (!class_exists($suiteClassName, false) && !empty($loadedClasses)) {
            $offset = 0 - strlen($suiteClassName);
            foreach ($loadedClasses as $loadedClass) {
                $class = new ReflectionClass($loadedClass);
                if (substr($loadedClass, $offset) === $suiteClassName &&
                    $class->getFileName() == $filename) {
                    $suiteClassName = $loadedClass;
                    break;
                }
            }
        }
        if (!class_exists($suiteClassName, false) && !empty($loadedClasses)) {
            $testCaseClass = 'PHPUnit_Framework_TestCase';
            foreach ($loadedClasses as $loadedClass) {
                $class     = new ReflectionClass($loadedClass);
                $classFile = $class->getFileName();
                if ($class->isSubclassOf($testCaseClass) &&
                    !$class->isAbstract()) {
                    $suiteClassName = $loadedClass;
                    $testCaseClass  = $loadedClass;
                    if ($classFile == realpath($suiteClassFile)) {
                        break;
                    }
                }
                if ($class->hasMethod('suite')) {
                    $method = $class->getMethod('suite');
                    if (!$method->isAbstract() &&
                        $method->isPublic() &&
                        $method->isStatic()) {
                        $suiteClassName = $loadedClass;
                        if ($classFile == realpath($suiteClassFile)) {
                            break;
                        }
                    }
                }
            }
        }
        if (class_exists($suiteClassName, false)) {
            $class = new ReflectionClass($suiteClassName);
            if ($class->getFileName() == realpath($suiteClassFile)) {
                return $class;
            }
        }
        throw new PHPUnit_Framework_Exception(
            sprintf(
                "Class '%s' could not be found in '%s'.",
                $suiteClassName,
                $suiteClassFile
            )
        );
    }
    public function reload(ReflectionClass $aClass)
    {
        return $aClass;
    }
}