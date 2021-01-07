<?php
namespace Symfony\Component\Translation\Dumper;
use Symfony\Component\Translation\MessageCatalogue;
class IcuResFileDumper extends FileDumper
{
    protected $relativePathTemplate = '%domain%/%locale%.%extension%';
    public function format(MessageCatalogue $messages, $domain = 'messages')
    {
        $data = $indexes = $resources = '';
        foreach ($messages->all($domain) as $source => $target) {
            $indexes .= pack('v', strlen($data) + 28);
            $data    .= $source."\0";
        }
        $data .= $this->writePadding($data);
        $keyTop = $this->getPosition($data);
        foreach ($messages->all($domain) as $source => $target) {
            $resources .= pack('V', $this->getPosition($data));
            $data .= pack('V', strlen($target))
                .mb_convert_encoding($target."\0", 'UTF-16LE', 'UTF-8')
                .$this->writePadding($data)
                  ;
        }
        $resOffset = $this->getPosition($data);
        $data .= pack('v', count($messages))
            .$indexes
            .$this->writePadding($data)
            .$resources
              ;
        $bundleTop = $this->getPosition($data);
        $root = pack('V7',
            $resOffset + (2 << 28), 
            6,                      
            $keyTop,                
            $bundleTop,             
            $bundleTop,             
            count($messages),       
            0                       
        );
        $header = pack('vC2v4C12@32',
            32,                     
            0xDA, 0x27,             
            20, 0, 0, 2,            
            0x52, 0x65, 0x73, 0x42, 
            1, 2, 0, 0,             
            1, 4, 0, 0              
        );
        $output = $header
               .$root
               .$data;
        return $output;
    }
    private function writePadding($data)
    {
        $padding = strlen($data) % 4;
        if ($padding) {
            return str_repeat("\xAA", 4 - $padding);
        }
    }
    private function getPosition($data)
    {
        $position = (strlen($data) + 28) / 4;
        return $position;
    }
    protected function getExtension()
    {
        return 'res';
    }
}
