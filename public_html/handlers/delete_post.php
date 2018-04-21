<?php
    session_start();
    if(!isset($_SESSION['loggedin']))
        header('Location: ../');
    
    $json = array(
        'success' => false
    );
    require_once('../../secure/db.php');
    $id = addslashes(trim($_GET['key']));

    $me = $_SESSION['id'];

    $query = "DELETE FROM posts WHERE who = '$me' AND id = '$id'";
    $result = $sql->query($query);
    if($result){
        $json['success'] = true;
    } else {
        $json['success'] = false;
    }

    header('Content-type: application/json');
    echo json_encode($json);