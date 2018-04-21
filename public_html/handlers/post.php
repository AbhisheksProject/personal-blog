<?php
    session_start();
    if(!isset($_SESSION['loggedin']))
        header('Location: ../');
    
    $json = array(
        'success' => false
    );
    require_once('../../secure/db.php');
    $who = addslashes(trim($_SESSION['id']));
    $title = addslashes($_POST['title']);
    $content = addslashes($_POST['content']);

    if($title != '' && $content != ''){
        $query = "INSERT INTO posts(title, content, who) VALUES('$title', '$content', '$who')";
        $result = $sql->query($query);
        if($result){
            $json['success'] = true;
        } else {
            $json['success'] = false;
        }
    }
    header('Content-type: application/json');
    echo json_encode($json);