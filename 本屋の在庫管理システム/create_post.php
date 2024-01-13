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
    } else if (empty($_POST["date"])) {
        $errorMessage = '発売日が未入力です。';
    } else if (empty($_POST["stock"])) {
        $errorMessage = '在庫数が未入力です。';
    }

    if (!empty($_POST["title"]) && !empty($_POST["date"]) && !empty($_POST["stock"])){    
        // 入力したタイトルと本文を格納
        $title = $_POST["title"];
        $date = $_POST["date"];
        $stock = $_POST["stock"];

        // 2. タイトル、とコンテンツが入力されていたら認証する
        // 3. エラー処理
        try {
            $pdo = db_connect();
            $stmt = $pdo->prepare("INSERT INTO books(title,date,stock) VALUES (?,?,?)");
   	        $stmt->execute(array($title,$date,$stock));

            // $signUpMessage = '登録が完了しました。'; 
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
    <title>本の登録</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <form method="POST" action="">
        <div><font color="#000000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></div>
        <br>
        <div><font color="#000000"><?php echo htmlspecialchars($signUpMessage, ENT_QUOTES); ?></font></div>
	<h1>本登録画面</h1>
        <input type="text" name="title" id="title" placeholder="タイトル" style="width:200px;height:25px;">
        <br>
        <br>
        <input type="text" name="date" id="date" placeholder="発売日" style="width:200px;height:25px;"><br>
        <br>
        在庫数:<br>
        <select name=stock>     
            <option value="placeholder">選択してください</option>
            <option value=1>1</option>
            <option value=2>2</option>
            <option value=3>3</option>
            <option value=4>4</option>
            <option value=5>5</option>
            <option value=6>6</option>
            <option value=7>7</option>
            <option value=8>8</option>
            <option value=9>9</option>
            <option value=10>10</option>    
            <option value=11>11</option>       
            <option value=12>12</option>       
            <option value=13>13</option>       
            <option value=14>14</option>       
            <option value=15>15</option>       
            <option value=16>16</option>       
            <option value=17>17</option>       
            <option value=18>18</option>       
            <option value=19>19</option>       
            <option value=20>20</option>       
        </select>
        <br>
        <br>
        <input div class="btn" type="submit" value="登録" id="post" name="post">
    </form>
</body>
</html>

