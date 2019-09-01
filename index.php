<?php
// ini_set("display_errors", 0);
// error_reporting(E_ALL);
function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
}

// $_POST['name'] = '';
// $_POST['email'] = '';
// $_POST['password'] = '';
// $_POST['image'] = '';

session_start();
if (!empty($_POST)) {

    // エラー項目の確認
    if ($_POST['name'] == '') {
        $error['name'] = 'blank';
    }
    if ($_POST['email'] == '') {
        $error['email'] = 'blank';

    }
    if ($_POST['password'] == '') {
        $error['password'] = 'blank';
    }
    if (strlen($_POST['password']) < 4) {
        $error['password'] = 'length';
    }
    // ファイルの種類の判別とエラーの取得
    $fileNames = $_FILES['image']['name'];
    if (!empty($fileNames)) {
      $ext = substr($fileNames, -3);
      if ($ext != 'jpg' && $ext != 'gif') {
        $error['image'] ='type';
      }
    }
    if (empty($error)) {
    // 画像のアップロード
      $image = date('YmdHis') . $_FILES['image']['name'];
      move_uploaded_file($_FILES['image']['tmp_name'], '../member_picture/' . $image);

      $_SESSION['join'] = $_POST;
      $_SESSION['join']['image'] = $image;
      header('Location: ./assets/php/check.php');
      exit();
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://kit.fontawesome.com/e0db66e20b.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="./assets/css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Lato|Manjari|Raleway&display=swap" rel="stylesheet">
  <title>MotivaTellers</title>
</head>

<body>
  <div class="wrapper bg-light">

    <!-- <nav> -->
    <header>
      <div class="container">
        <nav class="navbar navbar-expand-md navbar-light float-right">
          <a href="" class="navbar-brand">
            icon
          </a>
          <div id="menu">
            <ul id="links">
              <li class="link"><a href="">Registration</a></li>
              <li id="list_second" class="link"><span class="mr-2">CreatedBy</span><a href="https://github.com/shunyaendoh">
                <i class="fab fa-github-alt"></i><span id="name" class="d-none d-md-block">shunya_endoh</span>
              </a></li>
            </ul>
          </div>
        </nav>
      </div>
    </header>

    <div id="main" class="container">
      <div class="row bg-light pl-5">
        <div class="box1 col-3"></div>
        <div class="box2 col-2">
          <p>This website is for those who want to maintain motivation. If you are that type of person, scroll down. Then it will come true and dreams also.</p>
        </div>
        <div class="box3 col-5 ml-5">
          <p>It is easy to set up. Register your name, email address and password. It is enough. If you want to upload a profile pic, you can. If you want to unsubscribe from this service, you can also.</p>
        </div>
      </div>
    </div>

<!-- ここから名言 -->
    <div id="words">
      <div class="container">
        <!-- jsで動的に文字列を変化させる(配列を使う) -->
        <div id="words-text-wrapper">
          <q>　Dreams do not run away. I always run away.　</q>
          <p>-Ayumu Takahashi</p>
        </div>
      </div>
    </div>


  <!-- ここから使用方法(保留) -->
  <div id="how-to-use">
    <div class="container">
      <p>使用例を画像を用いて説明する.</p>
    </div>
  </div>

  <!-- ここから会員登録 -->
  <div id="register">
    <div class="container">
      <div class="form">
        <p>Please complete the form</p>
        <form class="ml-5" action="" method="post" enctype="multipart/form-data">
          <dl>
            <dt>name<span class="required">required</span></dt>
            <dd class="mb-3 ml-1">
                <input type="text" name="name" size="35" maxlength="255" value="<?php 
                if (!empty($_POST['name'])) {
                  $name = $_POST['name'];
                  echo h($name); } ?>"/>
                <?php 
                if (!empty($error['name'])) {
                  if ($error['name'] == 'blank') : ?>
                    <p class="error">*Fill in the blank.</p>
            <?php endif; } ?>
            </dd>

            <dt>email address<span class="required">required</span></dt>
            <dd class="mb-3 ml-1">
              <input type="text" name="email" size="35" maxlength="255" value="<?php 
              if (!empty($_POST['email'])) {
                $email = $_POST['email'];
                echo h($email); } ?>"/>
              <?php 
              if (!empty($error['email'])) {
                if ($error['email'] == 'blank') : ?>
                 <p class="error">*Fill in the blank.</p>
            <?php endif; } ?>
            </dd>

            <dt>password<span class="required">required</span></dt>
            <dd class="mb-3 ml-1">
              <input type="password" name="password" size="10" maxlength="20" value="<?php 
              if (!empty($_POST['password'])) {
                $password = $_POST['password'];
                echo h($password); } ?>"/>
              <?php
              if (!empty($error['password'])) { 
                if ($error['password'] == 'blank') : ?>
                  <p class="error">*Fill in the blank.</p>
              <?php endif; } ?>
              <?php 
              if(!empty($error['password'])) {
                if ($error['password'] == 'length') : ?>
                  <p class="error">*Must be at least 4 letters.</p>
              <?php endif; } ?>
            </dd>

            <dt>profile image</dt>
            <dd class="mb-5 ml-1">
              <input type="file" name="image" size="35" />
              <?php
              if(!empty($error['image'])) {
                if ($error['image'] == 'type'): ?>
                <p class="error">*Use an extension with gif or jpg.</p>
              <?php endif; } ?>

              <?php
                if (!empty($error)): ?>
                <p class="error">*Please specify the image again.</p>
              <?php endif; ?>
            </dd>

            <div><input id="submit" type="submit" value="submit"></div>
          </dl>
        </form>
      </div>
    </div>
  </div>

  <!-- /wrapper -->
</div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="./assets/js/app.js"></script>
  
</body>
</html>