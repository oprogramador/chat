<html>
<head>
<script src="vendor/components/jquery/jquery.min.js"></script>
<script>
var imgsrc;
$(document).ready(function() {
    imgsrc = $('#img').attr('src');
    setInterval(function() {
        //$('img').attr('src',imgsrc+'?xxx='+Math.random());
    }, 1000);
});
</script>
</head>
<body>
<?php
/****************************************
 *
 * Author: Piotr Sroczkowski
 *
 ****************************************/
require_once 'util.php';

if(isset($_COOKIE['ajax'])) echo $_COOKIE['ajax'];

$login = Util::getLogin();
$partner = Util::getSessionData('partner');
$login_id = Util::getLoginId();
$partner_id = Util::getSessionData('partner_id');
?>
<a href="logout.php">log out</a>
<a href="account_view.php">account settings</a>
<br/>
Your name: <?= $login ?>
<br/>
Your partner: <?= $partner ?>
<br/>
<div id="div" style="overflow:scroll;width:400px;height:500px">
<?php for($i=19; $i>=0; $i--) { ?>
<div>
    <img id="img" src="<?= 'images'.DIRECTORY_SEPARATOR.$login.DIRECTORY_SEPARATOR.$i.'.png' ?>"/>
</div>
<?php } ?>
</div>
<br/>
<form action="save.php" method="post"> 
<input name="message"/>
<button>OK</button>
</form>

</body>
</html>
