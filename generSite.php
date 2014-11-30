<?php
require_once 'util.php';

function getDomain() {
    return 'localhost/cgi/ajax_chat';
}

function writeFile($name, $txt) {
    $dirname = 'gener_sites';
    $filename = $name.'.php';
    if(!file_exists($dirname)) mkdir($dirname, 0777, true);
    file_put_contents($dirname.DIRECTORY_SEPARATOR.$filename, $txt);
    return 'http://'.getDomain().'/'.$dirname.'/'.$filename;
}

function randStr($str, $n) {
    $ret = '';
    for($i=0; $i<$n; $i++) $ret .= $str[rand(0,strlen($str)-1)];
    return $ret;
}

function generVerifSite($id) {
    $site = <<<'DELIM'
<?php
require_once '..'.DIRECTORY_SEPARATOR.'util.php';
$id = 
DELIM
    .$id.
    <<<'DELIM'
;

Util::toSession('login_id', $id);
$conn = new mysqli('localhost', 'root', 'pass', 'chat');
$id = $conn->real_escape_string(''.$id);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "UPDATE users SET verified=1 WHERE id=$id";
$result = $conn->query($sql);
$sql = "SELECT name FROM users WHERE id=$id LIMIT 1";
$result = $conn->query($sql);
Util::toSession('login', $login = $result->fetch_assoc()['name']);
$conn->close();
header('Location: ..'.DIRECTORY_SEPARATOR.'view2.php');    
?>
DELIM;
    return writeFile(randStr('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', 40), $site);
}


function generResetSite($id) {
    $site = <<<'DELIM'
  <?php
$conn = new mysqli('localhost', 'root', 'pass', 'chat');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "UPDATE users SET verified=1 WHERE id=
DELIM
    .$id.
    <<<'DELIM'
 ";
$result = $conn->query($sql);
$conn->close();
    
echo 'sql='.$sql;
?>
DELIM;
    return writeFile(randStr('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', 40), $site);
}
