<?php
class Table_Frame_Decorator extends Frame_Decorator {
  static $VALID_CHILDREN = array("table-row-group",
                                 "table-row",
                                 "table-header-group",
                                 "table-footer-group",
                                 "table-column",
                                 "table-column-group",
                                 "table-caption",
                                 "table-cell");
  static $ROW_GROUPS = array('table-row-group',
                             'table-header-group',
                             'table-footer-group');
  protected $_cellmap;
  protected $_min_width;
  protected $_max_width;
  protected $_headers;
  protected $_footers;
  function __construct(Frame $frame, DOMPDF $dompdf) {
    parent::__construct($frame, $dompdf);
    $this->_cellmap = new Cellmap($this);
    if ( $frame->get_style()->table_layout === "fixed" ) {
      $this->_cellmap->set_layout_fixed(true);
    }
    $this->_min_width = null;
    $this->_max_width = null;
    $this->_headers = array();
    $this->_footers = array();
  }
  function reset() {
    parent::reset();
    $this->_cellmap->reset();
    $this->_min_width = null;
    $this->_max_width = null;
    $this->_headers = array();
    $this->_footers = array();
    $this->_reflower->reset();
  }
  function split(Frame $child = null, $force_pagebreak = false) {
    if ( is_null($child) ) {
      parent::split();
      return;
    }
    if ( count($this->_headers) && !in_array($child, $this->_headers, true) &&
         !in_array($child->get_prev_sibling(), $this->_headers, true) ) {
      $first_header = null;
      foreach ($this->_headers as $header) {
        $new_header = $header->deep_copy();
        if ( is_null($first_header) )
          $first_header = $new_header;
        $this->insert_child_before($new_header, $child);
      }
      parent::split($first_header);
    } else if ( in_array($child->get_style()->display, self::$ROW_GROUPS) ) {
      parent::split($child);
    } else {
      $iter = $child;
      while ($iter) {
        $this->_cellmap->remove_row($iter);
        $iter = $iter->get_next_sibling();
      }
      parent::split($child);
    }
  }
  function copy(DOMNode $node) {
    $deco = parent::copy($node);
    $deco->_cellmap->set_columns($this->_cellmap->get_columns());
    $deco->_cellmap->lock_columns();
    return $deco;
  }
  static function find_parent_table(Frame $frame) {
    while ( $frame = $frame->get_parent() )
      if ( $frame->is_table() )
        break;
    return $frame;
  }
  function get_cellmap() { return $this->_cellmap; }
  function get_min_width() { return $this->_min_width; }
  function get_max_width() { return $this->_max_width; }
  function set_min_width($width) { $this->_min_width = $width; }
  function set_max_width($width) { $this->_max_width = $width; }
  function normalise() {
    $erroneous_frames = array();
    $anon_row = false;
    $iter = $this->get_first_child();
    while ( $iter ) {
      $child = $iter;
      $iter = $iter->get_next_sibling();
      $display = $child->get_style()->display;
      if ( $anon_row ) {
        if ( $display === "table-row" ) {
          $this->insert_child_before($table_row, $child);
          $table_row->normalise();
          $child->normalise();
          $anon_row = false;
          continue;
        }
        $table_row->append_child($child);
        continue;
      } else {
        if ( $display === "table-row" ) {
          $child->normalise();
          continue;
        }
        if ( $display === "table-cell" ) {
          $tr = $this->get_node()->ownerDocument->createElement("tr");
          $frame = new Frame($tr);
          $css = $this->get_style()->get_stylesheet();
          $style = $css->create_style();
          $style->inherit($this->get_style());
          if ( $tr_style = $css->lookup("tr") )
            $style->merge($tr_style);
          $frame->set_style(clone $style);
          $table_row = Frame_Factory::decorate_frame($frame, $this->_dompdf, $this->_root);
          $table_row->append_child($child);
          $anon_row = true;
          continue;
        }
        if ( !in_array($display, self::$VALID_CHILDREN) ) {
          $erroneous_frames[] = $child;
          continue;
        }
        foreach ($child->get_children() as $grandchild) {
          if ( $grandchild->get_style()->display === "table-row" ) {
            $grandchild->normalise();
          }
        }
        if ( $display === "table-header-group" )
          $this->_headers[] = $child;
        else if ( $display === "table-footer-group" )
          $this->_footers[] = $child;
      }
    }
    if ( $anon_row ) {
      $this->_frame->append_child($table_row);
      $table_row->normalise();
      $this->_cellmap->add_row();
    }
    foreach ($erroneous_frames as $frame)
      $this->move_after($frame);
  }
  function move_after(Frame $frame) {
    $this->get_parent()->insert_child_after($frame, $this);
  }
}