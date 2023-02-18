<?php

$row = 1;
if (($handle = fopen($csv_file, 'r')) !== FALSE) {
   
    echo '<table class="wp-list-table widefat ">';
   
    while (($data = fgetcsv($handle, 3000, ";")) !== FALSE) {
        $num = count($data);
        if ($row == 1) {
            echo '<thead><tr>';
        }else{
            echo '<tr>';
        }
       
        for ($c=1; $c < $num; $c++) {
            if(empty($data[$c])) {
               $value = "&nbsp;";
            }else{
               $value = $data[$c];
            }
            if ($row == 1) {
                echo '<th>'.utf8_encode($value).'</th>';
            }else{
                echo '<td>'.utf8_encode($value).'</td>';
            }
        }
       
        if ($row == 1) {
            echo '</tr></thead><tbody>';
        }else{
            echo '</tr>';
        }
        $row++;
    }
   
    echo '</tbody></table>';

    fclose($handle);
}
?>