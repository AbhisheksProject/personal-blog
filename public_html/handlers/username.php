<?php 
    require_once('../../secure/db.php');
    $username = addslashes(trim($_POST['username']));

    $query = "SELECT * FROM admin WHERE username = '$username'";

    $result = $sql->query($query);

    $json = array(
        'success' => false,
        'valid' => false
    );

    echo mysqli_error($sql);
    
    if($result){
        if($result->num_rows == 0){
            $json['success'] = true;
            $json['valid'] = true;
        } else {
            $json['success'] = false;
            $json['valid'] = false;
        }
    } else {
        $json['success'] = false;
        $json['valid'] = false;
    }

    header('Content-type: application/json');
    echo json_encode($json);