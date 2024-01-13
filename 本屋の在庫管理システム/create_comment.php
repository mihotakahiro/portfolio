<?php
    // db_connect.phpの読み込みFILL_IN
    require_once('db_connect.php');

    // function.phpの読み込みFILL_IN
    require_once('function.php');

    // ログインしていなければ、login.phpにリダイレクトFILL_IN
    // 提出ボタンが押された場合
        $id = $_GET['id'];

    // 11/14追記。現在選択されている記事IDを代入。    
        $post_id = $id;
        
    if (!empty($_POST)) { 

        if (empty($_POST["name"])) { 
            echo '名前が未入力です。';
        } else if (empty($_POST["content"])) { 
            echo 'コメントが未入力です。'; 
        } 

        if (!empty($_POST["name"]) && !empty($_POST["content"])) { 
            // name、contentを格納 
            $name = $_POST["name"];
            $content = $_POST["content"]; 

            // PDOのインスタンスを取得 FILL_IN
            $pdo = db_connect();

            try { 
                // SQL文の準備 FILL_IN 
                $stmt = $pdo->prepare("INSERT INTO comments(post_id,name,content) VALUES (?,?,?)");

                // プリペアドステートメントの準備 FILL_IN

                // 実行 FILL_IN
                $stmt->execute(array($id,$name,$content));

                // 対象のpost_idのdetail_post.phpにリダイレクト

                header("Location: detail_post.php?id=".$id);
                exit; 

            } catch (PDOException $e) {
                // エラーメッセージの出力
                echo 'Error: ' . $e->getMessage(); 
                // 終了
                die(); 
            }
        } else {
            // POSTで渡されたデータがなかった場合
            // GETで渡されたpost_idを受け取る 

            // $post_idが空だった場合は不正な遷移なので、main.phpに戻す
            redirect_main_unless_parameter($id);
        }
    }    
?>

<!DOCTYPE html>
<html>
<head> 
<title>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
    <body>
        <h1>コメント</h1> 
        <form method="POST" action="">
        投稿者名:<br> 
        <input type="text" name="name"> <br> 
        コメント:<br>
        <input type="text" name="content" style="width:200px;height:100px;"><br> 
        <input type="submit" value="submit">
        </form>
        <a href="detail_post.php?id=<?php echo $id; ?>">記事詳細に戻る</a>
    </body>
</html>