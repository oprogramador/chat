<?php
/****************************************
 *
 * Author: Piotr Sroczkowski
 *
 ****************************************/
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
$login = Util::getLogin();
$partner_id = Util::getSessionData('partner_id');
$partner = Util::getSessionData('partner');

$row = Util::queryRow('SELECT * FROM messages WHERE (sender=%1$s AND receiver=%2$s) OR (sender=%2$s AND receiver=%1$s) ORDER BY time DESC LIMIT 1', [$partner_id, $login_id]);

//$msg = Util::queryCell('SELECT text FROM messages WHERE id=%s', [40], "text");
$msg = $row['text'];
$who = $row['sender']==$login_id ? 'me' : 'he';
$time = $row['time'];
$id = $row['id'];


$size = 50;
$nw = 20;

if($id == Util::getSessionData('lastImage')) {
    $im = imagecreate(1, 1);

    $bg = imagecolorallocate($im, 255, 255, 255);
} else {
    $im = imagecreate(400, $size*(floor(strlen($msg)/$nw)+1)+$nw);

    $bg = imagecolorallocate($im, 255, 255, 255);
    $me = imagecolorallocate($im, 0, 0, 255);
    $he = imagecolorallocate($im, 255, 0, 0);
    $textcolor = $who=='me' ? $me : $he;
    $author = $who=='me' ? $login : $partner;

    //imagestring($im, 5, 0, 0, $msg, $textcolor);

    imagettftext($im, $nw/2, 0, 10, $nw, $textcolor, './Consolas.ttf', $author.' - '.(new \DateTime($time))->format('d/m/y H:i:s  '));
    imagettftext($im, $nw, 0, 10, $nw*2, $textcolor, './Consolas.ttf', breakLine($msg,$nw));
}

Util::toSession('lastImage', $id);

imagepng($im);
imagedestroy($im);
