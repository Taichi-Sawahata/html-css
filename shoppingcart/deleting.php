<?php 
//セッションを開始
session_start();

//セッションネームを取得
$session_name = session_name();

$_SESSION = array();

//クッキーを削除
//現在のスクリプトにHTTPクッキーから渡された変数の連想配列
//time関数、タイムスタンプを返す、マイナス3600(1時間)すると、クッキー削除
if(isset($_COOKIE[$session_name]) === TRUE) {
    //クッキーを送信する,クッキーの名前、クッキーの値(空でもいい),
    setcookie($session_name,'',time() - 3600);
}

//sessionに登録されたデータをすべて破棄
session_destroy();

header('Location: cartshopping.php');

exit;

?>