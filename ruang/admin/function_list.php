<?php
    // include "$_SERVER[DOCUMENT_ROOT]/TrakFlex/core/init.php";
    // if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     
        $id           = isset($_POST['id']) ? $_POST['id'] : '';
        $user_name    = isset($_POST['user_name']) ? $_POST['user_name'] : '';

        $level      = isset($_POST['level']) ? $_POST['level'] : '';
        
        if ($id == 'create' &&  $user_name && $adress){
            include "config.php";
            $name       = str_replace(' ', '-', $image["name"]);
            $bannerpath ="images/".$name;
            $flag       = move_uploaded_file($image["tmp_name"],$bannerpath);
            $sql        = "INSERT INTO `order`(`product_name`, `image`, `adress`, `user_name`) VALUES ('{$product_name}','{$name}','{$adress}','{$user_name}')";
            $order      = mysqli_query($conn, $sql);
            $data       = mysqli_query($conn, "SELECT * FROM `order` WHERE `id`='{$conn->insert_id}'")->fetch_array(MYSQLI_ASSOC);
            echo json_encode([
                'status' => 200,
                'data'   => $data
            ]);
            exit();
        }

        if (isset($_POST['delete']) && $id) {
            include "config.php";
            $data       = mysqli_query($conn, "SELECT * FROM `order` WHERE `id`='{$id}' LIMIT 1")->fetch_array(MYSQLI_ASSOC);
            // unlink("images/" . $data['image']);
            $sql        = "DELETE FROM `order` WHERE id={$id}";
            $order      = mysqli_query($conn, $sql);
            if ($order) {
                echo json_encode([
                    'status' => 200,
                    'data'   => ''
                ]);
            }
            exit();
        }
        
        if ($id && $user_name && $product_name && $adress) {
            include "config.php";
            if ($image) {
                $name       = str_replace(' ', '-', $image["name"]);
                $bannerpath ="images/".$name;
                $flag       = move_uploaded_file($image["tmp_name"],$bannerpath);
                $sql        = "UPDATE `order` SET `product_name`='{$product_name}',`image`='{$name}',`adress`='{$adress}',`user_name`='{$user_name}' WHERE `id`='{$id}'";
            } else {
                $sql        = "UPDATE `order` SET `product_name`='{$product_name}',`adress`='{$adress}',`user_name`='{$user_name}' WHERE `id`='{$id}'";
            }
            $order      = mysqli_query($conn, $sql);
            $data       = mysqli_query($conn, "SELECT * FROM `order` WHERE `id`='{$id}'")->fetch_array(MYSQLI_ASSOC);
            // while($row = $data) {
            //     $results[] = $row;
            // }
            echo json_encode([
                'status' => 200,
                'data'   => $data
            ]);
        }
        
        
    // } 

?>