<h1 class="headline-a1"><?php the_title(); ?></h1>
<h2>Die neusten Gutscheine im <?php setlocale(LC_TIME, 'de_DE.UTF8'); echo strftime(' %B %Y' ); ?></h2>
<ul class="c"><?php new_vouchers_site(); ?></ul>