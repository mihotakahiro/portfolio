<?php
// function.php
/**
 * $_SESSION["user_name"]が空だった場合、ログインページにリダイレクトする
 * @return void
 */
function check_user_logged_in() {
    // セッション開始
    session_start();
    // セッションにuser_nameの値がなければlogin.phpにリダイレクト
    if (empty($_SESSION["user_name"])) {
        header("Location: login.php");
        exit;
    }
}    

/**
 * 引数の値が空だった場合、main.phpにリダイレクトする
 * @param integer $param
 * @return void
 */
function redirect_main_unless_parameter($param) {
    if (empty($param)) {
        header("Location: main.php");
        exit;
    }
}

function find_post_by_id($id) {
    // PDOのインスタンスを生成
    $pdo = db_connect();
    try {
        // SQL文の準備
        $sql = "SELECT * FROM posts WHERE id = :id";
        // プリペアドステートメントの作成
        $stmt = $pdo->prepare($sql);
        // idのバインド
        $stmt->bindParam('id', $id);
        // 実行
        $stmt->execute();
    } catch (PDOException $e) {
        // エラーメッセージの出力
        echo 'Error: ' . $e->getMessage();
        // 終了
        die();
    }
    // 結果が1行取得できたら
    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        return $row;
    } else {
        redirect_main_unless_parameter($row);
    }
}


class getData{

    public $pdo;
    public $data;

    //コンストラクタ
    function __construct()  {
        $this->pdo = db_connect();
    }

    /**
     * ユーザ情報の取得
     *
     * @param
     * @return array $users_data ユーザ情報
     */
    public function getUserData(){
        $getusers_sql = "SELECT * FROM users limit 1";
        $users_data = $this->pdo->query($getusers_sql)->fetch(PDO::FETCH_ASSOC);
        return $users_data;
    }
    
    /**
     * 記事情報の取得
     *
     * @param
     * @return array $post_data 記事情報
     */
    public function getPostData(){
        $getposts_sql = "SELECT * FROM posts ORDER BY id ASC";
        $post_data = $this->pdo->query($getposts_sql);
        return $post_data;
    }

    /**
     * コメント情報の取得
     *
     * @param
     * @return array $comment_data 記事情報
     */
    public function getCommentData(){
        $getcomments_sql = "SELECT * FROM comments ORDER BY id ASC";
        $comment_data = $this->pdo->query($getcomments_sql);
        return $comment_data;
    }
}
?>