<?php 
session_start();

require_once('../../dbconnect.php');

function h($s) {
    return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
  }

if (!isset($_SESSION['join'])) {
    header('Location: ../../index.php');
    exit();
}

if (!empty($_SESSION['join'])) {
	$statement = $dbh->prepare('INSERT INTO members SET name=?, email=?, password=?, picture=?, created=NOW()');
	echo $ret = $statement->execute(array(
		$_SESSION['join']['name'],
		$_SESSION['join']['email'],
		sha1($_SESSION['join']['password']),
		$_SESSION['join']['image']
		));
		unset($_SESSION['join']);
		// header('Location: thanks.php');
    }   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>thanks</title>
</head>
<body>
    <div id="thanks">
        <p>User registration is complete.</p>
        <p><a href="../">sign in</a></p>
    </div>
</body>
</html>