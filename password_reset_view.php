<html>
<head>

</head>
<body>

Password reset<br/>
<form action="password_reset.php" method="post">
<div>Login: <input name="login"/></div>
<button>OK</button>
<?php 
if(!isset($_SESSION['errors'])) $_SESSION['errors']='';
echo $_SESSION['errors'];
?>

</form>

</body>
</html>

