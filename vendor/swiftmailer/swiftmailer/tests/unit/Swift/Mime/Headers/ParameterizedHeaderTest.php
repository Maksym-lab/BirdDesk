<?php
class Swift_Mime_Headers_ParameterizedHeaderTest extends \SwiftMailerTestCase
{
    private $_charset = 'utf-8';
    private $_lang = 'en-us';
    public function testTypeIsParameterizedHeader()
    {
        $header = $this->_getHeader('Content-Type',
            $this->_getHeaderEncoder('Q', true), $this->_getParameterEncoder(true)
            );
        $this->assertEquals(Swift_Mime_Header::TYPE_PARAMETERIZED, $header->getFieldType());
    }
    public function testValueIsReturnedVerbatim()
    {
        $header = $this->_getHeader('Content-Type',
            $this->_getHeaderEncoder('Q', true), $this->_getParameterEncoder(true)
            );
        $header->setValue('text/plain');
        $this->assertEquals('text/plain', $header->getValue());
    }
    public function testParametersAreAppended()
    {
        $header = $this->_getHeader('Content-Type',
            $this->_getHeaderEncoder('Q', true), $this->_getParameterEncoder(true)
            );
        $header->setValue('text/plain');
        $header->setParameters(array('charset' => 'utf-8'));
        $this->assertEquals('text/plain; charset=utf-8', $header->getFieldBody());
    }
    public function testSpaceInParamResultsInQuotedString()
    {
        $header = $this->_getHeader('Content-Disposition',
            $this->_getHeaderEncoder('Q', true), $this->_getParameterEncoder(true)
            );
        $header->setValue('attachment');
        $header->setParameters(array('filename' => 'my file.txt'));
        $this->assertEquals('attachment; filename="my file.txt"',
            $header->getFieldBody()
            );
    }
    public function testLongParamsAreBrokenIntoMultipleAttributeStrings()
    {
        $value = str_repeat('a', 180);
        $encoder = $this->_getParameterEncoder();
        $encoder->shouldReceive('encodeString')
                ->once()
                ->with($value, \Mockery::any(), 63, \Mockery::any())
                ->andReturn(str_repeat('a', 63)."\r\n".
                    str_repeat('a', 63)."\r\n".str_repeat('a', 54));
        $header = $this->_getHeader('Content-Disposition',
            $this->_getHeaderEncoder('Q', true), $encoder
            );
        $header->setValue('attachment');
        $header->setParameters(array('filename' => $value));
        $header->setMaxLineLength(78);
        $this->assertEquals(
            'attachment; '.
            'filename*0*=utf-8\'\''.str_repeat('a', 63).";\r\n ".
            'filename*1*='.str_repeat('a', 63).";\r\n ".
            'filename*2*='.str_repeat('a', 54),
            $header->getFieldBody()
            );
    }
    public function testEncodedParamDataIncludesCharsetAndLanguage()
    {
        $value = str_repeat('a', 20).pack('C', 0x8F).str_repeat('a', 10);
        $encoder = $this->_getParameterEncoder();
        $encoder->shouldReceive('encodeString')
                ->once()
                ->with($value, 12, 62, \Mockery::any())
                ->andReturn(str_repeat('a', 20).'%8F'.str_repeat('a', 10));
        $header = $this->_getHeader('Content-Disposition',
            $this->_getHeaderEncoder('Q', true), $encoder
            );
        $header->setValue('attachment');
        $header->setParameters(array('filename' => $value));
        $header->setMaxLineLength(78);
        $header->setLanguage($this->_lang);
        $this->assertEquals(
            'attachment; filename*='.$this->_charset."'".$this->_lang."'".
            str_repeat('a', 20).'%8F'.str_repeat('a', 10),
            $header->getFieldBody()
            );
    }
    public function testMultipleEncodedParamLinesAreFormattedCorrectly()
    {
        $value = str_repeat('a', 20).pack('C', 0x8F).str_repeat('a', 60);
        $encoder = $this->_getParameterEncoder();
        $encoder->shouldReceive('encodeString')
                ->once()
                ->with($value, 12, 62, \Mockery::any())
                ->andReturn(str_repeat('a', 20).'%8F'.str_repeat('a', 28)."\r\n".
                    str_repeat('a', 32));
        $header = $this->_getHeader('Content-Disposition',
            $this->_getHeaderEncoder('Q', true), $encoder
            );
        $header->setValue('attachment');
        $header->setParameters(array('filename' => $value));
        $header->setMaxLineLength(78);
        $header->setLanguage($this->_lang);
        $this->assertEquals(
            'attachment; filename*0*='.$this->_charset."'".$this->_lang."'".
            str_repeat('a', 20).'%8F'.str_repeat('a', 28).";\r\n ".
            'filename*1*='.str_repeat('a', 32),
            $header->getFieldBody()
            );
    }
    public function testToString()
    {
        $header = $this->_getHeader('Content-Type',
            $this->_getHeaderEncoder('Q', true), $this->_getParameterEncoder(true)
            );
        $header->setValue('text/html');
        $header->setParameters(array('charset' => 'utf-8'));
        $this->assertEquals('Content-Type: text/html; charset=utf-8'."\r\n",
            $header->toString()
            );
    }
    public function testValueCanBeEncodedIfNonAscii()
    {
        $value = 'fo'.pack('C', 0x8F).'bar';
        $encoder = $this->_getHeaderEncoder('Q');
        $encoder->shouldReceive('encodeString')
                ->once()
                ->with($value, \Mockery::any(), \Mockery::any(), \Mockery::any())
                ->andReturn('fo=8Fbar');
        $header = $this->_getHeader('X-Foo', $encoder, $this->_getParameterEncoder(true));
        $header->setValue($value);
        $header->setParameters(array('lookslike' => 'foobar'));
        $this->assertEquals('X-Foo: =?utf-8?Q?fo=8Fbar?=; lookslike=foobar'."\r\n",
            $header->toString()
            );
    }
    public function testValueAndParamCanBeEncodedIfNonAscii()
    {
        $value = 'fo'.pack('C', 0x8F).'bar';
        $encoder = $this->_getHeaderEncoder('Q');
        $encoder->shouldReceive('encodeString')
                ->once()
                ->with($value, \Mockery::any(), \Mockery::any(), \Mockery::any())
                ->andReturn('fo=8Fbar');
        $paramEncoder = $this->_getParameterEncoder();
        $paramEncoder->shouldReceive('encodeString')
                     ->once()
                     ->with($value, \Mockery::any(), \Mockery::any(), \Mockery::any())
                     ->andReturn('fo%8Fbar');
        $header = $this->_getHeader('X-Foo', $encoder, $paramEncoder);
        $header->setValue($value);
        $header->setParameters(array('says' => $value));
        $this->assertEquals("X-Foo: =?utf-8?Q?fo=8Fbar?=; says*=utf-8''fo%8Fbar\r\n",
            $header->toString()
            );
    }
    public function testParamsAreEncodedWithEncodedWordsIfNoParamEncoderSet()
    {
        $value = 'fo'.pack('C', 0x8F).'bar';
        $encoder = $this->_getHeaderEncoder('Q');
        $encoder->shouldReceive('encodeString')
                ->once()
                ->with($value, \Mockery::any(), \Mockery::any(), \Mockery::any())
                ->andReturn('fo=8Fbar');
        $header = $this->_getHeader('X-Foo', $encoder, null);
        $header->setValue('bar');
        $header->setParameters(array('says' => $value));
        $this->assertEquals("X-Foo: bar; says=\"=?utf-8?Q?fo=8Fbar?=\"\r\n",
            $header->toString()
            );
    }
    public function testLanguageInformationAppearsInEncodedWords()
    {
        $value = 'fo'.pack('C', 0x8F).'bar';
        $encoder = $this->_getHeaderEncoder('Q');
        $encoder->shouldReceive('encodeString')
                ->once()
                ->with($value, \Mockery::any(), \Mockery::any(), \Mockery::any())
                ->andReturn('fo=8Fbar');
        $paramEncoder = $this->_getParameterEncoder();
        $paramEncoder->shouldReceive('encodeString')
                     ->once()
                     ->with($value, \Mockery::any(), \Mockery::any(), \Mockery::any())
                     ->andReturn('fo%8Fbar');
        $header = $this->_getHeader('X-Foo', $encoder, $paramEncoder);
        $header->setLanguage('en');
        $header->setValue($value);
        $header->setParameters(array('says' => $value));
        $this->assertEquals("X-Foo: =?utf-8*en?Q?fo=8Fbar?=; says*=utf-8'en'fo%8Fbar\r\n",
            $header->toString()
            );
    }
    public function testSetBodyModel()
    {
        $header = $this->_getHeader('Content-Type',
            $this->_getHeaderEncoder('Q', true), $this->_getParameterEncoder(true)
            );
        $header->setFieldBodyModel('text/html');
        $this->assertEquals('text/html', $header->getValue());
    }
    public function testGetBodyModel()
    {
        $header = $this->_getHeader('Content-Type',
            $this->_getHeaderEncoder('Q', true), $this->_getParameterEncoder(true)
            );
        $header->setValue('text/plain');
        $this->assertEquals('text/plain', $header->getFieldBodyModel());
    }
    public function testSetParameter()
    {
        $header = $this->_getHeader('Content-Type',
            $this->_getHeaderEncoder('Q', true), $this->_getParameterEncoder(true)
            );
        $header->setParameters(array('charset' => 'utf-8', 'delsp' => 'yes'));
        $header->setParameter('delsp', 'no');
        $this->assertEquals(array('charset' => 'utf-8', 'delsp' => 'no'),
            $header->getParameters()
            );
    }
    public function testGetParameter()
    {
        $header = $this->_getHeader('Content-Type',
            $this->_getHeaderEncoder('Q', true), $this->_getParameterEncoder(true)
            );
        $header->setParameters(array('charset' => 'utf-8', 'delsp' => 'yes'));
        $this->assertEquals('utf-8', $header->getParameter('charset'));
    }
    private function _getHeader($name, $encoder, $paramEncoder)
    {
        $header = new Swift_Mime_Headers_ParameterizedHeader($name, $encoder,
            $paramEncoder, new Swift_Mime_Grammar()
            );
        $header->setCharset($this->_charset);
        return $header;
    }
    private function _getHeaderEncoder($type, $stub = false)
    {
        $encoder = $this->getMockery('Swift_Mime_HeaderEncoder')->shouldIgnoreMissing();
        $encoder->shouldReceive('getName')
                ->zeroOrMoreTimes()
                ->andReturn($type);
        return $encoder;
    }
    private function _getParameterEncoder($stub = false)
    {
        return $this->getMockery('Swift_Encoder')->shouldIgnoreMissing();
    }
}
