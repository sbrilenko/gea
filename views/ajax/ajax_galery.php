<?php
    $type = $_POST[type];
    if ($type == "events"){
        $eventId = $_POST[eventId];
        $dir = scandir("img/events/photo-event-$eventId");
        $i = 0;
        for ($j = 2; $j<=count($dir); $j++){
           if (!empty($dir[$j])){
               $i++;
               if ($i != 1) $elements .= ",";
               $elements .= "\"img/events/photo-event-$eventId/{$dir[$j]}\"";
           }
        }  
        echo "pictures=[".$elements."];";
    }
?>
