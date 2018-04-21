<?php 
    session_start();
    $json = array(
        'success' => false
    );
    if(isset($_SESSION['loggedin'])){
        require_once('../../secure/db.php');
        $name = addslashes($_POST['name']);
        $description = addslashes($_POST['description']);
        $id = addslashes(trim($_SESSION['id']));
        if($name != '' && $description != ''){
            $query = "UPDATE admin SET name = '$name', description = '$description' WHERE id = '$id'";
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