<?php
    $json = array(
        'success' => false,
        'error' => 'none'
    );
    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = addslashes(trim($_POST['username']));
        $password = addslashes($_POST['password']);
        if($username != '' && $password != ''){
            require_once('../../secure/db.php');
            require_once('../../secure/hashing.php');

            $query = "SELECT * FROM admin WHERE username = ?";

            $stmt = $sql->prepare($query);

            $stmt->bind_param('s', $username);

            $stmt->execute();

            $result = $stmt->get_result();
            
            if($result){
                if($result->num_rows == 1){
                    $data = $result->fetch_assoc();
                    $password = hashPassword($password);
                    if($data['password'] == $password){
                        $json['success'] = true;
                        session_start();
                        $_SESSION['loggedin'] = true;
                        $_SESSION['id'] = $data['id'];
                    } else {
                        $json['error'] = 'password';
                    }
                } else {
                    $json['error'] = 'username';
                }
            } else {
                $json['error'] = 'server';
            }
        }
    }
    header('Content-type: application/json');
    echo json_encode($json);