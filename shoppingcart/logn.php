<?php 
session_start();
if(isset($_SESSION['id'])){
    //セッションにユーザIDがある=ログインしている
    //topページへ
    header('Location: shop.php');
}else if(isset($_POST['name']) && isset($_POST['password'])){
    //ログインしていないがユーザ名とパスワードが送信されたとき
    //DBに接続
   try{
     $pdo = new PDO('mysql:host=localhost;dbname=shop;charset=utf8','root','');
     $pdo ->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
     $statement = $pdo->prepare("SELECT * FROM shopping WHERE name=:name AND pass=:pass");
     

     $statement->bindParam(':name',$_POST['name'],PDO::PARAM_STR);
     $statement->bindParam(':pass',hash("sha256",$_POST['password']),PDO::PARAM_STR);

     $statement->execute();
      
     echo 'aaa';

     if($row = $statement->fetch()){
        //結果セットから行を取得する、
        //結果セットにユーザが存在していたら、セッションにユーザIDをセット
        $_SESSION['id'] = $row['id'];
        header('Location: shop.php');
        exit();
     }else{
        //取得できなかったとき
        echo 'ccc';
        header('Location: logn.php');
        exit();
      
     }
   }catch(PDOException $e){
    echo 'bbb';
      exit('エラー:'. $e->getMessage());
      
   }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログインフォーム</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
               form {
            width: 100%;
            max-width: 100%;
            padding: 15px;
            margin: auto;
            text-align: center;
        }

        #name {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        #password {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius:0;
        }
    </style>
</head>
<body>
<main role="main" class="container" style="padding:60px 15px 0">
    <div>
        <form action="logn.php" method="post">
            <h1>shopping</h1>
            <label class="sr-only">Username</label>
            <input type="text" id="name" name="name" 
            class="form-control" placeholder="ユーザ名">
            <label class="sr-only">Password</label>
            <input type="password" id="password" name="password" 
            class="form-control" placeholder="パスワード">
            <input type="submit" class="btn btn-primary btn-block" value="ログイン">
        </form>
    </div>
</body>
</html>