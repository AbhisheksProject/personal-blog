<?php
    session_start();
    if(!isset($_SESSION['loggedin']))
        header('Location: ../');
    
    $json = array(
        'success' => false
    );
    require_once('../../secure/db.php');
    $id = addslashes(trim($_POST['id']));
    $title = addslashes($_POST['title']);
    $content = addslashes($_POST['content']);

    if($title != '' && $content != ''){
        $query = "UPDATE posts SET title = '$title', content = '$content' WHERE id = '$id'";
        $result = $sql->query($query);
        if($result){
            $json['success'] = true;
        } else {
            $json['success'] = false;
        }
    }
    header('Content-type: application/json');
    echo json_encode($json);