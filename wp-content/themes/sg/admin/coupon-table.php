<?php

function coupon_func() {

  if (!class_exists('WP_List_Table')) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
  }

  class Links_List_Table extends WP_List_Table {

    function __construct() {
      parent::__construct(array(
          'singular' => 'Gutschein',
          'plural' => 'Gutscheine',
          'ajax' => true //We won't support Ajax for this table
      ));
    }

   function column_default( $item, $column_name ) {
    switch( $column_name ) { 
        case 'booktitle':
        case 'author':
        case 'isbn':
            return $item[ $column_name ];
        default:
            return print_r( $item, true ) ; //Show the whole array for troubleshooting purposes
    }
  }

    function get_columns() {
      return $columns = array(
            'cb' => '<input type="checkbox" />',
                        'col_link_shop' => __('Shop', 'mylisttable'),
            'col_link_name' => __('Titel', 'mylisttable'),
            'col_link_description' => __('Description'),
            'col_link_type' => __('Type'),
            'col_link_minimum_order_value' => __('MBW'),
            'col_link_valid_from' => __('gültig von'),
            'col_link_valid_to' => __('gültig bis'),
            'col_link_customers' => __('Kunden'),
            'col_link_code' => __('Code'),
            'col_link_link' => __('Link'),
            //'col_link_frame' => __('Frame'),
            'col_link_public' => __('öffentlich', 'mylisttable')
      );
    }

    function column_cb($item) {
      return sprintf(
              '<input type="checkbox" name="book[]" value="%s" />', $item['ID']
      );
    }

    public function get_sortable_columns() {
      return $sortable = array(
          'col_link_id' => array('link_id'),
          'col_link_name' => array('link_name'),
          'col_link_valid_from' => array('link_valid_from'),
          'col_link_visible' => array('link_visible')
      );
    }
		


    function prepare_items() {
      global $wpdb, $_wp_column_headers;
      $screen = get_current_screen();


      $query = "SELECT c.*, p.* FROM wp_coupons c LEFT JOIN wp_posts p ON ( c.shopid = p.ID )";



      $orderby = !empty($_GET["orderby"]) ? mysql_real_escape_string($_GET["orderby"]) : 'title';
			
      $order = ( ! empty($_GET['order'] ) ) ? $_GET['order'] : 'asc';
			
      if (!empty($orderby) & !empty($order)) {
        $query.=' ORDER BY ' . $orderby . ' ' . $order;
      }


      $totalitems = $wpdb->query($query);

      $perpage = 50;

      $paged = !empty($_GET["paged"]) ? mysql_real_escape_string($_GET["paged"]) : '';

      if (empty($paged) || !is_numeric($paged) || $paged <= 0) {
        $paged = 1;
      }

      $totalpages = ceil($totalitems / $perpage);

      if (!empty($paged) && !empty($perpage)) {
        $offset = ($paged - 1) * $perpage;
        $query.=' LIMIT ' . (int) $offset . ',' . (int) $perpage;
      }

      /* -- Register the pagination -- */
      $this->set_pagination_args(array(
          "total_items" => $totalitems,
          "total_pages" => $totalpages,
          "per_page" => $perpage,
      ));


      /* — Register the Columns — */
      $columns = $this->get_columns();
      $hidden = array();
      $sortable = $this->get_sortable_columns();
      $this->_column_headers = array($columns, $hidden, $sortable);

      /* -- Fetch the items -- */
      $this->items = $wpdb->get_results($query);
    }

    function column_title($item) {

      //Build row actions
      $actions = array(
          'edit' => sprintf('<a href="?page=%s&action=%s&movie=%s">Edit</a>', $_REQUEST['page'], 'edit', $item['ID']),
          'delete' => sprintf('<a href="?page=%s&action=%s&movie=%s">Delete</a>', $_REQUEST['page'], 'delete', $item['ID']),
      );

      //Return the title contents
      return sprintf('%1$s <span style="color:silver">(id:%2$s)</span>%3$s',
              /* $1%s */ $item['title'],
              /* $2%s */ $item['ID'],
              /* $3%s */ $this->row_actions($actions)
      );
    }

    function get_bulk_actions() {
      $actions = array(
          'delete' => 'Löschen'
      );
      return $actions;
    }

    function no_items() {
      _e('Keine Gutscheine gefunden, Bro.');
    }

    function display_rows() {
      //Get the records registered in the prepare_items method
      $records = $this->items;

      //Get the columns registered in the get_columns and get_sortable_columns methods
      list( $columns, $hidden ) = $this->get_column_info();

      //Loop for each record
      if (!empty($records)) {
        foreach ($records as $rec) {

          //Open the line
          echo '<tr id="record_' . $rec->link_id . '">';
          foreach ($columns as $column_name => $column_display_name) {

            //Style attributes for each col
            $class = "class='$column_name column-$column_name'";
            $style = "";
            if (in_array($column_name, $hidden))
              $style = ' style="display:none;"';
            $attributes = $class . $style;
						
						$post_title = stripslashes($rec->post_title);
						

global $wpdb;
	$id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$post_title."'");


						

            //edit link
            $editlink = '/wp-admin/link.php?action=edit&link_id=' . (int) $rec->link_id;
						$editshop = '/wp-admin/post.php?post=' . $id . '&action=edit';

            //Display the cell
            switch ($column_name) {
              case "cb": echo '<td ' . $attributes . '>' . stripslashes($rec->link_id) . '</td>';

                break;
              case "col_link_shop": echo '<td ' . $attributes . '><strong><a href="' . $editshop . '" title="Shop bearbeiten">' . stripslashes($rec->post_title) . '</a></strong></td>';
                              break;
              case "col_link_name": echo '<td ' . $attributes . '><strong><a href="' . $editlink . '" title="Gutschein bearbeiten">' . stripslashes($rec->title) . '</a></strong></td>';
                break;
                            
              case "col_link_description": echo '<td ' . $attributes . '>' . $rec->description . '</td>';
                  break;
							case "col_link_type": echo '<td ' . $attributes . '>' . stripslashes($rec->type) . '</td>';
                 break;
							case "col_link_minimum_order_value": echo '<td ' . $attributes . '>' . stripslashes($rec->minimum_order_value) . ' €</td>';
                break;
              case "col_link_valid_from": echo '<td ' . $attributes . '>' . stripslashes(htmlentities( strftime(' %d.%B.%Y', strtotime( date('d.F.Y', strtotime($rec->valid_from))))) ) . '</td>';
                break;
              case "col_link_valid_to": echo '<td ' . $attributes . '>'     ?>	<?php $time = $rec->valid_to;  if (!empty($rec->valid_to) || $rec->valid_to == NULL) { echo 'Dauer';} else {echo $time; } ?>	<?php echo '</td>';
                break;
              case "col_link_code": echo '<td ' . $attributes . '>' . stripslashes($rec->code) . '</td>';
                break;								
                    case "col_link_customers": echo '<td ' . $attributes . '>'     ?>	
                    <?php 
                     if ( $rec->new_customers == 'YES' && $rec->existing_customers == 'NO') { echo 'Nur für Neukunden'; } 
                else { echo 'Neu- & Bestandskunden'; }
                    ?>	<?php echo '</td>';
                break;
							              case "col_link_link": echo '<td ' . $attributes . '>' . $rec->forwardlink . '</td>';
                break;	
					//case "col_link_frame": echo '<td ' . $attributes . '>' . $rec->frame . '</td>';
                //break;
								
              case "col_link_public": echo '<td ' . $attributes . '>' . $rec->public . '</td>';
                break;
            }
          }


          echo'</tr>';
        }
      }
    }

  }

  $wp_list_table = new Links_List_Table();
  $wp_list_table->prepare_items();

  echo '<div class="wrap">
  <div class="wrap-header">
                <h2><span class="dashicons dashicons-tag"></span>Gutschein Datenbank</h2>
                </div>';
  ?>
  <form method="post">
    <input type="hidden" name="page" value="mylisttable"/>
    </form>
  <?php
  $wp_list_table->search_box('search', 'search_id');
  $wp_list_table->display();
  echo '</div>';
	

	
}
?>