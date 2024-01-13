<?php
include_once("db_connect.php");

include_once("function.php");

// エラーメッセージ、登録完了メッセージの初期化
$errorMessage = "";
$signUpMessage = "";

// ログインボタンが押された場合
if (isset($_POST["post"])) {
    // 1. タイトルの入力チェック
    if (empty($_POST["title"])) {  // 値が空のとき
        $errorMessage = 'タイトルが未入力です。';
    } else if (empty($_POST["content"])) {
        $errorMessage = '本文が未入力です。';
    }
    if (!empty($_POST["title"]) && !empty($_POST["content"])){    
        // 入力したタイトルと本文を格納
        $title = $_POST["title"];
        $content = $_POST["content"];
        // 2. タイトルとコンテンツが入力されていたら認証する
        // 3. エラー処理
        try {
            $pdo = db_connect();
            $stmt = $pdo->prepare("INSERT INTO posts(title,content) VALUES (?, ?)");
   	        $stmt->execute(array($title,$content));

            header("Location: main.php");
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
	<h1>記事登録</h1>
        title:<br>
        <input type="text" name="title" id="title" style="width:200px;height:50px;">
        <br>
        content:<br>
        <input type="text" name="content" id="content" style="width:200px;height:100px;"><br>
        <input type="submit" value="submit" id="post" name="post">
    </form>
</body>
</html>