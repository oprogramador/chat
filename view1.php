<html>
<head>

</head>
<body>

<?php
/****************************************
 *
 * Author: Piotr Sroczkowski
 *
 ****************************************/
require_once 'util.php'; 
if(Util::getLoginId() != "") header('Location: view2.php')
?>

<form action="login.php" method="post">
Login: <input name="login"/>
Password: <input type="password" name="password"/>
<button>OK</button>

</form>
<a href="register_view.php">sign up</a>
<?php
//<a href="password_reset_view.php">I have forgotten my password.</a>
//<a href="login_reset_view.php">I have forgotten my login.</a>
?>
<?php
echo Util::getSessionData('errors'); 
?>

</body>
</html>
