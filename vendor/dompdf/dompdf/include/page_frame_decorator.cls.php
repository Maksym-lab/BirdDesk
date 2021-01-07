<?php
class Page_Frame_Decorator extends Frame_Decorator {
  protected $_bottom_page_margin;
  protected $_page_full;
  protected $_in_table;
  protected $_renderer;
  protected $_floating_frames = array();
  function __construct(Frame $frame, DOMPDF $dompdf) {
    parent::__construct($frame, $dompdf);
    $this->_page_full = false;
    $this->_in_table = 0;
    $this->_bottom_page_margin = null;
  }
  function set_renderer($renderer) {
    $this->_renderer = $renderer;
  }
  function get_renderer() {
    return $this->_renderer;
  }
  function set_containing_block($x = null, $y = null, $w = null, $h = null) {
    parent::set_containing_block($x,$y,$w,$h);
    if ( isset($h) )
      $this->_bottom_page_margin = $h; 
  }
  function is_full() {
    return $this->_page_full;
  }
  function next_page() {
    $this->_floating_frames = array();
    $this->_renderer->new_page();
    $this->_page_full = false;
  }
  function table_reflow_start() {
    $this->_in_table++;
  }
  function table_reflow_end() {
    $this->_in_table--;
  }
  function in_nested_table() {
    return $this->_in_table > 1;
  }
  function check_forced_page_break(Frame $frame) {
    if ( $this->_page_full )
      return null;
    $block_types = array("block", "list-item", "table", "inline");
    $page_breaks = array("always", "left", "right");
    $style = $frame->get_style();
    if ( !in_array($style->display, $block_types) )
      return false;
    $prev = $frame->get_prev_sibling();
    while ( $prev && !in_array($prev->get_style()->display, $block_types) )
      $prev = $prev->get_prev_sibling();
    if ( in_array($style->page_break_before, $page_breaks) ) {
      $frame->split(null, true);
      $frame->get_style()->page_break_before = "auto";
      $this->_page_full = true;
      return true;
    }
    if ( $prev && in_array($prev->get_style()->page_break_after, $page_breaks) ) {
      $frame->split(null, true);
      $prev->get_style()->page_break_after = "auto";
      $this->_page_full = true;
      return true;
    }
    if( $prev && $prev->get_last_child() && $frame->get_node()->nodeName != "body" ) {
      $prev_last_child = $prev->get_last_child();
      if ( in_array($prev_last_child->get_style()->page_break_after, $page_breaks) ) {
        $frame->split(null, true);
        $prev_last_child->get_style()->page_break_after = "auto";
        $this->_page_full = true;
        return true;
      }
    }
    return false;
  }
  protected function _page_break_allowed(Frame $frame) {
    $block_types = array("block", "list-item", "table", "-dompdf-image");
    dompdf_debug("page-break", "_page_break_allowed(" . $frame->get_node()->nodeName. ")");
    $display = $frame->get_style()->display;
    if ( in_array($display, $block_types) ) {
      if ( $this->_in_table ) {
        dompdf_debug("page-break", "In table: " . $this->_in_table);
        return false;
      }
      if ( $frame->get_style()->page_break_before === "avoid" ) {
        dompdf_debug("page-break", "before: avoid");
        return false;
      }
      $prev = $frame->get_prev_sibling();
      while ( $prev && !in_array($prev->get_style()->display, $block_types) )
        $prev = $prev->get_prev_sibling();
      if ( $prev && $prev->get_style()->page_break_after === "avoid" ) {
        dompdf_debug("page-break", "after: avoid");
        return false;
      }
      $parent = $frame->get_parent();
      if ( $prev && $parent && $parent->get_style()->page_break_inside === "avoid" ) {
          dompdf_debug("page-break", "parent inside: avoid");
        return false;
      }
      if ( $parent->get_node()->nodeName === "body" && !$prev ) {
          dompdf_debug("page-break", "Body's first child.");
        return false;
      }
      if ( !$prev && $parent )
        return $this->_page_break_allowed( $parent );
      dompdf_debug("page-break", "block: break allowed");
      return true;
    }
    else if ( in_array($display, Style::$INLINE_TYPES) ) {
      if ( $this->_in_table ) {
          dompdf_debug("page-break", "In table: " . $this->_in_table);
        return false;
      }
      $block_parent = $frame->find_block_parent();
      if ( count($block_parent->get_line_boxes() ) < $frame->get_style()->orphans ) {
          dompdf_debug("page-break", "orphans");
        return false;
      }
      $p = $block_parent;
      while ($p) {
        if ( $p->get_style()->page_break_inside === "avoid" ) {
          dompdf_debug("page-break", "parent->inside: avoid");
          return false;
        }
        $p = $p->find_block_parent();
      }
      $prev = $frame->get_prev_sibling();
      while ( $prev && ($prev->is_text_node() && trim($prev->get_node()->nodeValue) == "") )
        $prev = $prev->get_prev_sibling();
      if ( $block_parent->get_node()->nodeName === "body" && !$prev ) {
          dompdf_debug("page-break", "Body's first child.");
        return false;
      }
      if ( $frame->is_text_node() &&
           $frame->get_node()->nodeValue == "" )
        return false;
      dompdf_debug("page-break", "inline: break allowed");
      return true;
    } else if ( $display === "table-row" ) {
      $p = Table_Frame_Decorator::find_parent_table($frame);
      while ($p) {
        if ( $p->get_style()->page_break_inside === "avoid" ) {
          dompdf_debug("page-break", "parent->inside: avoid");
          return false;
        }
        $p = $p->find_block_parent();
      }
      if ( $p && $p->get_first_child() === $frame) {
         dompdf_debug("page-break", "table: first-row");
        return false;
      }
      if ( $this->_in_table > 1 ) {
        dompdf_debug("page-break", "table: nested table");
        return false;
      }
      dompdf_debug("page-break","table-row/row-groups: break allowed");
      return true;
    } else if ( in_array($display, Table_Frame_Decorator::$ROW_GROUPS) ) {
      return false;
    } else {
      dompdf_debug("page-break", "? " . $frame->get_style()->display . "");
      return false;
    }
  }
  function check_page_break(Frame $frame) {
    if ( $this->_page_full || $frame->_already_pushed ) {
      return false;
    }
    $p = $frame;
    do {
      if ( $p->is_absolute() )
        return false;
    } while ( $p = $p->get_parent() );
    $margin_height = $frame->get_margin_height();
    if ( $frame->get_style()->display === "table-row" &&
         !$frame->get_prev_sibling() && 
         $margin_height > $this->get_margin_height() )
      return false;
    $max_y = $frame->get_position("y") + $margin_height;
    $p = $frame->get_parent();
    while ( $p ) {
      $style = $p->get_style();
      $max_y += $style->length_in_pt(array($style->margin_bottom,
                                           $style->padding_bottom,
                                           $style->border_bottom_width));
      $p = $p->get_parent();
    }
    if ( $max_y <= $this->_bottom_page_margin )
      return false;
    dompdf_debug("page-break", "check_page_break");
    dompdf_debug("page-break", "in_table: " . $this->_in_table);
    $iter = $frame;
    $flg = false;
    $in_table = $this->_in_table;
    dompdf_debug("page-break","Starting search");
    while ( $iter ) {
      if ( $iter === $this ) {
         dompdf_debug("page-break", "reached root.");
        break;
      }
      if ( $this->_page_break_allowed($iter) ) {
        dompdf_debug("page-break","break allowed, splitting.");
        $iter->split(null, true);
        $this->_page_full = true;
        $this->_in_table = $in_table;
        $frame->_already_pushed = true;
        return true;
      }
      if ( !$flg && $next = $iter->get_last_child() ) {
         dompdf_debug("page-break", "following last child.");
        if ( $next->is_table() )
          $this->_in_table++;
        $iter = $next;
        continue;
      }
      if ( $next = $iter->get_prev_sibling() ) {
         dompdf_debug("page-break", "following prev sibling.");
        if ( $next->is_table() && !$iter->is_table() )
          $this->_in_table++;
        else if ( !$next->is_table() && $iter->is_table() )
          $this->_in_table--;
        $iter = $next;
        $flg = false;
        continue;
      }
      if ( $next = $iter->get_parent() ) {
         dompdf_debug("page-break", "following parent.");
        if ( $iter->is_table() )
          $this->_in_table--;
        $iter = $next;
        $flg = true;
        continue;
      }
      break;
    }
    $this->_in_table = $in_table;
    dompdf_debug("page-break", "no valid break found, just splitting.");
    if ( $this->_in_table ) {
      $iter = $frame;
      while ($iter && $iter->get_style()->display !== "table-row")
        $iter = $iter->get_parent();
      $iter->split(null, true);
    } else {
      $frame->split(null, true);
    }
    $this->_page_full = true;
    $frame->_already_pushed = true;
    return true;
  }
  function split(Frame $frame = null, $force_pagebreak = false) {
  }
  function add_floating_frame(Frame $frame) {
    array_unshift($this->_floating_frames, $frame);
  }
  function get_floating_frames() { 
    return $this->_floating_frames; 
  }
  public function remove_floating_frame($key) {
    unset($this->_floating_frames[$key]);
  }
  public function get_lowest_float_offset(Frame $child) {
    $style = $child->get_style();
    $side = $style->clear;
    $float = $style->float;
    $y = 0;
    foreach($this->_floating_frames as $key => $frame) {
      if ( $side === "both" || $frame->get_style()->float === $side ) {
        $y = max($y, $frame->get_position("y") + $frame->get_margin_height());
        if ( $float !== "none" ) {
          $this->remove_floating_frame($key);
        }
      }
    }
    return $y;
  }
}
