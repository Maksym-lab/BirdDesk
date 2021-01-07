<?php
if ( !defined('PHP_VERSION_ID') ) {
  $version = explode('.', PHP_VERSION);
  define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + $version[2]));
}
function def($name, $value = true) {
  if ( !defined($name) ) {
    define($name, $value);
  }
}
if ( !function_exists("pre_r") ) {
function pre_r($mixed, $return = false) {
  if ( $return ) {
    return "<pre>" . print_r($mixed, true) . "</pre>";
  }
  if ( php_sapi_name() !== "cli" ) {
    echo "<pre>";
  }
  print_r($mixed);
  if ( php_sapi_name() !== "cli" ) {
    echo "</pre>";
  }
  else {
    echo "\n";
  }
  flush();
}
}
if ( !function_exists("pre_var_dump") ) {
function pre_var_dump($mixed) {
  if ( php_sapi_name() !== "cli" ) {
    echo "<pre>";
  }
  var_dump($mixed);
  if ( php_sapi_name() !== "cli" ) {
    echo "</pre>";
  }
}
}
if ( !function_exists("d") ) {
function d($mixed) {
  if ( php_sapi_name() !== "cli" ) {
    echo "<pre>";
  }
  if ( $mixed instanceof Line_Box ) {
    echo $mixed;
  }
  else {
    var_export($mixed);
  }
  if ( php_sapi_name() !== "cli" ) {
    echo "</pre>";
  }
}
}
function build_url($protocol, $host, $base_path, $url) {
  if ( strlen($url) == 0 ) {
    return $protocol . $host . $base_path;
  }
  if ( mb_strpos($url, ":
    return $url;
  }
  $ret = $protocol;
  if ( !in_array(mb_strtolower($protocol), array("http:
    if ( $url[0] !== '/' && (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN' || ($url[0] !== '\\' && $url[1] !== ':')) ) {
      $ret .= realpath($base_path).'/';
    }
    $ret .= $url;
    $ret = preg_replace('/\?(.*)$/', "", $ret);
    return $ret;
  }
  if ( $url[0] === '/' || $url[0] === '\\' ) {
    $ret .= $host . $url;
  }
  else {
    $ret .= $host . $base_path . $url;
  }
  return $ret;
}
function explode_url($url) {
  $protocol = "";
  $host = "";
  $path = "";
  $file = "";
  $arr = parse_url($url);
  if ( isset($arr["scheme"]) && $arr["scheme"] !== "file" && strlen($arr["scheme"]) > 1 ) {
    $protocol = $arr["scheme"] . ":
    if ( isset($arr["user"]) ) {
      $host .= $arr["user"];
      if ( isset($arr["pass"]) ) {
        $host .= ":" . $arr["pass"];
      }
      $host .= "@";
    }
    if ( isset($arr["host"]) ) {
      $host .= $arr["host"];
    }
    if ( isset($arr["port"]) ) {
      $host .= ":" . $arr["port"];
    }
    if ( isset($arr["path"]) && $arr["path"] !== "" ) {
      if ( $arr["path"][ mb_strlen($arr["path"]) - 1 ] === "/" ) {
        $path = $arr["path"];
        $file = "";
      }
      else {
        $path = rtrim(dirname($arr["path"]), '/\\') . "/";
        $file = basename($arr["path"]);
      }
    }
    if ( isset($arr["query"]) ) {
      $file .= "?" . $arr["query"];
    }
    if ( isset($arr["fragment"]) ) {
      $file .= "#" . $arr["fragment"];
    }
  }
  else {
    $i = mb_strpos($url, "file:
    if ( $i !== false ) {
      $url = mb_substr($url, $i + 7);
    }
    $protocol = ""; 
    $host = ""; 
    $file = basename($url);
    $path = dirname($url);
    if ( $path !== false ) {
      $path .= '/';
    }
    else {
      $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https:
      $host = isset($_SERVER["HTTP_HOST"]) ? $_SERVER["HTTP_HOST"] : php_uname("n");
      if ( substr($arr["path"], 0, 1) === '/' ) {
        $path = dirname($arr["path"]);
      }
      else {
        $path = '/' . rtrim(dirname($_SERVER["SCRIPT_NAME"]), '/') . '/' . $arr["path"];
      }
    }
  }
  $ret = array($protocol, $host, $path, $file,
               "protocol" => $protocol,
               "host" => $host,
               "path" => $path,
               "file" => $file);
  return $ret;
}
function dec2roman($num) {
  static $ones = array("", "i", "ii", "iii", "iv", "v", "vi", "vii", "viii", "ix");
  static $tens = array("", "x", "xx", "xxx", "xl", "l", "lx", "lxx", "lxxx", "xc");
  static $hund = array("", "c", "cc", "ccc", "cd", "d", "dc", "dcc", "dccc", "cm");
  static $thou = array("", "m", "mm", "mmm");
  if ( !is_numeric($num) ) {
    throw new DOMPDF_Exception("dec2roman() requires a numeric argument.");
  }
  if ( $num > 4000 || $num < 0 ) {
    return "(out of range)";
  }
  $num = strrev((string)$num);
  $ret = "";
  switch (mb_strlen($num)) {
    case 4: $ret .= $thou[$num[3]];
    case 3: $ret .= $hund[$num[2]];
    case 2: $ret .= $tens[$num[1]];
    case 1: $ret .= $ones[$num[0]];
    default: break;
  }
  return $ret;
}
function is_percent($value) {
  return false !== mb_strpos($value, "%");
}
function parse_data_uri($data_uri) {
  if (!preg_match('/^data:(?P<mime>[a-z0-9\/+-.]+)(;charset=(?P<charset>[a-z0-9-])+)?(?P<base64>;base64)?\,(?P<data>.*)?/i', $data_uri, $match)) {
    return false;
  }
  $match['data'] = rawurldecode($match['data']);
  $result = array(
    'charset' => $match['charset'] ? $match['charset'] : 'US-ASCII',
    'mime'    => $match['mime'] ? $match['mime'] : 'text/plain',
    'data'    => $match['base64'] ? base64_decode($match['data']) : $match['data'],
  );
  return $result;
}
if (!extension_loaded('mbstring')) {
  def('MB_OVERLOAD_MAIL', 1);
  def('MB_OVERLOAD_STRING', 2);
  def('MB_OVERLOAD_REGEX', 4);
  def('MB_CASE_UPPER', 0);
  def('MB_CASE_LOWER', 1);
  def('MB_CASE_TITLE', 2);
  if (!function_exists('mb_convert_encoding')) {
      function mb_convert_encoding($data, $to_encoding, $from_encoding = 'UTF-8') {
      if (str_replace('-', '', strtolower($to_encoding)) === 'utf8') {
        return utf8_encode($data);
      }
      return utf8_decode($data);
    }
  }
  if (!function_exists('mb_detect_encoding')) {
    function mb_detect_encoding($data, $encoding_list = array('iso-8859-1'), $strict = false) {
      return 'iso-8859-1';
    }
  }
  if (!function_exists('mb_detect_order')) {
    function mb_detect_order($encoding_list = array('iso-8859-1')) {
      return 'iso-8859-1';
    }
  }
  if (!function_exists('mb_internal_encoding')) {
    function mb_internal_encoding($encoding = null) {
      if (isset($encoding)) {
        return true;
      }
      return 'iso-8859-1';
    }
  }
  if (!function_exists('mb_strlen')) {
    function mb_strlen($str, $encoding = 'iso-8859-1') {
      switch (str_replace('-', '', strtolower($encoding))) {
        case "utf8": return strlen(utf8_encode($str));
        case "8bit": return strlen($str);
        default:     return strlen(utf8_decode($str));
      }
    }
  }
  if (!function_exists('mb_strpos')) {
    function mb_strpos($haystack, $needle, $offset = 0) {
      return strpos($haystack, $needle, $offset);
    }
  }
  if (!function_exists('mb_strrpos')) {
    function mb_strrpos($haystack, $needle, $offset = 0) {
      return strrpos($haystack, $needle, $offset);
    }
  }
  if (!function_exists('mb_strtolower')) {
    function mb_strtolower( $str ) {
      return strtolower($str);
    }
  }
  if (!function_exists('mb_strtoupper')) {
    function mb_strtoupper( $str ) {
      return strtoupper($str);
    }
  }
  if (!function_exists('mb_substr')) {
    function mb_substr($string, $start, $length = null, $encoding = 'iso-8859-1') {
      if ( is_null($length) ) {
        return substr($string, $start);
      }
      return substr($string, $start, $length);
    }
  }
  if (!function_exists('mb_substr_count')) {
    function mb_substr_count($haystack, $needle, $encoding = 'iso-8859-1') {
      return substr_count($haystack, $needle);
    }
  }
  if (!function_exists('mb_encode_numericentity')) {
    function mb_encode_numericentity($str, $convmap, $encoding) {
      return htmlspecialchars($str);
    }
  }
  if (!function_exists('mb_convert_case')) {
    function mb_convert_case($str, $mode = MB_CASE_UPPER, $encoding = array()) {
      switch($mode) {
        case MB_CASE_UPPER: return mb_strtoupper($str);
        case MB_CASE_LOWER: return mb_strtolower($str);
        case MB_CASE_TITLE: return ucwords(mb_strtolower($str));
        default: return $str;
      }
    }
  }
  if (!function_exists('mb_list_encodings')) {
    function mb_list_encodings() {
      return array(
        "ISO-8859-1",
        "UTF-8",
        "8bit",
      );
    }
  }
}
function rle8_decode ($str, $width){
  $lineWidth = $width + (3 - ($width-1) % 4);
  $out = '';
  $cnt = strlen($str);
  for ($i = 0; $i <$cnt; $i++) {
    $o = ord($str[$i]);
    switch ($o){
      case 0: # ESCAPE
        $i++;
        switch (ord($str[$i])){
          case 0: # NEW LINE
            $padCnt = $lineWidth - strlen($out)%$lineWidth;
            if ($padCnt<$lineWidth) $out .= str_repeat(chr(0), $padCnt); # pad line
            break;
          case 1: # END OF FILE
            $padCnt = $lineWidth - strlen($out)%$lineWidth;
            if ($padCnt<$lineWidth) $out .= str_repeat(chr(0), $padCnt); # pad line
            break 3;
          case 2: # DELTA
            $i += 2;
            break;
          default: # ABSOLUTE MODE
            $num = ord($str[$i]);
            for ($j = 0; $j < $num; $j++)
              $out .= $str[++$i];
            if ($num % 2) $i++;
        }
      break;
      default:
      $out .= str_repeat($str[++$i], $o);
    }
  }
  return $out;
}
function rle4_decode ($str, $width) {
  $w = floor($width/2) + ($width % 2);
  $lineWidth = $w + (3 - ( ($width-1) / 2) % 4);    
  $pixels = array();
  $cnt = strlen($str);
  $c = 0;
  for ($i = 0; $i < $cnt; $i++) {
    $o = ord($str[$i]);
    switch ($o) {
      case 0: # ESCAPE
        $i++;
        switch (ord($str[$i])){
          case 0: # NEW LINE
            while (count($pixels)%$lineWidth != 0) {
              $pixels[] = 0;
            }
            break;
          case 1: # END OF FILE
            while (count($pixels)%$lineWidth != 0) {
              $pixels[] = 0;
            }
            break 3;
          case 2: # DELTA
            $i += 2;
            break;
          default: # ABSOLUTE MODE
            $num = ord($str[$i]);
            for ($j = 0; $j < $num; $j++) {
              if ($j%2 == 0) {
                $c = ord($str[++$i]);
                $pixels[] = ($c & 240)>>4;
              }
              else {
                $pixels[] = $c & 15;
              }
            }
            if ($num % 2 == 0) {
              $i++;
            }
       }
       break;
      default:
        $c = ord($str[++$i]);
        for ($j = 0; $j < $o; $j++) {
          $pixels[] = ($j%2==0 ? ($c & 240)>>4 : $c & 15);
        }
    }
  }
  $out = '';
  if (count($pixels)%2) {
    $pixels[] = 0;
  }
  $cnt = count($pixels)/2;
  for ($i = 0; $i < $cnt; $i++) {
    $out .= chr(16*$pixels[2*$i] + $pixels[2*$i+1]);
  }
  return $out;
} 
if ( !function_exists("imagecreatefrombmp") ) {
function imagecreatefrombmp($filename) {
  if (!function_exists("imagecreatetruecolor")) {
    trigger_error("The PHP GD extension is required, but is not installed.", E_ERROR);
    return false;
  }
  if (!($fh = fopen($filename, 'rb'))) {
    trigger_error('imagecreatefrombmp: Can not open ' . $filename, E_USER_WARNING);
    return false;
  }
  $bytes_read = 0;
  $meta = unpack('vtype/Vfilesize/Vreserved/Voffset', fread($fh, 14));
  if ($meta['type'] != 19778) {
    trigger_error('imagecreatefrombmp: ' . $filename . ' is not a bitmap!', E_USER_WARNING);
    return false;
  }
  $meta += unpack('Vheadersize/Vwidth/Vheight/vplanes/vbits/Vcompression/Vimagesize/Vxres/Vyres/Vcolors/Vimportant', fread($fh, 40));
  $bytes_read += 40;
  if ($meta['compression'] == 3) {
    $meta += unpack('VrMask/VgMask/VbMask', fread($fh, 12));
    $bytes_read += 12;
  }
  $meta['bytes'] = $meta['bits'] / 8;
  $meta['decal'] = 4 - (4 * (($meta['width'] * $meta['bytes'] / 4)- floor($meta['width'] * $meta['bytes'] / 4)));
  if ($meta['decal'] == 4) {
    $meta['decal'] = 0;
  }
  if ($meta['imagesize'] < 1) {
    $meta['imagesize'] = $meta['filesize'] - $meta['offset'];
    if ($meta['imagesize'] < 1) {
      $meta['imagesize'] = @filesize($filename) - $meta['offset'];
      if ($meta['imagesize'] < 1) {
        trigger_error('imagecreatefrombmp: Can not obtain filesize of ' . $filename . '!', E_USER_WARNING);
        return false;
      }
    }
  }
  $meta['colors'] = !$meta['colors'] ? pow(2, $meta['bits']) : $meta['colors'];
  $palette = array();
  if ($meta['bits'] < 16) {
    $palette = unpack('l' . $meta['colors'], fread($fh, $meta['colors'] * 4));
    if ($palette[1] < 0) {
      foreach ($palette as $i => $color) {
        $palette[$i] = $color + 16777216;
      }
    }
  }
  if ($meta['headersize'] > $bytes_read) {
    fread($fh, $meta['headersize'] - $bytes_read);
  }
  $im = imagecreatetruecolor($meta['width'], $meta['height']);
  $data = fread($fh, $meta['imagesize']);
  switch ($meta['compression']) {
    case 1: $data = rle8_decode($data, $meta['width']); break;
    case 2: $data = rle4_decode($data, $meta['width']); break;
  }
  $p = 0;
  $vide = chr(0);
  $y = $meta['height'] - 1;
  $error = 'imagecreatefrombmp: ' . $filename . ' has not enough data!';
  while ($y >= 0) {
    $x = 0;
    while ($x < $meta['width']) {
      switch ($meta['bits']) {
        case 32:
        case 24:
          if (!($part = substr($data, $p, 3 ))) {
            trigger_error($error, E_USER_WARNING);
            return $im;
          }
          $color = unpack('V', $part . $vide);
          break;
        case 16:
          if (!($part = substr($data, $p, 2 ))) {
            trigger_error($error, E_USER_WARNING);
            return $im;
          }
          $color = unpack('v', $part);
          if (empty($meta['rMask']) || $meta['rMask'] != 0xf800) {
            $color[1] = (($color[1] & 0x7c00) >> 7) * 65536 + (($color[1] & 0x03e0) >> 2) * 256 + (($color[1] & 0x001f) << 3); 
          }
          else { 
            $color[1] = (($color[1] & 0xf800) >> 8) * 65536 + (($color[1] & 0x07e0) >> 3) * 256 + (($color[1] & 0x001f) << 3); 
          }
          break;
        case 8:
          $color = unpack('n', $vide . substr($data, $p, 1));
          $color[1] = $palette[ $color[1] + 1 ];
          break;
        case 4:
          $color = unpack('n', $vide . substr($data, floor($p), 1));
          $color[1] = ($p * 2) % 2 == 0 ? $color[1] >> 4 : $color[1] & 0x0F;
          $color[1] = $palette[ $color[1] + 1 ];
          break;
        case 1:
          $color = unpack('n', $vide . substr($data, floor($p), 1));
          switch (($p * 8) % 8) {
            case 0: $color[1] =  $color[1] >> 7; break;
            case 1: $color[1] = ($color[1] & 0x40) >> 6; break;
            case 2: $color[1] = ($color[1] & 0x20) >> 5; break;
            case 3: $color[1] = ($color[1] & 0x10) >> 4; break;
            case 4: $color[1] = ($color[1] & 0x8 ) >> 3; break;
            case 5: $color[1] = ($color[1] & 0x4 ) >> 2; break;
            case 6: $color[1] = ($color[1] & 0x2 ) >> 1; break;
            case 7: $color[1] = ($color[1] & 0x1 );      break;
          }
          $color[1] = $palette[ $color[1] + 1 ];
          break;
        default:
          trigger_error('imagecreatefrombmp: ' . $filename . ' has ' . $meta['bits'] . ' bits and this is not supported!', E_USER_WARNING);
          return false;
      }
      imagesetpixel($im, $x, $y, $color[1]);
      $x++;
      $p += $meta['bytes'];
    }
    $y--;
    $p += $meta['decal'];
  }
  fclose($fh);
  return $im;
}
}
function dompdf_getimagesize($filename) {
  static $cache = array();
  if ( isset($cache[$filename]) ) {
    return $cache[$filename];
  }
  list($width, $height, $type) = getimagesize($filename);
  if ( $width == null || $height == null ) {
    $data = file_get_contents($filename, null, null, 0, 26);
    if ( substr($data, 0, 2) === "BM" ) {
      $meta = unpack('vtype/Vfilesize/Vreserved/Voffset/Vheadersize/Vwidth/Vheight', $data);
      $width  = (int)$meta['width'];
      $height = (int)$meta['height'];
      $type   = IMAGETYPE_BMP;
    }
  }
  return $cache[$filename] = array($width, $height, $type);
}
function cmyk_to_rgb($c, $m = null, $y = null, $k = null) {
  if (is_array($c)) {
    list($c, $m, $y, $k) = $c;
  }
  $c *= 255;
  $m *= 255;
  $y *= 255;
  $k *= 255;
  $r = (1 - round(2.55 * ($c+$k))) ;
  $g = (1 - round(2.55 * ($m+$k))) ;
  $b = (1 - round(2.55 * ($y+$k))) ;
  if ($r < 0) $r = 0;
  if ($g < 0) $g = 0;
  if ($b < 0) $b = 0;
  return array(
    $r, $g, $b,
    "r" => $r, "g" => $g, "b" => $b
  );
}
function unichr($c) {
  if ($c <= 0x7F) {
    return chr($c);
  }
  else if ($c <= 0x7FF) {
    return chr(0xC0 | $c >>  6) . chr(0x80 | $c & 0x3F);
  }
  else if ($c <= 0xFFFF) {
    return chr(0xE0 | $c >> 12) . chr(0x80 | $c >> 6 & 0x3F)
                                . chr(0x80 | $c & 0x3F);
  }
  else if ($c <= 0x10FFFF) {
    return chr(0xF0 | $c >> 18) . chr(0x80 | $c >> 12 & 0x3F)
                                . chr(0x80 | $c >> 6 & 0x3F)
                                . chr(0x80 | $c & 0x3F);
  }
  return false;
}
if ( !function_exists("date_default_timezone_get") ) {
  function date_default_timezone_get() {
    return "";
  }
  function date_default_timezone_set($timezone_identifier) {
    return true;
  }
}
function record_warnings($errno, $errstr, $errfile, $errline) {
  if ( !($errno & (E_WARNING | E_NOTICE | E_USER_NOTICE | E_USER_WARNING )) ) {
    throw new DOMPDF_Exception($errstr . " $errno");
  }
  global $_dompdf_warnings;
  global $_dompdf_show_warnings;
  if ( $_dompdf_show_warnings ) {
    echo $errstr . "\n";
  }
  $_dompdf_warnings[] = $errstr;
}
function bt() {
  if ( php_sapi_name() !== "cli") {
    echo "<pre>";
  }
  $bt = debug_backtrace();
  array_shift($bt); 
  echo "\n";
  $i = 0;
  foreach ($bt as $call) {
    $file = basename($call["file"]) . " (" . $call["line"] . ")";
    if ( isset($call["class"]) ) {
      $func = $call["class"] . "->" . $call["function"] . "()";
    }
    else {
      $func = $call["function"] . "()";
    }
    echo "#" . str_pad($i, 2, " ", STR_PAD_RIGHT) . ": " . str_pad($file.":", 42) . " $func\n";
    $i++;
  }
  echo "\n";
  if ( php_sapi_name() !== "cli") {
    echo "</pre>";
  }
}
function dompdf_debug($type, $msg) {
  global $_DOMPDF_DEBUG_TYPES, $_dompdf_show_warnings, $_dompdf_debug;
  if ( isset($_DOMPDF_DEBUG_TYPES[$type]) && ($_dompdf_show_warnings || $_dompdf_debug) ) {
    $arr = debug_backtrace();
    echo basename($arr[0]["file"]) . " (" . $arr[0]["line"] ."): " . $arr[1]["function"] . ": ";
    pre_r($msg);
  }
}
if ( !function_exists("print_memusage") ) {
function print_memusage() {
  global $memusage;
  echo "Memory Usage\n";
  $prev = 0;
  $initial = reset($memusage);
  echo str_pad("Initial:", 40) . $initial . "\n\n";
  foreach ($memusage as $key=>$mem) {
    $mem -= $initial;
    echo str_pad("$key:" , 40);
    echo str_pad("$mem", 12) . "(diff: " . ($mem - $prev) . ")\n";
    $prev = $mem;
  }
  echo "\n" . str_pad("Total:", 40) . memory_get_usage() . "\n";
}
}
if ( !function_exists("enable_mem_profile") ) {
function enable_mem_profile() {
  global $memusage;
  $memusage = array("Startup" => memory_get_usage());
  register_shutdown_function("print_memusage");
}
}
if ( !function_exists("mark_memusage") ) {
function mark_memusage($location) {
  global $memusage;
  if ( isset($memusage) ) {
    $memusage[$location] = memory_get_usage();
  }
}
}
if ( !function_exists('sys_get_temp_dir')) {
function sys_get_temp_dir() {
  if (!empty($_ENV['TMP'])) {
    return realpath($_ENV['TMP']);
  }
  if (!empty($_ENV['TMPDIR'])) {
    return realpath( $_ENV['TMPDIR']);
  }
  if (!empty($_ENV['TEMP'])) {
    return realpath( $_ENV['TEMP']);
  }
  $tempfile=tempnam(uniqid(rand(), true), '');
  if (file_exists($tempfile)) {
    unlink($tempfile);
    return realpath(dirname($tempfile));
  }
}
}
if ( function_exists("memory_get_peak_usage") ) {
  function DOMPDF_memory_usage(){
    return memory_get_peak_usage(true);
  }
}
else if ( function_exists("memory_get_usage") ) {
  function DOMPDF_memory_usage(){
    return memory_get_usage(true);
  }
}
else {
  function DOMPDF_memory_usage(){
    return "N/A";
  }
}
if ( function_exists("curl_init") ) {
  function DOMPDF_fetch_url($url, &$headers = null) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $data = curl_exec($ch);
    $raw_headers = substr($data, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
    $headers = preg_split("/[\n\r]+/", trim($raw_headers));
    $data = substr($data, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
    curl_close($ch);
    return $data;
  }
}
else {
  function DOMPDF_fetch_url($url, &$headers = null) {
    $data = file_get_contents($url);
    $headers = $http_response_header;
    return $data;
  }
}
if ( PHP_VERSION_ID < 50300 ) {
  function clear_object(&$object) {
    if ( is_object($object) ) {
      foreach ($object as &$value) {
        clear_object($value);
      }
    }
    $object = null;
    unset($object);
  }
}
else {
  function clear_object(&$object) {
  } 
}
