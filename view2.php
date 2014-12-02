<html>
<head>

</head>
<body>

<?php
require_once 'util.php';  

$login = Util::getLogin();

$verified = Util::queryCell("SELECT verified FROM users WHERE BINARY name='%s' LIMIT 1", [$login], 'verified');
if(!$verified) header('Location: not_verified_account.php');

$result = Util::query("SELECT id, name FROM users ORDER BY name");

?>

Your login: <?= $login ?>
<a href="logout.php">log out</a>
<a href="account_view.php">account settings</a>
<table border="2">
<?php  if($result) if($result->num_rows > 0)
    while($row = $result->fetch_assoc()) {
        $me = $row['name']==$login;
?>
    <tr><td <?php if($me){ ?> style="background-color:yellow"<?php } ?>>
        <?php if(!$me) { ?>
            <a href="connect.php?partner_id=<?= urlencode($row['id']) ?>">
        <?php } ?>
        <?= $row['name'] ?>
        <?php if(!$me) { ?>
            </a>
        <?php } ?>
    </td></tr> 
<?php
    }
?>
</table>

</body>
</html>


