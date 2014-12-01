<?php
require_once 'util.php';
header('Content-Type: image/png');

function breakLine($str, $n) {
    $ret = '';
    for($i=0; $i<strlen($str); $i++) {
        if($i%$n==0 && $i>0) $ret .= "\n";
        $ret .= $str[$i];
    }
    return $ret;
}

$msg = $_GET['msg'];
$who = $_GET['who'];

$msg = Util::queryCell('SELECT text FROM messages WHERE id=%s', [$msg], "text");


$size = 50;
$nw = 20;
$im = imagecreate(400, $size*(floor(strlen($msg)/$nw)+1));

$bg = imagecolorallocate($im, 255, 255, 255);
$me = imagecolorallocate($im, 0, 0, 255);
$he = imagecolorallocate($im, 255, 0, 0);
$textcolor = $who=='me' ? $me : $he;

//imagestring($im, 5, 0, 0, $msg, $textcolor);
imagettftext($im, 20, 0, 10, 20, $textcolor, './Consolas.ttf', breakLine($msg,$nw));

imagepng($im);
imagedestroy($im);
