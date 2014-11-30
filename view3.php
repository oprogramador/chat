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

<?php
/*
<img src="draw.php?msg=<?php
$conn = new mysqli('localhost', 'root', 'pass', 'chat');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name FROM users ORDER BY name";
$result = $conn->query($sql);
$conn->close();
$conn = new mysqli('localhost', 'root', 'pass', 'chat');
$result = $conn->query('select * from messages where sender='.
    $conn->real_escape_string($partner_id).
    " and receiver=".
    $conn->real_escape_string($login_id).
    " and time = (select max(time) from messages)");
$data = $result->fetch_assoc();
echo $data['text'];
?>"/>
 */
?>
<div style="overflow:scroll;width:400px;height:200px">
<table>
<?php
$conn = new mysqli('localhost', 'root', 'pass', 'chat');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name FROM users ORDER BY name";
$result = $conn->query($sql);
$conn->close();
$conn = new mysqli('localhost', 'root', 'pass', 'chat');
$result = $conn->query($sql='select * from messages where (sender='.
    $conn->real_escape_string($partner_id).
    " and receiver=".
    $conn->real_escape_string($login_id).
    ') or (sender='.
    $conn->real_escape_string($login_id).
    " and receiver=".
    $conn->real_escape_string($partner_id).
    ')');
echo 'sql='.$sql;
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
