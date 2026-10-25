<li data-template="offer-sidebar">
    <a title="Alle <?php echo $offer->Shopname; ?> Rabatte"
       href="<?php
           if (get_permalink( $offer->ID )) {
             echo get_permalink( $offer->ID );
           } else {
             echo 'https://sparfuchs-gutschein.de/' . $offer->Shopname;
           }
          ?>">
      <?php get_logo_by_coupon($offer->Shopname); ?>
      <?php echo trim ($offer->Shopname); ?>
    </a>
    <span><?php echo $offer->Title; ?></span>
</li>
