<?php 
 session_start();
 $name_array = array();
 $cart = array();

if(isset($_POST['name'])){
    $name = $_POST['name'];
     $num = $_POST['num'];
     $_SESSION['cart'][$name] = $num;
     $price = $_POST['price'];

     try{
        $db = new PDO('mysql:host=localhost;dbname=shopping;charset=utf8','root','');
         $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
         $statement = $db->prepare("
         INSERT INTO product (name,num,price)
         VALUES (:name,:num,:price)
         ");
    
         $statement->bindParam(':name',$name,PDO::PARAM_STR);
         $statement->bindParam(':num',$num,PDO::PARAM_INT);
         $statement->bindParam(':price',$price,PDO::PARAM_INT);
        
    
        $statement->execute();
    echo 'abc';
    }catch(PDOException $e){
        // echo 'ddd';ok
       exit('エラー:'.$e->getMessage());
       
    }
}

if(isset($_SESSION['cart'])){
    $cart = $_SESSION['cart'];
}





  //デフォルトで設定されているsession_nameを取得
//   $f= session_name();
//   var_dump($_COOKIE[$f]);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .wrapper{
            max-width: 90%;
            margin: 0 auto;
        }
        a{
            text-decoration: none;
        }
       nav li{
            list-style: none;
            padding: 0 10px 0;
        }
        header{
            display:flex;
            align-items: center;
            justify-content: space-between;
        }
        nav ul {
            display:flex;
        }
      

    </style>
</head>
<body>
    <div class="wrapper">
    <header>
    <h1>商品一覧</h1>
        <nav>
            <ul>
                <li><a href="logout.php">
                    ログアウト
                </a></li>
                <li> <a href="cartshopping.php">カートを見る</a></li>
            </ul>
        </nav>
</header>
    
   
    <table>
    <tr>
        <th>商品</th>
        <th>価格</th>
        <th>数量</th>
        <th>ボタン</th>
    </tr>
    <form action="" method="post">
        <tr>
            <td>Horizon</td>
            <td>4,000</td>
            <td>
            <select name="num">
            <?php for ($i = 1; $i < 10; $i++): ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php endfor; ?>
            </select>
        </td>
        <td>
        <input type="hidden" name="name" value="Horizon">
        <input type="hidden" name="price" value="4,000">
            <?php //追加済みであれば
            if(isset($cart['Horizon']) === TRUE):?>
          <span>追加済み</span>
          <?php else: ?>
            <input type="submit" value="カートに入れる">
            <?php endif; ?>
        </td>
        </tr>
        </form>
        <form action="" method="post">
            <tr>
                <td>アンチャーテッド</td>
                <td>3,000</td>
                <td>
                    <select name="num">
                        <?php for($i = 1;$i<10;$i++): ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                       <?php endfor; ?>
                        </select>
                </td>
                <td>
                    <input type="hidden" name="name" value="anchar">
                    <input type="hidden" name="price" value="3,000">
                    <?php 
                    if(isset($cart['anchar']) === TRUE):?>
                    <span>追加済み</span>
                  <?php else :?>
                    <input type="submit" value="カートに入れる">
                    <?php endif; ?>
                </td>
            </tr>
        </form>
        <form action="" method="post">
            <tr>
                <td>ウィッチャー</td>
                <td>5,000</td>
                <td>
                    <select name="num">
                        <?php for($i=1;$i<10;$i++): ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>
                </td>
                <td>
                    <input type="hidden" name="name" value="wicher">
                    <input type="hidden" name="price" value="5,000">
                    <?php 
                    if(isset($cart['wicher']) === TRUE) :?>
                    <span>追加済み</span>
                    <?php else: ?>
                    <input type="submit" value="カートに入れる">
                    <?php endif; ?>
                </td>
            </tr>
    </form>
    </table>
    </div>
</body>
</html>