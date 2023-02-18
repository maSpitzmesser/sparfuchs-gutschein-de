      /* cookie vars */
      var cookie_SpellCheck = "SpellCheck";
      var cookie_web_assistent = "web_assistent";

      var cookie_options = {path: '/', expires: 300};


      var get_cookie_SpellCheck = jQuery.cookie(cookie_SpellCheck);
      var get_cookie_web_assistent = jQuery.cookie(cookie_web_assistent);
      /*
       alert(get_cookie_SpellCheck);
       */

      if (get_cookie_SpellCheck != null) {
        jQuery(document).ready(function () {

          jQuery('#spell-check-switch').attr("checked", "checked");
          jQuery('#spell-check-switch').attr('checked', true);

          jQuery(".main").attr({
            "spellcheck": "true",
				"contenteditable": "true"
          });
          jQuery("#website-assistent").attr({
            "spellcheck": "false",
				"contenteditable": "false"
          });
        });
      }


			
			
      if (get_cookie_web_assistent !== 'out' ) {
        jQuery('#website-assistent').removeClass('website-assistent-out').addClass('website-assistent-out');
      } else {
        jQuery('#website-assistent').removeClass('website-assistent-in').addClass('website-assistent-out');
      }

        jQuery('.button-in-out').click(function () {
          if (jQuery('#website-assistent').hasClass('website-assistent-out')) {
            jQuery('#website-assistent').removeClass('website-assistent-out').addClass('website-assistent-in');
            jQuery.removeCookie("web_assistent");
          }
          else {
            jQuery('#website-assistent').removeClass('website-assistent-in').addClass('website-assistent-out');
            jQuery.cookie("web_assistent", "out", {expires: 300});
          }
        });


        jQuery('#website-assistent .button-close').click(function () {
          jQuery('#website-assistent').addClass('hidden');
        });

				
				jQuery('.website-assistent-dropdown-head').click(function () {
          if (jQuery('.website-assistent-dropdown').hasClass('dropdown-open')) {
            jQuery('.website-assistent-dropdown').removeClass('dropdown-open');
          }
          else {
            jQuery('.website-assistent-dropdown').addClass('dropdown-open');
          }
        });
				
				

        jQuery('#spell-check-switch').change(function (event) {
          if (jQuery('#spell-check-switch').is(':checked')) {
				jQuery.cookie('SpellCheck', 'on', {expires: 300});
              jQuery(".main").attr({
                "spellcheck": "true",
					 "contenteditable": "true"
              });
              jQuery("#website-assistent").attr({
                "spellcheck": "false",
					 "contenteditable": "false"
              });
          } else {
            jQuery.removeCookie('SpellCheck');
            jQuery(".main").attr({
              "spellcheck": "false",
				  "contenteditable": "false"
            });
          }
        });

jQuery('.javascript-error').addClass('hidden');