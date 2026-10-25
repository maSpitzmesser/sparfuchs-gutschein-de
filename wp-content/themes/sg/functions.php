<?php
add_filter('xmlrpc_enabled', '__return_false');
	

 // Algemeine Template Funktionen

include_once ('functions/function-wordpress.php');

include_once ('functions/function-slider.php');

include_once ('functions/function-coupons.php');

include_once ('functions/function-widgets.php');

include_once ('functions/function-breadcrumb.php');

include_once ('functions/function-rating.php');

if ( is_admin() ) {
    include_once ('admin/admin-functions.php');
}
  /* ----------------------------------------------------------------------------

   W3C Fix and HTML minifier by Ivijan-Stefan Stipic <infinitumform@gmail.com>

---------------------------------------------------------------------------- */
  add_action('wp_loaded', 'atm_output_buffer_start');
  add_action('shutdown', 'atm_output_buffer_end');
  
  function atm_output_buffer_start() {
    ob_start("atm_output_callback");
  }
  
  function atm_output_buffer_end() {
    ob_get_clean();
  }
  
  function atm_output_callback($buffer) {
    if(!is_admin() && !(defined('DOING_AJAX') && DOING_AJAX))
    {

      // clear HEAD
      $buffer = preg_replace_callback('/(?=<head(.*?)>)(.*?)(?<=<\/head>)/s',
        function($matches) {
          return preg_replace(array(
            '/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', // delete HTML comments
            /* Fix HTML */
            '/\>[^\S ]+/s',  // strip whitespaces after tags, except space
            '/[^\S ]+\</s',  // strip whitespaces before tags, except space
            '/\>\s+\</',    // strip whitespaces between tags
          ), array(
            '',
            /* Fix HTML */
            '>',  // strip whitespaces after tags, except space
            '<',  // strip whitespaces before tags, except space
            '><',   // strip whitespaces between tags
          ), $matches[2]);
        }, $buffer);
      // clear BODY
      $buffer = preg_replace_callback('/(?=<body(.*?)>)(.*?)(?<=<\/body>)/s',
        function($matches) {
          return preg_replace(array(
            '/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', // delete HTML comments
            /* Fix HTML */
            '/\>[^\S ]+/s',  // strip whitespaces after tags, except space
            '/[^\S ]+\</s',  // strip whitespaces before tags, except space
            '/\>\s+\</',    // strip whitespaces between tags
          ), array(
            '', // delete HTML comments
            /* Fix HTML */
            '>',  // strip whitespaces after tags, except space
            '<',  // strip whitespaces before tags, except space
            '> <',   // strip whitespaces between tags
          ), $matches[2]);
        }, $buffer);
      $buffer = preg_replace_callback('/(?=<script(.*?)>)(.*?)(?<=<\/script>)/s',
        function($matches) {
          return preg_replace(array(
            '@\/\*(.*?)\*\/@s', // delete JavaScript comments
            '@((^|\t|\s|\r)\/{2,}.+?(\n|$))@s', // delete JavaScript comments
            '@(\}(\n|\s+)else(\n|\s+)\{)@s', // fix "else" statemant
            '@((\)\{)|(\)(\n|\s+)\{))@s', // fix brackets position
            //'@(\}\)(\t+|\s+|\n+))@s', // fix closed functions
            '@(\}(\n+|\t+|\s+)else\sif(\s+|)\()@s', // fix "else if"
            '@(if|for|while|switch|function)\(@s', // fix "if, for, while, switch, function"
            '@\s+(\={1,3}|\:)\s+@s', // fix " = and : "
            '@\$\((.*?)\)@s', // fix $(  )
            '@(if|while)\s\((.*?)\)\s\{@s', // fix "if|while ( ) {"
            '@function\s\(\s+\)\s{@s', // fix "function ( ) {"
            '@(\n{2,})@s', // fix multi new lines
            '@([\r\n\s\t]+)(,)@s', // Fix comma
            '@([\r\n\s\t]+)?([;,{}()]+)([\r\n\s\t]+)?@', // Put all inline
          ), array(
            "\n", // delete JavaScript comments
            "\n", // delete JavaScript comments
            '}else{', // fix "else" statemant
            '){', // fix brackets position
            //"});\n", // fix closed functions
            '}else if(', // fix "else if"
            "$1(",  // fix "if, for, while, switch, function"
            " $1 ", // fix " = and : "
            '$'."($1)", // fix $(  )
            "$1 ($2) {", // fix "if|while ( ) {"
            'function(){', // fix "function ( ) {"
            "\n", // fix multi new lines
            ',', // fix comma
            "$2", // Put all inline
          ), $matches[2]);
        }, $buffer);
      // Clear CSS
      $buffer = preg_replace_callback('/(?=<style(.*?)>)(.*?)(?<=<\/style>)/s',
        function($matches) {
          return preg_replace(array(
            '/([.#]?)([a-zA-Z0-9,_-]|\)|\])([\s|\t|\n|\r]+)?{([\s|\t|\n|\r]+)(.*?)([\s|\t|\n|\r]+)}([\s|\t|\n|\r]+)/s', // Clear brackets and whitespaces
            '/([0-9a-zA-Z]+)([;,])([\s|\t|\n|\r]+)?/s', // Let's fix ,;
            '@([\r\n\s\t]+)?([;:,{}()]+)([\r\n\s\t]+)?@', // Put all inline
          ), array(
            '$1$2{$5} ', // Clear brackets and whitespaces
            '$1$2', // Let's fix ,;
            "$2", // Put all inline
          ), $matches[2]);
        }, $buffer);
      
      // Clean between HEAD and BODY
      $buffer = preg_replace( "%</head>([\s\t\n\r]+)<body%", '</head><body', $buffer );
      // Clean between BODY and HTML
      $buffer = preg_replace( "%</body>([\s\t\n\r]+)</html>%", '</body></html>', $buffer );
      // Clean between HTML and HEAD
      $buffer = preg_replace( "%<html(.*?)>([\s\t\n\r]+)<head%", '<html$1><head', $buffer );
    }
    
    return $buffer;
  }

// dont close php