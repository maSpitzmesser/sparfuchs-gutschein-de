<?php function page_webservice(){
 global $xml_products_zanox;
  global $xml_offers_zanox;
 global $xml_programs_zanox;
 ?>

 <script>
jQuery(".tabs li").click(function () {
  var num = jQuery(".tabs li").index(this);
  jQuery(".tab-content").addClass('hidden');
  jQuery(".tab-content").eq(num).removeClass('hidden');
  jQuery(".tabs li").removeClass('active');
  jQuery(".tabs li").eq(num).addClass('active');
});
 </script>


<div class="wrap">

    <div class="wrap-header">
    <h1><span class="dashicons dashicons-cloud"></span> Webservice</h1>

      <ul  id="nav">
        <li>Affilinet</li>
        <li class="active">Zanox</li>
      </ul>

    <p class="description">Diese Gutscheine/Angebote wurden gerade per Service abgerufen und können von der aktuellen Datenbank abweichen!</p>
  </div>

   <ul class="tabs" id="nav">
    <li>Programme (<span style="color:#689D00;"><?php echo count($xml_programs_zanox->programItem); ?></span>)</li>
    <li class="active">Gutscheine/Angebote (<span style="color:#689D00;"><?php echo count($xml_offers_zanox); ?></span>)</li>
    <li>Produkte (<span style="color:#689D00;"><?php //echo count($xml_products_zanox); ?></span>)</li>
  </ul>

  <div class="tab-content">


  <table class="wp-list-table widefat striped shops">
	<thead>
		<tr>
            <th>Program ID<br/> Zanox</th>
			<th>Program Name<br/> Zanox</th>
            <th>URL</th>
			<th>status</th>
		</tr>
	</thead>
	<tbody>



  <?php

    foreach ($xml_programs_zanox->programItem as $program) {

        echo '<tr>';
        echo '<td>'. $program['id'] .' </td>';
        echo '<td>'. $program->children( 'ns2', true )->name .' </td>';
        echo '<td>'. $program->children( 'ns2', true )->url .' </td>';
        echo '<td>'. $program->children( 'ns2', true )->status .' </td>';
    echo '</tr>';
  }    ?>


  	</tbody>
</table>



   <?php // echo '<pre>' ; print_r($xml_programs_zanox); echo '</pre>' ; ?>
  </div>

    <div class="tab-content hidden">
  <?php print_r($xml_offers_zanox); ?>
  </div>

    <div class="tab-content hidden">
  <?php print_r($xml_products_zanox); ?>
  </div>



</div><!-- END wrap -->






<?php } // END page_webservice ?>
