<?php
class Image_Frame_Decorator extends Frame_Decorator {
  protected $_image_url;
  protected $_image_msg;
  function __construct(Frame $frame, DOMPDF $dompdf) {
    parent::__construct($frame, $dompdf);
    $url = $frame->get_node()->getAttribute("src");
    $debug_png = $dompdf->get_option("debug_png");
    if ($debug_png) print '[__construct '.$url.']';
    list($this->_image_url, , $this->_image_msg) = Image_Cache::resolve_url(
      $url,
      $dompdf->get_protocol(),
      $dompdf->get_host(),
      $dompdf->get_base_path(),
      $dompdf
    );
    if ( Image_Cache::is_broken($this->_image_url) &&
         $alt = $frame->get_node()->getAttribute("alt") ) {
      $style = $frame->get_style();
      $style->width  = (4/3)*Font_Metrics::get_text_width($alt, $style->font_family, $style->font_size, $style->word_spacing);
      $style->height = Font_Metrics::get_font_height($style->font_family, $style->font_size);
    }
  }
  function get_image_url() {
    return $this->_image_url;
  }
  function get_image_msg() {
    return $this->_image_msg;
  }
}
