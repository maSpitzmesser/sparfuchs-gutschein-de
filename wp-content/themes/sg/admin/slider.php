<?php
function slider_db() {
		global $wpdb;

?>
  <div class="wrap">
    <h2>Slider Manager <a href="admin.php?page=slider-db" class="page-title-action">Neuer Slider Hinzufügen</a></h2>		
		
<?php 
		if ( isset( $_POST["aktiviert"]) ) {
			$online = $_POST["online_" . $id];
	$theID = $_POST["sliderID"];
	$query = "UPDATE wp_slider SET active=0 WHERE slid=$theID ";
	$update = $wpdb->query($query);

	
			$sql = "SELECT *	FROM wp_slider ORDER BY slid DESC";		
			$slides = $wpdb->get_results($sql); 
		}
		if ( isset( $_POST["deaktiviert"]) ) {
			
				$online = $_POST["online_" . $id];
	$theID = $_POST["sliderID"];
	$query = "UPDATE wp_slider SET active=1 WHERE slid=$theID";
	$update = $wpdb->query($query);
	
	

	
			$sql = "SELECT *	FROM wp_slider ORDER BY slid DESC";		
			$slides = $wpdb->get_results($sql); 
		} else  {
			$sql = "SELECT *	FROM wp_slider ORDER BY slid DESC";		
			$slides = $wpdb->get_results($sql); 
		}
?>
		
		
		
		<div id="message" class="updated fade below-h2">
			<p>Alle Bilder die bei online einen Hacken haben sind für die zufällige Auswahl freigegeben und online sichtbar.</p>
			<p>Ich habe die Startseite auf maximal 4 zufälligen Slides beschränkt, damit die Ladezeit nicht unter zuvielen Bilder leidet.</p>
		</div>
		

		
		<table class="wp-list-table widefat striped">
			<thead>
			<tr>
				<th>online</th>
				<th>Vorschau</th>
				<th>Shop</th>
				<th>url</th>
				<th>Gültig bis:</th>
				<th>Löschen</th>
			</tr>
		 </thead>
		 <tbody id="the-list">

			<?php 
			foreach ($slides as $slide): 
				if ( isset( $_POST["sl_del_" . $id]) ) {
					$del = "DELETE FROM wp_slider WHERE slid = '$id' ";
					$update = $wpdb->query($del);
			?>			
					<div id="message" class="error fade below-h2">
						<p>Bild "<strong><?php echo $_POST['title'];  ?></strong>" wurde gelöscht, Bro.</p>
					</div>		
					<hr/>
					<script>document.getElementById("<?php echo $id; ?>").style.display="none";</script>								
			<?php 			
				}
				?>

				
				
				







	<tr valign="top" id="<?php $id = $slide->slid; echo $id; ?>">
		<td>
			
				<?php if ($slide->active == 1){ ?>
					<form method="POST" action="" name="aktiviert">
						<input name="aktiviert" value="yes" type="hidden" />
						<input name="sliderID" value="<?php echo $id; ?>" type="hidden" />
						<input type="checkbox" name="online_<?php echo $id; ?>" value="0"  onclick="this.form.submit();" checked="checked" />
						<span style="color:#038803"><?php	echo 'aktiviert'; ?></span>
					</form>
				<?php
				} 
					if ($slide->active == 0){  ?>
					<form method="POST" action="" name="deaktiviert">
						<input name="deaktiviert" value="no" type="hidden" />
						<input name="sliderID" value="<?php echo $id; ?>" type="hidden" />
						<input type="checkbox" name="online_<?php echo $id; ?>" value="1" onclick="this.form.submit();"/>
						<span style="color:#CF000F"><?php	echo 'deaktiviert'; ?></span>
					</form>				
			<?php
				} 
				?>
		</td>

		<td>
			<img alt="" src="	<?php echo $slide->img_link; ?>" width="" height="70" />
		</td>

		<td>
			<?php echo $slide->shop; ?>
		</td>

		<td>
			<?php echo $slide->url; ?>
		</td>

		<td>
			<?php 
			if (empty($slide->valid_to)) {
				echo 'Dauer';				
			} else {
				echo $slide->valid_to;
			}
			 ?>
		</td>

		<td style="position:relative">
			<form method="POST" action="" ><input title="Löschen" name="sl_del_<?php echo $id; ?>" class="button-delete" value="✕" type="submit"/></form>
		</td>
	</tr>


	
<?php	endforeach; ?>

	</tbody>
 </table>
 <br/>
 <p class="description">Wenn das Datum abgelaufen ist, wird der Gutschein/Slider automatisch entfernt.</p>
 
</div>
 
 
 
 
 
 
 
 

 
 
 
 <?php	
			
				
				
 
}


function slider_options() { 
global $wpdb;
?>

  <div class="wrap"><div id="icon-options-general" class="icon32"></br></div>								
    <h2>Slider</h2>

    <?php if ($_FILES["file"]["type"] == "image/gif") { ?>
      <div id="message" class="updated error fade below-h2">
        <p>Bro! Gif's sind out. Speicher denn scheiss als png oder jpg.</p>
      </div>
    <?php } ?>
		
		<?php if ( ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/pjpeg") ) { ?>
      <div id="message" class="updated error fade below-h2">
        <p>Bitte als PNG speichern und dann Komprimieren.<br/>
				JPGs sind nach der Kompression zu unscharf, Bro!</p>
      </div>
    <?php } ?>

    <?php if ($_FILES["file"]["size"] > 82000) { ?>
      <div id="message" class="updated error fade below-h2">
        <p>Image zu groß. Maximal 80Kb, Bro</p>
      </div>
    <?php } ?>					


    <?php if (!isset($_FILES['file'])) { ?>
      <div id="message" class="updated fade below-h2">
        <p>Slider Image hochladen und direkt online stellen. Bild muss die maße <strong>600 px x 250 px</strong> haben und ein <strong>PNG</strong> sein.<br/>
				Die Photoshop Vorlage kannst du <a class="download psd" title="Vorlage Banner"  href="http://sg.sparfuchs-gutschein.de/slider/Vorlage-Banner-Modern.psd">hier downloaden</a>.</p>
        <p>Aber bitte die PNG Datei vorher hier <a  href="https://tinypng.com/" target="_blank">  Komprimieren.</a></p>
      </div>		<?php
    }

    if (isset($_FILES['file'])) {
      if (file_exists("/homepages/40/d393556749/htdocs/Sparfuchs-Gutschein/wp-content/themes/sg/images/slider/" . $_FILES["file"]["name"])) {
        ?>
        <div id="message" class="updated success fade below-h2">
          <p>Dieses Image gab es schon, ich habe es aber trotzdem ersetzt, Bro.<br/> Du solltest dann, zwegs dem cache, die Seite auf der das Bild angezeigt 2 - 3 mal neu laden! </p>
          <p>Alles Super kein Panik, Bro.</p>
        </div>
        <?php
      }
    }

    $shopid = $_POST["shop"];
    $valid_to = $_POST["valid_to"];
    $url = get_permalink($shopid);
    $shop = get_the_title($shopid);
    $img_link = 'https://sparfuchs-gutschein.de/wp-content/themes/sg/images/slider/' . $_FILES["file"]["name"];
    $active = 1;
    
    $ist   = array('-', '.jpg' , '.png' );
    $soll = array(' ', ''       , '' );
    $img_alt = str_replace($ist, $soll, $_FILES["file"]["name"]);

    $allowedExts = array("gif", "jpeg", "jpg", "png");
    $temp = explode(".", $_FILES["file"]["name"]);
    $extension = end($temp);

    if (( ($_FILES["file"]["type"] == "image/x-png") || ($_FILES["file"]["type"] == "image/png") ) && ($_FILES["file"]["size"] < 82000) && in_array($extension, $allowedExts)) {
      if ($_FILES["file"]["error"] > 0) {
        echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
      } else {
        move_uploaded_file($_FILES["file"]["tmp_name"], "/homepages/40/d393556749/htdocs/Sparfuchs-Gutschein/wp-content/themes/sg/images/slider/" . $_FILES["file"]["name"]);


        if (isset($_FILES['file'])) {
          if (!file_exists("/homepages/40/d393556749/htdocs/Sparfuchs-Gutschein/wp-content/themes/sg/images/slider/" . $_FILES["file"]["name"])) {
							echo '<div id="message" class="updated success fade below-h2">
												<p>Ok, das Bild ist ' . ($_FILES["file"]["size"] / 1024) . ' kB groß.
																		Habe es unter: ' . 'https://sparfuchs-gutschein.de/wp-content/themes/sg/images/slider/' . $_FILES["file"]["name"] . ' gespeichert, Bro!</p>
										</div>';
          }
        }

        if ($valid_to === '') {
			$valid_to = NULL;
        } else {
            $valid_to = date("Y-m-d", strtotime($valid_to));
        }

        $sql = "INSERT INTO wp_slider (slid, active, img_link, img_alt, url, shop, valid_to) VALUES ( NULL, $active, '$img_link', '$img_alt', '$url', '$shop', '$valid_to')";
		$wpdb->query($sql);
        
      }
    }
    ?>
    <br/>

    <form action="" method="post" enctype="multipart/form-data">

      <table class="form-table">

        <tbody>
          <tr>
            <th scope="row"><label for="shop">Für welchen Shop?</label></th>
            <td>
              <select name="shop">
                <?php
                global $post;
                $args = array('numberposts' => -1, 'post_type' => 'post', 'post_status' => 'publish', 'orderby' => 'title', 'order' => 'ASC');
                $posts = get_posts($args);
                foreach ($posts as $post) : setup_postdata($post);
                  ?>
                  <option value="<? echo $post->ID; ?>"><?php the_title(); ?></option>
                <?php endforeach; ?>
              </select>
              <p class="description">Selektieren und auf der Tastertur den Anfangsbuchstaben drücken für schnelleres Finden.</p>
            </td>
          </tr>
					
          <tr>
            <th scope="row"><label for="valid_to">Ist gültig bis:</label></th>
            <td><input id="datepicker" autocomplete="off" name="valid_to" value="" class="regular-text" type="text"/>
            </td>
          </tr>

          <tr>
            <th scope="row"></th>
            <td><input type="file" name="file" id="file"/>
              <input class="button-primary" type="submit" name="submit" value="Hochladen und online stellen!"/>
            </td>
          </tr>
					
					     </tbody>
      </table>
			
 
			
    </form>
    <?php
    echo '</div>';
  }
  ?>