<html>
<head>

</head>
<body>
<?php
require_once 'util.php';

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
<div style="overflow:scroll;width:400px;height:200px">
<table>
<?php
$result = Util::query('select * from messages where (sender=%1$s and receiver=%2$s) or (sender=%2$s and receiver=%1$s)', [$partner_id, $login_id]);

if($result) while($row = $result->fetch_assoc()) {
   $me = $row['sender']==$login_id ? 'me' : 'he'; 
?>
    <tr><td><img src="draw.php?msg=<?= $row['id'] ?>&who=<?= $me ?>"/></td></tr>
<?php
    }
?>
</table>
</div>
<br/>
<form action="save.php" method="post"> 
<input name="message"/>
<button>OK</button>
</form>

</body>
</html>
