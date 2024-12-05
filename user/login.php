<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <title>ログイン画面</title>
</head>
<header>
    <h1>自分好みのコーデを見つけよう！</h1>
</header>
<body>

<div class="container">
    <div class="back-button"><a href="./home.php"><<戻る</a></div>
    <div class="profile-container">
      <div class="profile-icon">
        <img src="./images/ユーザーアイコン.jpg" alt="Profile Icon">
    </div></div>
      
      <div class="tabs">
        <div class="login_tab">Login</div>
         <a href="new_login.php" class="new_login_tab">新規登録</a>
     </div>

      <form action="home.php" method="post">
        <label for="email">Email</label>
        <input  type="email" id="email" name="user_email" placeholder="23000@s.asojuku.ac.jp" required>
  
        <label for="password">Password</label>
        <input type="password" id="password" name="user_pass" placeholder="英数字含む8文字以上" required>
  
        <div class="checkbox-container">
          <input type="checkbox" id="remember">
          <label for="remember">パスワードを自動保存する</label>
        </div>
  
        <a href="#" class="forgot-password">パスワードを忘れた方はこちら（再設定）</a>
  
        <button type="submit" class="login-btn" value="send">Login</button>
      </form>
    </div>
</body>
  </html>
