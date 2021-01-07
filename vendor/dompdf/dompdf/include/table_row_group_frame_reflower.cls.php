<?php
class Table_Row_Group_Frame_Reflower extends Frame_Reflower {
  function __construct($frame) {
    parent::__construct($frame);
  }
  function reflow(Block_Frame_Decorator $block = null) {
    $page = $this->_frame->get_root();
    $style = $this->_frame->get_style();
    $table = Table_Frame_Decorator::find_parent_table($this->_frame);
    $cb = $this->_frame->get_containing_block();
    foreach ( $this->_frame->get_children() as $child) {
      if ( $page->is_full() )
        return;
      $child->set_containing_block($cb["x"], $cb["y"], $cb["w"], $cb["h"]);
      $child->reflow();
      $page->check_page_break($child);
    }
    if ( $page->is_full() )
      return;
    $cellmap = $table->get_cellmap();
    $style->width = $cellmap->get_frame_width($this->_frame);
    $style->height = $cellmap->get_frame_height($this->_frame);
    $this->_frame->set_position($cellmap->get_frame_position($this->_frame));
    if ( $table->get_style()->border_collapse === "collapse" ) 
      $style->border_style = "none";
  }
}
