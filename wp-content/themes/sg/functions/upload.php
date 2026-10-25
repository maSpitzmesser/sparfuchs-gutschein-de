<?php
  $image    = $_POST['image'];
  $shopname = $_GET['shopname'];
  $shopname = 'mirapodo';
  $location = "/homepages/40/d393556749/htdocs/Sparfuchs-Gutschein/wp-content/themes/sg/images/shop_logos/screenshots/";
  
  $image_parts = explode(";base64,", $image);
  
  $image_base64 = base64_decode($image_parts[1]);
  
  if ($shopname) {
    $filename = $shopname.'.jpg';
  } else {
    $filename = "screenshot_".uniqid().'.jpg';
  }
  

  
  $file = $location . $filename;
  
  file_put_contents($file, $image_base64);
  
  ?>
<object id="screenshot" src="https://www.<?php echo $shopname; ?>.de" ></object>

<script src="/wp-content/themes/sg/js/jquery-3.4.1.min.js"></script>
<script src="/wp-content/themes/sg/js/html2canvas.min.js"></script>
<script type='text/javascript'>
    function screenshot(){
        html2canvas(document.getElementById('screenshot'),{backgroundColor: null}).then(function(canvas) {

            document.body.appendChild(canvas);

            // Get base64URL
            var base64URL = canvas.toDataURL('image/jpeg').replace('image/jpeg', 'image/octet-stream');

            // AJAX request
            jQuery.ajax({
                url: '/wp-content/themes/sg/functions/upload.php',
                type: 'post',
                data: {image: base64URL,shopname: <?php if (!$shopname) {echo '"no_shopname"';} ?>},
                success: function(data){
                    console.log('Upload successfully');
                },

                error: function(data){
                    console.log('Upload failed');
                }
            });
        });
    }
    setTimeout(function(){
        screenshot();
    }, 4000);


</script>

