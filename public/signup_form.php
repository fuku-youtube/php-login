<?php
session_start();

require_once '../functions.php';
require_once '../classes/UserLogic.php';

$result = UserLogic::checkLogin();
if($result) {
  header('Location: mypage.php');
  return;
}

$login_err = isset($_SESSION['login_err']) ? $_SESSION['login_err'] : null;
unset($_SESSION['login_err']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザ登録画面</title>
</head>
<body>
<h2>ユーザ登録フォーム</h2>
<?php if (isset($login_err)) : ?>
    <p><?php echo $login_err; ?></p>
<?php endif; ?>
  <form action="register.php" method="POST">
  <p>
    <label for="username">ユーザ名：</label>
    <input type="text" name="username">
  </p>
  <p>
    <label for="email">メールアドレス：</label>
    <input type="email" name="email">
  </p>
  <p>
    <label for="password">パスワード：</label>
    <input type="password" name="password">
  </p>
  <p>
    <label for="password_conf">パスワード確認：</label>
    <input type="password" name="password_conf">
  </p>
  <input type="hidden" name="csrf_token" value="<?php echo h(setToken()); ?>">
  <p>
    <input type="submit" value="新規登録">
  </p>
  </form>
  <a href="/public/login_form.php">ログインする</a>
</body>
</html>