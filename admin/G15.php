<?php
    session_start();
    if($_SESSION['admin_login'] == false){
        header("Location:./G1.php");
        exit;
    }
    $maneger_id=isset($_POST['maneger_id'])? htmlspecialchars($_POST['maneger_id'], ENT_QUOTES, 'utf-8'):'';
    $product_name = isset($_POST['product_name'])? htmlspecialchars($_POST['product_name'], ENT_QUOTES, 'utf-8'):'';
    $size = isset($_POST['product_size'])? htmlspecialchars($_POST['product_size'], ENT_QUOTES, 'utf-8'):'';
    $color = isset($_POST['product_color'])? htmlspecialchars($_POST['product_color'], ENT_QUOTES, 'utf-8'):'';
    $color = nl2br($color);
    $stock = isset($_POST['inventory_stock'])? htmlspecialchars($_POST['inventory_stock'], ENT_QUOTES, 'utf-8'):'';
    $body = isset($_POST['product_body'])? htmlspecialchars($_POST['product_body'], ENT_QUOTES, 'utf-8'):'';
    $body = nl2br($body);
    $price = isset($_POST['product_price'])? htmlspecialchars($_POST['product_price'], ENT_QUOTES, 'utf-8'):''; 

    if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
               //HTTP POST OK;
            $file_name = "system.imags/".$_FILES["img"]["name"];
        if (pathinfo($file_name, PATHINFO_EXTENSION) == 'jpg' || pathinfo($file_name, PATHINFO_EXTENSION) == 'png') {
           //拡張子OK
           //元のアップロード先
           $file_tmp_name = $_FILES["img"]["tmp_name"];
           if (move_uploaded_file($file_tmp_name, "system.imags/". $file_name)) {
               //アップロード完了
               //DB接続
            try{
                $pdo = new PDO('mysql:host=mysql310.phy.lolipop.lan;
                            dbname=LAA1554917-system;charset=utf8',
                            'LAA1554917',
                             'PassSD2D');
            }catch(PDOException $e){
                var_dump($e->getMessage());
                exit;
            }
            
            $stmt = $pdo->prepare("INSERT INTO product(
                maneger_id,
                product_name,
                product_size,
                product_color,
                inventory_stock,
                product_price,
                product_photo,
                product_body,
                created_at,
                update_at
            ) VALUES(
                :maneger_id,
                :product_name,
                :size,
                :color,
                :stock,
                :price,
                :img_path,
                :body,
                now(),
                now()
            )");
                    $stmt->bindParam(':maneger_id',$maneger_id);
                    $stmt->bindParam(':product_name',$product_name);
                    $stmt->bindParam(':size',$size);
                    $stmt->bindParam(':color',$color);
                    $stmt->bindParam(':stock',$stock);
                    $stmt->bindParam(':body',$body);
                    $stmt->bindParam(':price',$price);
                    $stmt->bindParam(':img_path',$file_name);
                    $stmt->execute();
            
                    echo "登録完了";
                    echo '<link><a href="G8.php">商品一覧画面へ戻る</a></link>';
           } else {
               echo "画像をアップロードできません。";
               exit;
           }

        } else {
           echo "ファイル形式はjpg/pngのみです";
           exit;
        }
    } else {
        echo "何らからの攻撃をうけました";
        exit;
    }
