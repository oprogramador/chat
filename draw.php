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

$login_id = Util::getLoginId();
$partner_id = Util::getSessionData('partner_id');

$row = Util::queryRow('SELECT * FROM messages WHERE (sender=%1$s AND receiver=%2$s) OR (sender=%2$s AND receiver=%1$s) ORDER BY time DESC LIMIT 1', [$partner_id, $login_id]);

//$msg = Util::queryCell('SELECT text FROM messages WHERE id=%s', [40], "text");
$msg = $row['text'];
$who = $row['sender']==$login_id ? 'me' : 'he';

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
