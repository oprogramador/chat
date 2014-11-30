<html>
<head>

</head>
<body>

<?php 

require_once 'util.php';

session_start();
$login = Util::getLogin();

?>

Your login: <?= $login ?><br/>
Your account has not been verified yet.
<a href="view1.php">Home</a>
</body>
</html>
