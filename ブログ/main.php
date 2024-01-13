<?php
include_once("db_connect.php");
// function.phpの読み込み
require_once('function.php');
// ログインしていなければ、リダイレクト
check_user_logged_in();
//データ取得
$getData = new getData("Data");
$stmt = $getData-> getBooksData();
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>在庫一覧画面</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <h1>在庫一覧画面</h1>
    <a href="create_post.php"><button class="btn_main_registration" type="button">新規登録</button></a>
    <a href="logout.php"><button class="btn_logout" type="button">ログアウト</button></a>
    <br><br>
    <table border="1" cellspacing="0">        
        <tr>
                <th>タイトル</th>
                <th>発売日</th>
                <th>在庫数</th>
                <th></th>
        </tr>    
        <?PHP while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>        
            <tr>
                <td><?php echo $row['title'] ?></td>
                <td><?php echo $row['date'] ?></td>
                <td><?php echo $row['stock'] ?></td>
                <td><a href="delete_post.php?id=<?php echo $row['id']; ?>"><button class="btn_delete" type="button">削除</button></a></td>
            </tr>
        <?PHP } ?>
    </table>      
</body>
</html>
