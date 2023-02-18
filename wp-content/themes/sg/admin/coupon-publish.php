<?php
function coupon_publish(){	
	
 echo '
	<style>
.c {
    margin:0 0 20px 0;
    padding:0;
	position:relative;
	min-width: 100%
}

.nk,.bk,.mb,.kmb,.vato,.dbtn,.mc .se {
  display:block;
  padding:0 0 0 20px
}
ul.c li, 
ul.cs li {
	position:relative;
   width: 100%;
	height:100px;
	padding: 5px 0px;
	cursor:pointer
}

.cs li img {
	float:left;
	margin:2px 5px 0 5px
}
.cs li .mc {
	width:50%;
	overflow:hidden
}
.cs li .mc .count {
	position:static;
	margin:0 0 3px 0
}

.c li img {
    margin: 0px 5% 0px 1%;
}
.c li img {
	float:left;
	max-width:15%
}


.mc {
	float:left;
  width:58%;
  height:93px
}

.mc p:first-child {
	overflow: hidden
}

.mc p {
color:#ff5800 !important;
   text-align:left !important;
	margin:0 !important;
	font-size:140%;
	padding:2px 2px 4px 0
}

.mc b {
	font-size:100%
}

.mc p:nth-child(2) {
	font-size:16px;
	margin-bottom:0 !important
}
.rc {
	width:40%;
	float:right;
	text-align:left
}

.rc:after {
  content:"";
	position:absolute;
	width:45px;
	height:45px;
	right:5px;
	top:9px
}
.vato {
  	color:#699d00
}
.rc .b {
	margin:30px 0 0 0;
	padding:3px 0 5px 0;
	display:inline-block;
	font-size:105%;
	width:100%;
	text-align:center
}

.rc .b:hover:before {
	width:20px;
	height:20px
}


.count {
	position:absolute;
	display:inline-block;
	top:35px;
	left:460px;
	margin:3px 0 0 0;
	width:auto;
	padding:0 2px
}
.code {
	position:absolute;
	height:20px;
	width:250px;
	z-index:-1;
	opacity:1.0
}
.detail {
	position:absolute;
	right:50px;
	top:35px;
	padding:2px 5px 0 18px;
	z-index:3
}

.dt{display:none;float:left}
.dt ul{float:right;width:575px}
.dt ul li{font-size:16px;float:left;padding:0 18px}

.la {
	float:left;
	position:relative;
	padding:4px 0 5px 0;
	margin:5px 15px 0 8px;
	width:127px;
	font-size:25px;
	text-align:center
}
.la:before {
	content:"";
	position:absolute;
	left:2px;
	right:2px;
	top:2px;
	bottom:2px
}
.noc {
    background: none repeat scroll 0% 0% #FFFFE0;
    border: 1px solid #E6DB55;
    padding: 8px 17px 3px
}				
					
		ul.c li, ul.cs li {
    position: relative;
    width: 100%;
    height: 100px;
    padding: 5px 0px;
    cursor: pointer;
border-bottom: 1px solid #DBDBDB;
box-shadow: 0px 1px 0px #FFF;
}				
		
input.button-primary {margin:10px 0 0 0;}
</style>
								
								
								
								
								
								<div class="wrap"><div id="icon-options-general" class="icon32"><br></div>
                <h2>Gutscheine zur Bearbeitung.</h2>								
						
								';
								
	global $wpdb;

	$is_active  = get_post_meta(get_the_ID(), 'gf_feed_active', true);
	$domain     = get_post_meta(get_the_ID(), 'gf_shopdomain',  true);
  
	$ist  = array('');
	$soll = array('');

        $sql = "SELECT c.*, p.*
					FROM wp_coupons c
					LEFT JOIN wp_posts p ON ( c.shopid = p.ID )
					 WHERE c.public = 0
					ORDER BY c.shopid DESC";        

        $coupons = $wpdb->get_results($sql);

		if (count($coupons)) {
		
		

			echo '
			
			<div id="message" class="updated fade below-h2">
								<p>Gutscheine nach dem Import von Afilli.net werden hier zur Bearbeitung des Titels geparkt und erst nach Klick auf den Button "Gutschein veröfentlichen" online gestellt.</p></div>
			<hr/>
			<ul class="c">';
			
			foreach ($coupons as $offer): 
			
			$time = htmlentities( strftime(' %d. %B %Y', strtotime( date('d.F.Y', strtotime($offer->valid_to))))); 
			$offer->title = str_replace($ist, $soll, $offer->title); 
			
			$id = $offer->id;
			
			
			
				// Gutschein ändern
	if ( isset( $_POST["g_pub_" . $id]) ) {
		if ( !empty( $_POST['title'] ) ) {

				global $wpdb;
				$shopid = $_POST["shopid"];
			
				$title = $valid_to = $_POST["Exklusiv"] . $_POST["title"];
				$type = $_POST["type"];
				
				$worth = $_POST["worth"];
				$unit = $_POST["unit"];				
				
				$minimum_order_value = $_POST["minimum_order_value"];
				
				$existing_customers = $_POST["existing_customers"];
				$new_customers = $_POST["new_customers"];
				
				$description = $_POST["description"];
				$guide = $_POST["guide"];
				
				$forwardlink = $_POST["aff_link"];				
				$frame = $_POST["frame"];
				
			$public = $_POST["public"];			
				
			$aendern = "UPDATE wp_coupons Set title='$title', public='1' WHERE id = '$id' ";
		
			$wpdb->query($aendern);
			

		}
	}
	
	

			
			?>			
			<!-- start -->
	<li id="<?php echo $offer->id; ?>"><form method="POST" action=""><?php
	
			$shopname = $offer->post_title;
			
    get_logo($shoplogo_large, $shopname);

    ?><div class="mc">
	<p><input type="text" name="title" value="<?php echo $offer->title;  ?>" style="padding:5px;font-size:16px;width:98%;" /></p>
	<?php
if ($offer->new_customers == 'YES' && $offer->existing_customers == 'YES'): echo '<span class="bk">Neu- &amp; Bestandskunden</span>'; 
elseif ($offer->new_customers == 'YES'): echo '<span class="nk">Nur für Neukunden</span>'; 
elseif ($offer->existing_customers == 'YES'): echo '<span class="bk">Nur für Bestandskunden</span>'; 
endif;

if (!empty($offer->minimum_order_value)): echo '<span class="mb">Mindestbestellwert:' . $offer->minimum_order_value . ' €</span>'; 
elseif (isset($offer->minimum_order_value)) : echo '<span class="kmb">Kein Mindestbestellwert</span>'; 
endif; ?>
</div>

<br/>
<input title="Speichern" name="g_pub_<?php echo $offer->id; ?>" class="button-primary button-large" value="veröffentlichen" type="submit"/>

<span  class="button-edit">
<input title="bearbeiten" name="g_edit_<?php echo $offer->id; ?>" value="" type="submit"/>
</span>

<input title="Löschen" name="g_del_<?php echo $offer->id; ?>" class="button-delete" value="X" type="submit"/>
</form></li>
			<!-- ende-->
			
			<?php		
			
			
							if ( isset( $_POST["g_del_" . $id]) ) {
		if ( isset( $_POST['title'] ) ) {		
		global $wpdb;
				$shopid = $_POST["shopid"];				
			$del = "DELETE FROM wp_coupons WHERE id = '$offer->id' ";
			$wpdb->query($del);
			?>
			<div id="message" class="error fade below-h2">
								<p>Gutschein "<strong><?php echo $_POST['title']; ?></strong>" wurde gelöscht, Bro.</p>
								</div>
								<hr/>
								<script>document.getElementById("<?php echo $offer->id; ?>").style.display="none";</script>
								
			<?php 
			
			
		}
	}	
			
			
			
			
			
			
			
			
			endforeach; 		
			
			echo '</ul>';
			

			
			
		
		}
		else { echo'<div id="message" class="updated success fade below-h2"><p>Alle fertig bearbeitet, Bro</p></div>';}
						
								
								
 echo'</div>';
}
?>