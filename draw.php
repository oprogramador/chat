<?php
/****************************************
 *
 * Author: Piotr Sroczkowski
 *
 ****************************************/
require_once 'util.php';

function breakLine($str, $n) {
    $ret = '';
    for($i=0; $i<strlen($str); $i++) {
        if($i%$n==0 && $i>0) $ret .= "\n";
        $ret .= $str[$i];
    }
    return $ret;
}

function drawImage($id, $author, $who, $time, $msg) {
    $size = 50;
    $nw = 20;

    $im = imagecreate(400, $size*(floor(strlen($msg)/$nw)+1)+$nw);

    $bg = imagecolorallocate($im, 255, 255, 255);
    $me = imagecolorallocate($im, 0, 0, 255);
    $he = imagecolorallocate($im, 255, 0, 0);
    $textcolor = $who=='me' ? $me : $he;

    //imagestring($im, 5, 0, 0, $msg, $textcolor);

    imagettftext($im, $nw/2, 0, 10, $nw, $textcolor, './Consolas.ttf', $author.' - '.(new \DateTime($time))->format('d/m/y H:i:s  '));
    imagettftext($im, $nw, 0, 10, $nw*2, $textcolor, './Consolas.ttf', breakLine($msg,$nw));


    imagepng($im, $id);
    imagedestroy($im);
}

function drawImages() {
    $login_id = Util::getLoginId();
    $login = Util::getLogin();
    $partner_id = Util::getSessionData('partner_id');
    $partner = Util::getSessionData('partner');

    $result = Util::query('SELECT * FROM messages WHERE (sender=%1$s AND receiver=%2$s) OR (sender=%2$s AND receiver=%1$s) ORDER BY time DESC LIMIT %s',
        [$partner_id, $login_id, Util::getImgCount()]);

    $i = 0;
    $dirname = 'images';
    mkdir($dirname.DIRECTORY_SEPARATOR.$login, 0777, true);
    mkdir($dirname.DIRECTORY_SEPARATOR.$partner, 0777, true);
    while($row = $result->fetch_assoc()) {
        drawImage($dirname.DIRECTORY_SEPARATOR.$login.DIRECTORY_SEPARATOR.$i.'.png',
            $row['sender']==$login_id ? $login : $partner, $row['sender']==$login_id ? 'me' : 'he', $row['time'], $row['text']);
        drawImage($dirname.DIRECTORY_SEPARATOR.$partner.DIRECTORY_SEPARATOR.$i.'.png',
            $row['sender']==$login_id ? $login : $partner, $row['sender']!=$login_id ? 'me' : 'he', $row['time'], $row['text']);
        $i++;
    }
}
