<?php /** Template Name: Page with Sidebar */

if ( is_page( 'Kontakt' ) ||  ( 'gutschein-melden' ) || ( 'feedback' ) ) {
	 include dirname(__FILE__).'/templates/forms/_sending_data.php'; 
}

get_header();

setlocale(LC_TIME, 'de_DE.UTF8');

?>
<article class="col-first col span_3_of_4 style-a1">
	<?php if (empty($_GET['lightbox'])) { the_title('<h1>', '</h1>'); }?>

	<?php 
		if ( is_page( 'Kontakt' ) ) {
			include dirname(__FILE__).'/templates/forms/form-kontakt.php'; 
		}  
		elseif ( is_page( 'gutschein-melden' ) ) {
			get_template_part('page-gutschein-melden');
		}
		elseif ( is_page( 'anleitung' ) ) {
           include_once 'templates/pages/page-anleitung.php'; 
		}
		elseif ( is_page( 'feedback' ) ) {
			get_template_part('page-feedback');
		} 
		elseif ( is_page( 'design-aendern' ) ) {
			get_template_part('page-themes');
		} 
		else {
			get_template_part('content');
		}
	?>
</article>
<?php 

if (empty($_GET['lightbox'])) { 
	get_sidebar();
}

get_footer();
?>