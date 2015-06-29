<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."/lib/include.php";
$db = db :: getInstance();

$i = (int)preg_replace('/[^\d]/', '', $_POST['i']);
if ($i)
{
    $q=$db->query("SELECT * FROM video ORDER BY `date` DESC LIMIT ".$i.", 10");
    $vs = $db->getArray();
    foreach($vs as $v)
    {
        $c++;
        if (preg_match('/object|iframe/is', $v['link']))
        {
            echo '<div class="video-unit">';
                echo '<a class="look-video">Смотреть</a>';
                echo '<div class="e-title vid"><a class="e-title-a">'.$v['name'].'</a></div>';
                echo '<div class="hidden">';
                    echo '<div style="margin-left:40px;margin-bottom:80px;">';
                        echo $v['link'];
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        }
    }
    if ($c == 10) echo '<div id="s'.($i + 10).'" class="show-more">Показать еще</div>';
}
?>