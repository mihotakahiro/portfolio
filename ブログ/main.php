<?php
include_once("db_connect.php");
// function.phpの読み込み
require_once('function.php');
// ログインしていなければ、リダイレクト
check_user_logged_in();
//データ取得
$getData = new getData("Data");

//なくてもいけるのでは？
// $UserData = $getData-> getUserData();

$stmt = $getData-> getPostData();
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>メイン</title>
</head>
<body>
    <h1>メインページ</h1>
    <p>ようこそ<?php echo $_SESSION["user_name"]; ?>さん</p>
    <a href="logout.php">ログアウト</a>
    <br>
    <a href="create_post.php">記事投稿！</a>
    <table>
        <tr>
            <td>記事ID</td>
            <td>タイトル</td>
            <td>本文</td>
            <td>投稿日</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>    
        <?PHP while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>        
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['title'] ?></td>
                <td><?php echo $row['content'] ?></td>
                <td><?php echo $row['time'] ?></td>
                <td><a href="detail_post.php?id=<?php echo $row['id']; ?>">詳細</a></td>
                <td><a href="edit_post.php?id=<?php echo $row['id']; ?>">編集</a></td>
                <td><a href="delete_post.php?id=<?php echo $row['id']; ?>">削除</a></td>
            </tr>
        <?PHP } ?>
    </table>      
</body>
</html>

