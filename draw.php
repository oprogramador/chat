<?php
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


$conn = new mysqli('localhost', 'root', 'pass', 'chat');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = 'SELECT text FROM messages WHERE id='.$conn->real_escape_string($msg);

$result = $conn->query($sql);

if($result) if($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $msg = $row['text'];
    }
} else {
    echo "0 results";
}
$conn->close();

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
