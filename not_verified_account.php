<html>
<head>

</head>
<body>

<?php
require_once 'util.php'; 


$login = Util::getLogin();
$verified = Util::queryCell("SELECT verified FROM users WHERE name='%s' LIMIT 1", [$login], 'verified');
if($verified) header('Location: view2.php');

?>

Your login: <?= $login ?><br/>
Your account has not been verified yet.
<a href="view1.php">Home</a>
</body>
</html>
