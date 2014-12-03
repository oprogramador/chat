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
<html>
<head>
<script src="vendor/components/jquery/jquery.min.js"></script>
<script>
var imgsrc;
$(document).ready(function() {
    setInterval(function() {
        //$('img').attr('src',imgsrc+'&xxx='+Math.random());
        for(var i = 0; i < <?= Util::getImgCount() ?> ; i++) {
            $('#img'+i).attr('src', 'draw_on_request.php?id='+i+'&xxx='+Math.random());
            if($('#img'+i).width()<60) $('#img'+i).hide();
            else $('#img'+i).show();
        }
    }, 1000);
});
</script>
</head>
<body>
<a href="logout.php">log out</a>
<a href="account_view.php">account settings</a>
<br/>
Your name: <?= $login ?>
<br/>
Your partner: <?= $partner ?>
<br/>
<div id="div" style="overflow:scroll;width:400px;height:500px">
<?php for($i=Util::getImgCount()-1; $i>=0; $i--) { ?>
<div>
    <img id="img<?= $i ?>" src="<?= 'draw_on_request.php?id='.$i ?>"/>
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
