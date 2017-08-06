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
Util::query("UPDATE users SET verified=1 WHERE id=%s", [$id]);
$login = Util::queryCell("SELECT name FROM users WHERE id=%s LIMIT 1", [$id], "name");
Util::toSession('login', $login);
header('Location: ..'.DIRECTORY_SEPARATOR.'view2.php');    
?>
DELIM;
    return writeFile(Util::randStrAlpha(40), $site);
}
