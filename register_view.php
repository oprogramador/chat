<html>
<head>

</head>
<body>


<form action="register.php" method="post">
<div>Login: <input name="login"/></div>
<div>Password: <input type="password" name="password"/></div>
<div>Repeat password: <input type="password" name="rpassword"/></div>
<div>E-mail: <input name="email"/></div>
<button>OK</button>
<?php
require_once 'util.php'; 

if(!isset($_SESSION['errors'])) $_SESSION['errors']='';
echo $_SESSION['errors'];
?>

</form>
<a href="register_view.php"></a>

</body>
</html>
