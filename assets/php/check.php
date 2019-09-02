<?php
session_start();
require('../../dbconnect.php');

function h($s) {
    return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
  }
  

if (!isset($_SESSION['php'])) {
    header('Location: index.php');
    exit();
}

if (!empty($_POST)) {
	// 登録処理をする
	$statement = $db->prepare('INSERT INTO members SET name=?, email=?,	password=?, picture=?, created=NOW()');
		echo $ret = $statement->execute(array(
			$_SESSION['php']['name'],
			$_SESSION['php']['email'],
			sha1($_SESSION['join']['password']),
			$_SESSION['php']['image']
		));
		unset($_SESSION['php']);
		header('Location: thanks.php');
		exit();
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css">
    <title>check</title>
</head>
<body>
    <div id="check-form">
        <p>Register with the following contents.</p>
        <form action="./thanks.php" method="post" enctype="">
        <input type="hidden" name="action" value="submit" />
        <dl class="check-form-content">
            <dt>name:　</dt>
            <dd><?php 
                echo h($_SESSION['php']['name']);
            ?></dd>

            <dt>email address:　</dt>
            <dd><?php
                echo h($_SESSION['php']['email']);
            ?></dd>

            <dt>password:　</dt>
            <dd>**********</dd>

            <dt>profile image:　</dt>
            <dd>
                <img src="../../member_picture/<?php echo h($_SESSION['join']['img']); ?>" alt="profile_img" width="100" height="100" /> 
            </dd>
        </dl>
        <div><a href="../../index.php?action=rewrite">&laquo;&nbsp;rewrite</a> | <input type="submit" value="register"></div>

        </form>

    </div>
    
</body>
</html>