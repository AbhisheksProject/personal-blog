<?php
    require_once('../../secure/db.php');
    $key = addslashes(trim($_GET['key']));
    $query = "SELECT * FROM categories WHERE id = '$key'";
    $result = $sql->query($query);
    if($result){
        if($result->num_rows == 1){
            $data = $result->fetch_assoc();
            header('Content-type: image/jpeg');
            echo $data['image'];
        }
    }