<?php
namespace Symfony\Component\HttpFoundation\Session\Flash;
use Symfony\Component\HttpFoundation\Session\SessionBagInterface;
interface FlashBagInterface extends SessionBagInterface
{
    public function add($type, $message);
    public function set($type, $message);
    public function peek($type, array $default = array());
    public function peekAll();
    public function get($type, array $default = array());
    public function all();
    public function setAll(array $messages);
    public function has($type);
    public function keys();
}
