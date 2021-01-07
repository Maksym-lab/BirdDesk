<?php
class PHP_CodeCoverage_Report_XML_Project extends PHP_CodeCoverage_Report_XML_Node
{
    public function __construct($name)
    {
        $this->init();
        $this->setProjectName($name);
    }
    private function init()
    {
        $dom = new DOMDocument;
        $dom->loadXML('<?xml version="1.0" ?><phpunit xmlns="http:
        $this->setContextNode(
            $dom->getElementsByTagNameNS(
                'http:
                'project'
            )->item(0)
        );
    }
    private function setProjectName($name)
    {
        $this->getContextNode()->setAttribute('name', $name);
    }
    public function getTests()
    {
        $testsNode = $this->getContextNode()->getElementsByTagNameNS(
            'http:
            'tests'
        )->item(0);
        if (!$testsNode) {
            $testsNode = $this->getContextNode()->appendChild(
                $this->getDom()->createElementNS(
                    'http:
                    'tests'
                )
            );
        }
        return new PHP_CodeCoverage_Report_XML_Tests($testsNode);
    }
    public function asDom()
    {
        return $this->getDom();
    }
}