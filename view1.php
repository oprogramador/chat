<html>
<head>

</head>
<body>


<form action="login.php" method="post">
Login: <input name="login"/>
Password: <input type="password" name="password"/>
<button>OK</button>

</form>
<a href="register_view.php">register</a>
<a href="password_reset_view.php">I have forgotten my password.</a>
<a href="login_reset_view.php">I have forgotten my login.</a>
<?php
require_once 'util.php'; 

if(!isset($_SESSION['errors'])) $_SESSION['errors']='';
echo $_SESSION['errors'];
?>

</body>
</html>
