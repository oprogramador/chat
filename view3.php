<html>
<head>
<script src="vendor/components/jquery/jquery.min.js"></script>
<script>
var imgsrc;
$(document).ready(function() {
    imgsrc = $('#img').attr('src');
    setInterval(function() {
        $('#img').attr('src',imgsrc+'?xxx='+Math.random());
        var img = $('#img');
        console.log('h='+img.height());
        if(img.height()>0) {
            var cl = img.clone();
            cl.attr('id', 'img'+Math.random());
            $('#div').append(img.clone());
        }
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
    <img id="img" src="draw.php"/>
</div>
<br/>
<form action="save.php" method="post"> 
<input name="message"/>
<button>OK</button>
</form>

</body>
</html>
