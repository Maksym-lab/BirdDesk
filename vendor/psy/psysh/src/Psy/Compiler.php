<?php
namespace Psy;
use Symfony\Component\Finder\Finder;
class Compiler
{
    public function compile($pharFile = 'psysh.phar')
    {
        if (file_exists($pharFile)) {
            unlink($pharFile);
        }
        $this->version = Shell::VERSION;
        $phar = new \Phar($pharFile, 0, 'psysh.phar');
        $phar->setSignatureAlgorithm(\Phar::SHA1);
        $phar->startBuffering();
        $finder = Finder::create()
            ->files()
            ->ignoreVCS(true)
            ->name('*.php')
            ->notName('Compiler.php')
            ->notName('Autoloader.php')
            ->in(__DIR__ . '/..');
        foreach ($finder as $file) {
            $this->addFile($phar, $file);
        }
        $finder = Finder::create()
            ->files()
            ->ignoreVCS(true)
            ->name('*.php')
            ->exclude('Tests')
            ->in(__DIR__ . '/../../vendor/dnoegel/php-xdg-base-dir/src')
            ->in(__DIR__ . '/../../vendor/jakub-onderka/php-console-color')
            ->in(__DIR__ . '/../../vendor/jakub-onderka/php-console-highlighter')
            ->in(__DIR__ . '/../../vendor/nikic/php-parser/lib')
            ->in(__DIR__ . '/../../vendor/symfony/console')
            ->in(__DIR__ . '/../../vendor/symfony/yaml');
        foreach ($finder as $file) {
            $this->addFile($phar, $file);
        }
        $this->addFile($phar, new \SplFileInfo(__DIR__ . '/../../vendor/autoload.php'));
        $this->addFile($phar, new \SplFileInfo(__DIR__ . '/../../vendor/composer/include_paths.php'));
        $this->addFile($phar, new \SplFileInfo(__DIR__ . '/../../vendor/composer/autoload_files.php'));
        $this->addFile($phar, new \SplFileInfo(__DIR__ . '/../../vendor/composer/autoload_psr4.php'));
        $this->addFile($phar, new \SplFileInfo(__DIR__ . '/../../vendor/composer/autoload_real.php'));
        $this->addFile($phar, new \SplFileInfo(__DIR__ . '/../../vendor/composer/autoload_namespaces.php'));
        $this->addFile($phar, new \SplFileInfo(__DIR__ . '/../../vendor/composer/autoload_classmap.php'));
        $this->addFile($phar, new \SplFileInfo(__DIR__ . '/../../vendor/composer/ClassLoader.php'));
        $phar->setStub($this->getStub());
        $phar->stopBuffering();
        unset($phar);
    }
    private function addFile($phar, $file, $strip = true)
    {
        $path = str_replace(dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR, '', $file->getRealPath());
        $content = file_get_contents($file);
        if ($strip) {
            $content = $this->stripWhitespace($content);
        } elseif ('LICENSE' === basename($file)) {
            $content = "\n" . $content . "\n";
        }
        $phar->addFromString($path, $content);
    }
    private function stripWhitespace($source)
    {
        if (!function_exists('token_get_all')) {
            return $source;
        }
        $output = '';
        foreach (token_get_all($source) as $token) {
            if (is_string($token)) {
                $output .= $token;
            } elseif (in_array($token[0], array(T_COMMENT, T_DOC_COMMENT))) {
                $output .= str_repeat("\n", substr_count($token[1], "\n"));
            } elseif (T_WHITESPACE === $token[0]) {
                $whitespace = preg_replace('{[ \t]+}', ' ', $token[1]);
                $whitespace = preg_replace('{(?:\r\n|\r|\n)}', "\n", $whitespace);
                $whitespace = preg_replace('{\n +}', "\n", $whitespace);
                $output .= $whitespace;
            } else {
                $output .= $token[1];
            }
        }
        return $output;
    }
    private function getStub()
    {
        $autoload = <<<'EOS'
Phar::mapPhar('psysh.phar');
require 'phar:
EOS;
        $content = file_get_contents(__DIR__ . '/../../bin/psysh');
        $content = preg_replace('{/\* <<<.*?>>> \*/}sm', $autoload, $content);
        $content .= "__HALT_COMPILER();";
        return $content;
    }
}