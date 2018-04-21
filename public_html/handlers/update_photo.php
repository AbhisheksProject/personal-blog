<?php 
    session_start();
    $json = array(
        'success' => false
    );
    if(isset($_SESSION['loggedin'])){
        require_once('../../secure/db.php');
        $photo = $_FILES['photo']['tmp_name'];
        $id = addslashes(trim($_SESSION['id']));
        if(getimagesize($_FILES['photo']['tmp_name']) != FALSE){
            $image = addslashes($photo);
            $image = file_get_contents($image);

            $query = "UPDATE admin SET photo = '$image' WHERE id = '$id'";
            $result = $sql->query($query);
            if($result){
                $json['success'] = true;
            }
        }
        header('Content-type: application/json');
        echo json_encode($json);
    } else {
        header('Location: ../index.php');
    }