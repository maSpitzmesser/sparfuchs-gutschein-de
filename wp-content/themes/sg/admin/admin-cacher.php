<?php
function cacher_site() {

global $post;
global $wpdb;
$args = array('numberposts' => -1, 'post_type' => 'post', 'post_status' => 'publish', 'orderby' => 'title', 'order' => 'ASC');
$posts = get_posts($args);
?>

<div class="wrap">


<h2>Feedbacks</h2>
<div id="message" class="updated error fade below-h2">
<p>Webseite wird komplett gecacht, Bro!!!!!!!!!</p>
<p>Das dauert mindestens 15 Minuten und legt dein Browser lahm, Bro!!!!!!!!!</p>
</div>



<style>
iframe {width:1px;height:5px;float:left}
</style>
  
<?php if (isset($_POST['cache_it'])) { 

echo '
<iframe src="http://sparfuchs-gutschein.de/auto-motorrad/"></iframe>
<iframe src="http://sparfuchs-gutschein.de/beauty-wellness/"></iframe>
<iframe src="http://sparfuchs-gutschein.de/blumen-geschenke/"></iframe>
<iframe src="http://sparfuchs-gutschein.de/brillen-kontaklinsen/"></iframe>
<iframe src="http://sparfuchs-gutschein.de/buecher/"></iframe>
<iframe src="http://sparfuchs-gutschein.de/buero-beruf/"></iframe>
<iframe src="http://sparfuchs-gutschein.de/computer-zubehoer/"></iframe>
<iframe src="http://sparfuchs-gutschein.de/elektronik-zubehoer/"></iframe>
<iframe src="http://sparfuchs-gutschein.de/gaming-konsolen/"></iframe>
<iframe src="http://sparfuchs-gutschein.de/gesundheit/"></iframe>
<iframe src="http://sparfuchs-gutschein.de/haus-garten/"></iframe>
<iframe src="http://sparfuchs-gutschein.de/haustiere-zubehoer/"></iframe>
<iframe src="http://sparfuchs-gutschein.de/hobby-freizeit/"></iframe>
<iframe src="http://sparfuchs-gutschein.de/internet-homepage/"></iframe>
<iframe src="http://sparfuchs-gutschein.de/kinder-spielzeug/"></iframe>
<iframe src="http://sparfuchs-gutschein.de/mode-accessoires/"></iframe>
<iframe src="http://sparfuchs-gutschein.de/musik-filme/"></iframe>
<iframe src="http://sparfuchs-gutschein.de/nahrungsmittel-getraenke/"></iframe>
<iframe src="http://sparfuchs-gutschein.de/partner-liebe/"></iframe>
<iframe src="http://sparfuchs-gutschein.de/reise-urlaub/"></iframe>
<iframe src="http://sparfuchs-gutschein.de/schuhe-taschen/"></iframe>  
<iframe src="http://sparfuchs-gutschein.de/sport-fitness/"></iframe>
<iframe src="http://sparfuchs-gutschein.de/uhren-schmuck/"></iframe>
<iframe src="http://sparfuchs-gutschein.de/versandhandel/"></iframe>';

sleep(5);

foreach ($posts as $post) : setup_postdata($post);
echo '<iframe src="' . get_permalink( $post->ID ) . '"></iframe>';
endforeach; 

 }
?>

<form action="" method="post" enctype="multipart/form-data">
      <table class="form-table">
        <tbody>				
          <tr>
            <th scope="row"></th>
            <td>
              <input class="button-primary" type="submit" name="cache_it" value="Cache alles!"/>
            </td>
          </tr>				
					      </tbody>	
      </table>			
		
    </form>

 <?php
 }
?>