<?php
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

class getData{
    public $pdo;
    public $data;
    //コンストラクタ
    function __construct()  {
        $this->pdo = db_connect();
    }
    /**
     * 記事情報の取得
     *
     * @param
     * @return array $books_data 記事情報
     */
    public function getBooksData(){
        $getbooks_sql = "SELECT * FROM books ORDER BY id ASC";
        $books_data = $this->pdo->query($getbooks_sql);
        return $books_data;
    }
}
?>

