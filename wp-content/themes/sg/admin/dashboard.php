<?php
// Dashboard Widgets by Markus
 
function my_custom_dashboard_widgets() {
	global $wp_meta_boxes;

	wp_add_dashboard_widget('sparfuchs-statistik', 'Sparfuchs Statistik', 'dashboard_charts');
}

// creates the charts on the dashboard
function dashboard_charts() {
        global $wpdb;

        $sql = "SELECT COUNT(post_title) as total, post_date FROM ". $wpdb->posts ." WHERE post_type = 'post' AND post_date > '" . date('Y-m-d', strtotime('-30 days')) . "' GROUP BY DATE(post_date) DESC";
        $results = $wpdb->get_results($sql);

        $posts = array();

        // put the days and total posts into an array
        foreach ($results as $result) {
                $the_day = date('Y-m-d', strtotime($result->post_date));
                $posts[$the_day] = $result->total;
        }

        // setup the last 30 days
        for($i = 0; $i < 30; $i++) {
                $each_day = date('Y-m-d', strtotime('-'. $i .' days'));

                // if there's no day with posts, insert a goose egg
                if (!in_array($each_day, array_keys($posts))) $posts[$each_day] = 0;
        }

        // sort the values by date
        ksort($posts);
  
  
  
        $sql = "SELECT COUNT(title) as total, valid_from FROM wp_coupons WHERE valid_from > '" . date('Y-m-d', strtotime('-30 days')) . "' GROUP BY DATE(valid_from) DESC";
        $results = $wpdb->get_results($sql);

        $coupons = array();

        // put the days and total posts into an array
        foreach ($results as $result) {
                $the_day = date('Y-m-d', strtotime($result->valid_from));
                $coupons[$the_day] = $result->total;
        }

        // setup the last 30 days
        for($i = 0; $i < 30; $i++) {
                $each_day = date('Y-m-d', strtotime('-'. $i .' days'));

                // if there's no day with posts, insert a goose egg
                if (!in_array($each_day, array_keys($coupons))) $coupons[$each_day] = 0;
        }

        // sort the values by date
        ksort($coupons);

  
        $sql = "SELECT COUNT(title) as total, valid_from FROM wp_gutschein_feed_offers WHERE valid_from > '" . date('Y-m-d', strtotime('-30 days')) . "' GROUP BY DATE(valid_from) DESC";
        $results = $wpdb->get_results($sql);

        $pony = array();

        // put the days and total posts into an array
        foreach ($results as $result) {
                $the_day = date('Y-m-d', strtotime($result->valid_from));
                $pony[$the_day] = $result->total;
        }

        // setup the last 30 days
        for($i = 0; $i < 30; $i++) {
                $each_day = date('Y-m-d', strtotime('-'. $i .' days'));

                // if there's no day with posts, insert a goose egg
                if (!in_array($each_day, array_keys($pony))) $pony[$each_day] = 0;
        }

        // sort the values by date
        ksort($pony);
  
  
  

?>

<div id="placeholder" style='width:400px;height:300px;'></div>
<script type="text/javascript">
// <![CDATA[
jQuery(function () {

        var posts = [
              <?php
                 foreach ($coupons as $day => $value) {
                         $sdate = strtotime($day);
                         $sdate = $sdate * 1000; // js timestamps measure milliseconds vs seconds
                         $newoutput = "[$sdate, $value],\n";
                         //$theoutput[] = $newoutput;
                         echo $newoutput;
                 }
                 ?>
        ];

        var coupons = [
                 <?php
                 foreach ($coupons as $day => $value) {
                         $sdate = strtotime($day);
                         $sdate = $sdate * 1000; // js timestamps measure milliseconds vs seconds
                         $newoutput = "[$sdate, $value],\n";
                         //$theoutput[] = $newoutput;
                         echo $newoutput;
                 }
                 ?>
        ];
        var pony = [
                 <?php
                 foreach ($pony as $day => $value) {
                         $sdate = strtotime($day);
                         $sdate = $sdate * 1000; // js timestamps measure milliseconds vs seconds
                         $newoutput = "[$sdate, $value],\n";
                         //$theoutput[] = $newoutput;
                         echo $newoutput;
                 }
                 ?>
        ];    
		
		

        var output = [
                
			       {
                        data: coupons,
                        label: "Neue Gutscheine",color: '#00A6F9',
                        symbol: ''
                },
			       {
                        data: posts,
                        label: "Neue Online-Shops",color: '#ff5800',
                        symbol: ''
                },
			       {
                        data: pony,
                        label: "Neue pony gutscheine",color: '#8CC627',
                        symbol: ''
                }
			 
        ];

        var options = {
           series: {
                   lines: { show: true },
                   points: { show: true }
           },
           grid: {
                   tickColor:'#ccc',
                   hoverable: true,
                   clickable: true,
                   borderColor: '#ccc',
                   backgroundColor:'#FFFFFF'
           },
           xaxis: { mode: 'time',
                    timeformat: "%d.%m"
           },
           yaxis: { min: 0 },
           y2axis: { min: 0, tickFormatter: function (v, axis) { return "$" + v.toFixed(axis.tickDecimals) }},
           legend: { position: 'nw' }
    };

        jQuery.plot( jQuery("#placeholder"), output, options);

        // reload the plot when browser window gets resized
        jQuery(window).resize(function() {
                jQuery.plot(placeholder, output, options);
        });

        function showChartTooltip(x, y, contents) {
                jQuery('<div id="charttooltip">' + contents + '</div>').css( {
                position: 'absolute',
                display: 'none',
                top: y + 5,
                left: x + 5,
                opacity: 1
                }).appendTo("body").fadeIn(200);
        }

        var previousPoint = null;
		
        jQuery("#placeholder").bind("plothover", function (event, pos, item) {
                jQuery("#x").text(pos.x.toFixed(2));
                jQuery("#y").text(pos.y.toFixed(2));
                if (item) {
                        if (previousPoint != item.datapoint) {
                previousPoint = item.datapoint;

                                jQuery("#charttooltip").remove();
                                var x = new Date(item.datapoint[0]), y = item.datapoint[1];
                                var xday = x.getDate(), xmonth = x.getMonth()+1; // jan = 0 so we need to offset month
                                showChartTooltip(item.pageX, item.pageY, xday + "." + xmonth + " - <b>" + item.series.symbol + y + "</b> " + item.series.label);
                        }
                } else {
                        jQuery("#charttooltip").remove();
                        previousPoint = null;
                }
        });

		
});
// ]]>
</script>
<?php 

}

add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
?>