<?php
    $json = array(
        'success' => false,
        'error' => 'none'
    );

    if(isset($_POST['name']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['description'])){
        $name = addslashes($_POST['name']);
        $username = addslashes(trim($_POST['username']));
        $password = addslashes($_POST['password']);
        $description = addslashes($_POST['description']);

        if($name != '' && $username != '' && $password != '' && $description != ''){
            require_once('../../secure/db.php');
            require_once('../../secure/hashing.php');
            
            $password = hashPassword($password);

            $queryAlpha = "SELECT * FROM admin WHERE username = '$username'";

            $resultAlpha = $sql->query($queryAlpha);

            if($resultAlpha){
                if($resultAlpha->num_rows == 0){
                    $query = "INSERT INTO admin(name, username, password, description) VALUES('$name', '$username', '$password', '$description')";

                    $result = $sql->query($query);

                    if($result){
                        session_start();
                        session_destroy();
                        $json['success'] = true;
                    } else {
                        $json['success'] = false;
                    }
                } else {
                    $json['success'] = false;
                    $json['error'] = 'username';
                }
            } else {
                $json['success'] = false;
                $json['error'] = 'server';
            }
        }
    }
    header('Content-type: application/json');
    echo json_encode($json);