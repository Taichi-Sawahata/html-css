<?php 
session_start();
$cart = array();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = $_POST['name'];
    $kind = $_POST['kind'];
    if($kind === 'change'){
    //キーの値はここで入れられる
        $num = $_POST['num'];
      $_SESSION['cart'][$name] = $num;
    }elseif($kind === 'delete'){
      unset($_SERVER['cart'][$name]);
    }
}

if(isset($_SESSION['cart'])){
    $cart = $_SESSION['cart'];
}


?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ショッピングカート</title>
    <style>
        header{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        li {
            list-style: none;
            padding: 0 8px 0;
        }
        a{
            text-decoration: none;
        }
        
        nav ul {
            display: flex;
        }

        .wrapper{
            max-width: 90%;
            margin: 0 auto;
        }

    </style>
</head>
<body>
    <div class="wrapper">
        
        <header>
        <h1>ショッピングカート</h1>
            <nav>
                <ul>
                    <li><a href="shop.php">商品一覧へ</a></li>
                    <li><a href="deleting.php">カートを全て空に</a></li>
                </ul>
            </nav>
        </header>
        <table style="text-align:center">
            <tr>
                <th>商品</th>
                <th>個数</th>
                <th>数量</th>
                <th>変更ボタン</th>
                <th>削除ボタン</th>
        </tr>
        <?php foreach($cart as $key => $val):?>
        <tr>         
           <td>
        <?php
        if($key == 'Horizon'){
            echo 'Horizon';
        }elseif($key == 'anchar'){
            echo 'アンチャーテッド';
        }elseif($key == 'wicher'){
            echo 'ウィッチャー';
        }
        
        ?>
           </td>
           <td><?php echo $val ?>個</td>
           <form action="" method="post">
                <td>
                <select name="num">
                <?php for($i=1;$i<10;$i++) :?>
          <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
          <?php endfor; ?>
          </select>
                </td>
        
                <td>
                <input type="hidden" name="kind" value="change">
                <input type="hidden" name="name" value="<?php echo $key ?>">
                <input type="submit" value="変更">
            </td>
        </form>
        <form action="" method="post">
           <td>
            <input type="hidden" name="kind" value="delete">
            <input type="hidden" name="name" value="<?php echo $key ?>">
            <input type="submit" value="削除">
           </td>
           </form>
        </tr>
        <?php endforeach; ?>
        </table>
    </div>
    <?php 

    ?>
</body>
</html>