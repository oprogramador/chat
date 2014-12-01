<html>
<head>

</head>
<body>

<?php
require_once 'util.php';

$login = Util::getLogin();
$login_id = Util::getLoginId();
$row = Util::queryRow("SELECT id, password, email FROM users WHERE id=%s LIMIT 1", [$login_id]);
Util::toSession('row', $row)

?>


Account settings<br/>
<form action="account.php" method="post">
<div>Login: <input name="login" value="<?= $login ?>"/></div>
<div>Current password: <input type="password" name="cpassword"/></div>
<div>New password: <input type="password" name="password"/></div>
<div>Repeat password: <input type="password" name="rpassword"/></div>
<div>E-mail: <input name="email" value="<?= $row['email'] ?>"/></div>
<button>OK</button>
<?php 
if(!isset($_SESSION['errors'])) $_SESSION['errors']='';
echo $_SESSION['errors'];
?>

</form>

</body>
</html>
