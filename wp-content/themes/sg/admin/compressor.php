<?php
  function minify($buffer) {
    //Kommentare entfernen
    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
    //Entferne: Tabs, Spaces, neue Zeilen, etc.        
    $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
    
    //Unwichtigen Freiraum entfernen
    $buffer = str_replace('{ ', '{', $buffer);
    $buffer = str_replace(' }', '}', $buffer);
    $buffer = str_replace('; ', ';', $buffer);
    $buffer = str_replace(', ', ',', $buffer);
    $buffer = str_replace(' {', '{', $buffer);
    $buffer = str_replace('} ', '}', $buffer);
    $buffer = str_replace(': ', ':', $buffer);
    $buffer = str_replace(' ,', ',', $buffer);
    $buffer = str_replace(' ;', ';', $buffer);
    $buffer = str_replace(';}', '}', $buffer);
    
    return $buffer;
  }
  
  
  function minifyjs($buffer) {
    //Kommentare entfernen
    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
    
    $buffer = preg_replace(array('(( )+\))','(\)( )+)'), ')', $buffer);
    //Entferne: Tabs, Spaces, neue Zeilen, etc.        
    $buffer = str_replace(array("\r\n", "\r", "\n", "\t"), '', $buffer);
    
    return $buffer;
  }

// Adminmenu Optionen erweitern
  function manually_gzipper_add_menu() {
    add_options_page( 'Komprimierung', 'Komprimierung', 7, __FILE__, 'manually_gzipper_option_page' );
  }

// Registrieren der WordPress-Hooks
  add_action( 'admin_menu', 'manually_gzipper_add_menu' );
  
  function manually_gzipper_option_page() {
    ?>
      <style>
          .left-content,
          .right-content {
              width: 50%;
              float: left;
              display: inline-block;
              min-height: 70%;
          }
      </style>


      <div class="wrap">
          <h2>Gzip Komprimierung</h2>
          <p class="description">Alle CSS/JS in einem Verzeichniss werden minifyed, gebündelt und als eine einzelne Datei gespeichtert.</p>
          
          <div class="left-content">
              <h3>CSS:</h3>
              <p class="description">Sparfuchs-Gutschein/wp-content/themes/sg/styles/css/</p>
            
            <?php
              $CSS_files = glob("/homepages/40/d393556749/htdocs/Sparfuchs-Gutschein/wp-content/themes/sg/styles/css/*.css");
              
              echo '<ol>';
              foreach ($CSS_files as $CSS_file){
                $CSS_file = preg_split ("~/~", $CSS_file);
                echo '<li>' . $CSS_file[11] . '</li>';
              }
              echo '</ol>';
            ?>
              <ol>
                  <li>flat.css</li>
              </ol>
              <hr/>
              <p>Summary: <a href="http://sparfuchs-gutschein.de/wp-content/themes/sg/styles/css/sg_min_all_2.css.gz" target="_blank">http://sparfuchs-gutschein.de/wp-content/themes/sg/styles/css/sg_min_all.css.gz</a></p>
              <form method="post" action="">
                  <input class="button-primary" name="gz_it" type="submit" value="CSS komprimieren und veröffentlichen" />
              </form>
          </div>

          <div class="right-content">
              <h3>Javascript:</h3>
              <p class="description">Sparfuchs-Gutschein/wp-content/themes/sg/scripts/</p>
            <?php
              $files = glob("/homepages/40/d393556749/htdocs/Sparfuchs-Gutschein/wp-content/themes/sg/scripts/*.js");
              
              echo '<ol>';
              foreach ($files as $dataJS){
                $dataJS = preg_split ("~/~", $dataJS);
                echo '<li>' . $dataJS[10] . '</li>';
              }
              echo '</ol>';
            ?>
              <hr/>
              <p>Summary: <a href="http://sparfuchs-gutschein.de/wp-content/themes/sg/scripts/sg_min.js.gz" target="_blank">http://sparfuchs-gutschein.de/wp-content/themes/sg/scripts/sg_min.js.gz</a></p>


              <form method="post" action="">
                  <input class="button-primary" name="gz_js_it" type="submit" value="JS komprimieren und veröffentlichen" />
              </form>

          </div>
          
        <?php
          if ( isset($_POST['gz_it']) ) {  // Action wenn Button gedrückt wird
            
            $CSS_files = glob("/homepages/40/d393556749/htdocs/Sparfuchs-Gutschein/wp-content/themes/sg/styles/css/*.css");
            $CSS_datei_min = "";
            $gz_js = gzopen('/homepages/40/d393556749/htdocs/Sparfuchs-Gutschein/wp-content/themes/sg/styles/css/sg_min_all_2.css.gz','w');
            
            foreach($CSS_files as $CSS_single_file) {
              
              $CSS_single_file_size = filesize($CSS_single_file);
              
              $dateifuchs = fopen($CSS_single_file, "r");
              $dateiinhaltfuchs = fread($dateifuchs, $CSS_single_file_size);
              $min_codefuchs = minify($dateiinhaltfuchs);
              gzwrite($gz_js, $min_codefuchs);
            }
            
            //Minifizierte Datei zu einem Gzip-Archiv komprimieren und speichern
            
            
            gzclose($gz_js);
            
            //$dateinamefuchs = '/kunden/homepages/40/d393556749/htdocs/Sparfuchs-Gutschein-static/style/fuchs.css';
            //$dateisizefuchs = filesize($dateinamefuchs);
            //$dateifuchs = fopen($dateinamefuchs, "r");
            //$dateiinhaltfuchs = fread($dateifuchs, $dateisizefuchs);
            //$min_codefuchs = minify($dateiinhaltfuchs);
            //$gzfuchs = gzopen('/kunden/homepages/40/d393556749/htdocs/Sparfuchs-Gutschein-static/style/fuchs.css.gz','w');
            //gzwrite($gzfuchs, $min_codefuchs);
            //gzclose($gzfuchs);
            //fclose($dateifuchs);
            
            $dateinamefuchs = get_stylesheet_directory() . '/styles/flat/theme.css';
            $dateisizefuchs = filesize($dateinamefuchs);
            $dateifuchs = fopen($dateinamefuchs, "r");
            $dateiinhaltfuchs = fread($dateifuchs, $dateisizefuchs);
            $min_codefuchs = minify($dateiinhaltfuchs);
            $gzfuchs = gzopen(get_stylesheet_directory() . '/styles/flat/theme.css.gz','w');
            gzwrite($gzfuchs, $min_codefuchs);
            gzclose($gzfuchs);
            fclose($dateifuchs);
            
            
            $dateiname2 = get_stylesheet_directory() . '/styles/standard/theme.css';
            $dateisize2 = filesize($dateiname2);
            $datei2 = fopen($dateiname2, "r");
            $dateiinhalt2 = fread($datei2, $dateisize2);
            $min_code2 = $dateiinhalt2;
            $gz2 = gzopen(get_stylesheet_directory() . '/styles/standard/theme.css.gz','w');
            gzwrite($gz2, $min_code2);
            gzclose($gz2);
            fclose($datei2);
            
            
            //Theme 3 Pinky
            $dateiname3 = get_stylesheet_directory() . '/styles/pinky/theme.css';
            $dateisize3 = filesize($dateiname3);
            $datei3 = fopen($dateiname3, "r");
            $dateiinhalt3 = fread($datei3, $dateisize3);
            $min_code3 = $dateiinhalt3;
            $gz3 = gzopen(get_stylesheet_directory() . '/styles/pinky/theme.css.gz','w');
            gzwrite($gz3, $min_code3);
            gzclose($gz3);
            fclose($datei3);
            
            
            //Theme 3 gray
            $dateiname4 = get_stylesheet_directory() . '/styles/grey/theme.css';
            $dateisize4 = filesize($dateiname4);
            $datei4 = fopen($dateiname4, "r");
            $dateiinhalt4 = fread($datei4, $dateisize4);
            $min_code4 = $dateiinhalt4;
            $gz4 = gzopen(get_stylesheet_directory() . '/styles/grey/theme.css.gz','w');
            gzwrite($gz4, $min_code4);
            gzclose($gz4);
            fclose($datei4);
          }
     
      // Javascript minify
          
          require ('JShrink/Minifier.php');
          
          if ( isset($_POST['gz_js_it']) ) {  // Action wenn Button gedrückt wird
            
            $JS_files = glob("/homepages/40/d393556749/htdocs/Sparfuchs-Gutschein/wp-content/themes/sg/scripts/*.js");
            $js_datei_min = "";
            foreach($files as $JS_file) {
              $js_datei_min .= \JShrink\Minifier::minify(file_get_contents($JS_file));
            }
            
            //Minifizierte Datei zu einem Gzip-Archiv komprimieren und speichern
            $gz_js = gzopen('/homepages/40/d393556749/htdocs/Sparfuchs-Gutschein/wp-content/themes/sg/scripts/sg_min.js.gz','w');
            gzwrite($gz_js, $js_datei_min);
            gzclose($gz_js);
          }
        ?>
      </div>
    <?php
  }
?>