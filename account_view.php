<html>
<head>

</head>
<body>

<?php
require_once 'util.php';

$login = Util::getLogin();
$login_id = Util::getLoginId();

$conn = new mysqli('localhost', 'root', 'pass', 'chat');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, password, email FROM users WHERE id='".$conn->real_escape_string($login_id)."' LIMIT 1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
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
