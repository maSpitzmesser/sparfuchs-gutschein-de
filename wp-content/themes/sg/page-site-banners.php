<?php /* Template Name: verlinkung Banner */
get_header(); ?>
<style>
textarea {background: url("http://www.sparfuchs-gutschein.de/wp-content/themes/sparfuchs-gutschein/images/text-bg.gif") repeat-x scroll center top transparent;width:617px;height: 107px;border-width: 1px;border-style: solid;border-color: rgb(163, 169, 173) rgb(163, 169, 173) rgb(217, 217, 217);padding: 3px; border-radius: 4px 4px 4px 4px; color: rgb(0, 0, 0);float: right;margin:0;font-size: 13px;}
</style>
<article class="full">
<h1><?php the_title(); ?></h1>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
<br />
<div style="float: left; width: 310px;">
<h3>Small Banner</h3>
<p>Gr&ouml;&szlig;e: 120px X 60px</p>
<p><img style="float: left;" alt="Gelistet auf Sparfuchs-Gutschein.de" src="http://sg.sparfuchs-gutschein.de/banner/smallbanner_120x60.jpg"/></p>
</div>

<div style="float: right; width: 620px;"><br />
<label style="float: left;">Code:</label><br />
<textarea><a title="Gelistet auf Sparfuchs-Gutschein.de" href="http://sparfuchs-gutschein.de" target="_blank"><img alt="Sparfuchs-Gutschein.de dein Gutscheinportal" src="http://sparfuchs-gutschein.de/banner/smallbanner_120x60.jpg" width="120" height="60" border="0" /></a></textarea></div>

<div class="clr"></div>
<br />
<hr class="hrmin" />
<br />


<div style="float: left; width: 310px;">
<h3>Banner</h3>
<p>Gr&ouml;&szlig;e: 150px X 50px</p>
<p><img style="float: left;" alt="Sparfuchs-Gutschein.de" src="http://sg.sparfuchs-gutschein.de/banner/banner_150x50.jpg" width="150" height="50" /></p>
</div>
<div style="float: right; width: 620px;"><br />
<label style="float: left;">Code:</label><br />
<textarea><a title="Gelistet auf Sparfuchs-Gutschein.de" href="http://sparfuchs-gutschein.de" target="_blank"><img alt="Sparfuchs-Gutschein.de dein Gutscheinportal" src="http://sg.sparfuchs-gutschein.de/banner/banner_150x50.jpg" width="150" height="50" border="0" /></a></textarea></div>

<div class="clr"></div>
<br />
<hr class="hrmin" />
<br />
<div style="float: left">
<h3>Large Banner</h3>
<p>Gr&ouml;&szlig;e: 160px X 60px</p>
<p><img style="float: left;" alt="Gutscheine finden &amp; sparen" src="http://sg.sparfuchs-gutschein.de/banner/largebanner_160x60.jpg" width="160" height="60" /></p>
</div>
<div style="float: right; width: 62%"><br />
<label style="float: left;">Code:</label><br />
<textarea><a title="Gelistet auf Sparfuchs-Gutschein.de" href="http://sparfuchs-gutschein.de" target="_blank"><img alt="Sparfuchs-Gutschein.de dein Gutscheinportal" src="http://sg.sparfuchs-gutschein.de/banner/largebanner_160x60.jpg" width="160" height="60" border="0" /></a></textarea></div>

<div class="clr"></div>
<br />
<hr class="hrmin" />
<br />
<div style="float: left">
<h3>Square Banner</h3>
<p>Gr&ouml;&szlig;e: 200px X 200px</p>
<p><img style="float: left;" alt="Gutscheine finden &amp; sparen" src="http://sg.sparfuchs-gutschein.de/banner/squarebanner_200x200.jpg" width="200" height="200" /></p>
</div>
<div style="float: right; width:62%;"><br />
<label style="float: left;">Code:</label><br />
<textarea><a title="Gelistet auf Sparfuchs-Gutschein.de" href="http://sparfuchs-gutschein.de" target="_blank"><img alt="Sparfuchs-Gutschein.de dein Gutscheinportal" src="http://sg.sparfuchs-gutschein.de/banner/squarebanner_200x200.jpg" width="200" height="200" border="0" /></a></textarea></div>

<div class="clr"></div>
<br />
<hr class="hrmin" />
<br />

<h3>Leaderboard</h3>
<p>Gr&ouml;&szlig;e: 728px X 90px</p>
<p><img alt="Gelistet auf Sparfuchs-Gutschein.de" src="http://sg.sparfuchs-gutschein.de/banner/leaderboard_728x90.jpg" width="728" height="90" /><br />
<label style="float: left;">Code:</label><br />
<textarea style="width:940px"><a title="Gelistet auf Sparfuchs-Gutschein.de" href="http://sparfuchs-gutschein.de" target="_blank"><img alt="Gelistet auf Sparfuchs-Gutschein.de" src="http://sg.sparfuchs-gutschein.de/banner/leaderboard_728x90.jpg" width="728" height="90" border="0" /></a></textarea>
			 
<div class="clr"></div>
<p>Weitere Bannergrößen gibst auf Anfrage.</p>

				 
</article>
<?php get_footer(); ?>