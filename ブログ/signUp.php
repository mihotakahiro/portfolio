<?php
include_once("db_connect.php");

// エラーメッセージ、登録完了メッセージの初期化
$errorMessage = "";
$signUpMessage = "";

// ログインボタンが押された場合
if (isset($_POST["signUp"])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST["name"])) {  // 値が空のとき
        $errorMessage = 'ユーザーIDが未入力です。';
    } else if (empty($_POST["password"])) {
        $errorMessage = 'パスワードが未入力です。';
    }
    if (!empty($_POST["name"]) && !empty($_POST["password"])){    
        // 入力したユーザIDとパスワードを格納
        $name = $_POST["name"];
        $password = $_POST["password"];
        // 2. ユーザIDとパスワードが入力されていたら認証する
        // 3. エラー処理
        try {
            $pdo = db_connect();
            $stmt = $pdo->prepare("INSERT INTO users(name, password) VALUES (?, ?)");
            $stmt->execute(array($name, password_hash($password, PASSWORD_DEFAULT)));  // パスワードのハッシュ化を
            // 行う（今回は文字列のみなのでbindValue(変数の内容が変わらない)を使用せず、直接excuteに渡しても問題ない）
            $userid = $pdo->lastinsertid();  // 登録した(DB側でauto_incrementした)IDを$useridに入れる

            $signUpMessage = '登録が完了しました。';  // ログイン時に使用するIDとパスワード
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            // $e->getMessage() でエラー内容を参照可能（デバック時のみ表示）
            echo $e->getMessage();
        }
    }       
}
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
    <form method="POST" action="">
        <div><font color="#000000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></div>
        <br>
        <div><font color="#000000"><?php echo htmlspecialchars($signUpMessage, ENT_QUOTES); ?></font></div>
        <h1>新規登録</h1>
        <br>
        <label for="name">user:</label><input type="text" id="name" name="name" placeholder="ユーザー名を入力" value="<?php if (!empty($_POST["name"])) {
    echo htmlspecialchars($_POST["name"], ENT_QUOTES);
} ?>">
        <br><br>
        <label for="password">password:</label><input type="password" id="password" name="password" value="" placeholder="パスワードを入力">
        <br><br>
        <input type="submit" value="submit" id="signUp" name="signUp">
    </form>
</body>
</html>




