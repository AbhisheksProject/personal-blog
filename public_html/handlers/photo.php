<?php
    require_once('../../secure/db.php');
    $key = addslashes(trim($_GET['key']));
    $query = "SELECT * FROM admin WHERE id = '$key'";
    $result = $sql->query($query);
    if($result){
        if($result->num_rows == 1){
            $data = $result->fetch_assoc();
            if($data['photo'] == ''){
                header('Content-type: image/svg+xml');
                echo '<?xml version="1.0" encoding="utf-8"?> <!-- Generator: IcoMoon.io --> <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd"> <svg width="32" height="33.762001037597656" viewBox="0 0 32 33.762001037597656" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g><path d="M 22,6c0-3.212-2.788-6-6-6S 10,2.788, 10,6c0,3.212, 2.788,6, 6,6S 22,9.212, 22,6zM 16,14c-5.256,0-10,5.67-10,12.716s 20,7.046, 20,0S 21.256,14, 16,14z"></path></g></svg>';
            } else {
                header('Content-type: image/jpeg');
                echo $data['photo'];
            }
        }
    }