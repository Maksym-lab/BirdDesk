<?php
class Swift_Mime_HeaderEncoder_QpHeaderEncoderTest extends \SwiftMailerTestCase
{
    public function testNameIsQ()
    {
        $encoder = $this->_createEncoder(
            $this->_createCharacterStream(true)
            );
        $this->assertEquals('Q', $encoder->getName());
    }
    public function testSpaceAndTabNeverAppear()
    {
        $charStream = $this->_createCharacterStream();
        $charStream->shouldReceive('readBytes')
                   ->atLeast()->times(6)
                   ->andReturn(array(ord('a')), array(0x20), array(0x09), array(0x20), array(ord('b')), false);
        $encoder = $this->_createEncoder($charStream);
        $this->assertNotRegExp('~[ \t]~', $encoder->encodeString("a \t b"),
            '%s: encoded-words in headers cannot contain LWSP as per RFC 2047.'
            );
    }
    public function testSpaceIsRepresentedByUnderscore()
    {
        $charStream = $this->_createCharacterStream();
        $charStream->shouldReceive('readBytes')
                   ->once()
                   ->andReturn(array(ord('a')));
        $charStream->shouldReceive('readBytes')
                   ->once()
                   ->andReturn(array(0x20));
        $charStream->shouldReceive('readBytes')
                   ->once()
                   ->andReturn(array(ord('b')));
        $charStream->shouldReceive('readBytes')
                   ->zeroOrMoreTimes()
                   ->andReturn(false);
        $encoder = $this->_createEncoder($charStream);
        $this->assertEquals('a_b', $encoder->encodeString('a b'),
            '%s: Spaces can be represented by more readable underscores as per RFC 2047.'
            );
    }
    public function testEqualsAndQuestionAndUnderscoreAreEncoded()
    {
        $charStream = $this->_createCharacterStream();
        $charStream->shouldReceive('readBytes')
                   ->once()
                   ->andReturn(array(ord('=')));
        $charStream->shouldReceive('readBytes')
                   ->once()
                   ->andReturn(array(ord('?')));
        $charStream->shouldReceive('readBytes')
                   ->once()
                   ->andReturn(array(ord('_')));
        $charStream->shouldReceive('readBytes')
                   ->zeroOrMoreTimes()
                   ->andReturn(false);
        $encoder = $this->_createEncoder($charStream);
        $this->assertEquals('=3D=3F=5F', $encoder->encodeString('=?_'),
            '%s: Chars =, ? and _ (underscore) may not appear as per RFC 2047.'
            );
    }
    public function testParensAndQuotesAreEncoded()
    {
        $charStream = $this->_createCharacterStream();
        $charStream->shouldReceive('readBytes')
                   ->once()
                   ->andReturn(array(ord('(')));
        $charStream->shouldReceive('readBytes')
                   ->once()
                   ->andReturn(array(ord('"')));
        $charStream->shouldReceive('readBytes')
                   ->once()
                   ->andReturn(array(ord(')')));
        $charStream->shouldReceive('readBytes')
                   ->zeroOrMoreTimes()
                   ->andReturn(false);
        $encoder = $this->_createEncoder($charStream);
        $this->assertEquals('=28=22=29', $encoder->encodeString('(")'),
            '%s: Chars (, " (DQUOTE) and ) may not appear as per RFC 2047.'
            );
    }
    public function testOnlyCharactersAllowedInPhrasesAreUsed()
    {
        $allowedBytes = array_merge(
            range(ord('a'), ord('z')), range(ord('A'), ord('Z')),
            range(ord('0'), ord('9')),
            array(ord('!'), ord('*'), ord('+'), ord('-'), ord('/'))
            );
        foreach (range(0x00, 0xFF) as $byte) {
            $char = pack('C', $byte);
            $charStream = $this->_createCharacterStream();
            $charStream->shouldReceive('readBytes')
                   ->once()
                   ->andReturn(array($byte));
            $charStream->shouldReceive('readBytes')
                   ->zeroOrMoreTimes()
                   ->andReturn(false);
            $encoder = $this->_createEncoder($charStream);
            $encodedChar = $encoder->encodeString($char);
            if (in_array($byte, $allowedBytes)) {
                $this->assertEquals($char, $encodedChar,
                    '%s: Character '.$char.' should not be encoded.'
                    );
            } elseif (0x20 == $byte) {
                $this->assertEquals('_', $encodedChar,
                    '%s: Space character should be replaced.'
                    );
            } else {
                $this->assertEquals(sprintf('=%02X', $byte), $encodedChar,
                    '%s: Byte '.$byte.' should be encoded.'
                    );
            }
        }
    }
    public function testEqualsNeverAppearsAtEndOfLine()
    {
        $input = str_repeat('a', 140);
        $charStream = $this->_createCharacterStream();
        $output = '';
        $seq = 0;
        for (; $seq < 140; ++$seq) {
            $charStream->shouldReceive('readBytes')
                       ->once()
                       ->andReturn(array(ord('a')));
            if (75 == $seq) {
                $output .= "\r\n"; 
            }
            $output .= 'a';
        }
        $charStream->shouldReceive('readBytes')
                   ->zeroOrMoreTimes()
                   ->andReturn(false);
        $encoder = $this->_createEncoder($charStream);
        $this->assertEquals($output, $encoder->encodeString($input));
    }
    private function _createEncoder($charStream)
    {
        return new Swift_Mime_HeaderEncoder_QpHeaderEncoder($charStream);
    }
    private function _createCharacterStream($stub = false)
    {
        return $this->getMockery('Swift_CharacterStream')->shouldIgnoreMissing();
    }
}
