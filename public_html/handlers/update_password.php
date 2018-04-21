<?php 
    session_start();
    $json = array(
        'success' => false,
        'error' => false
    );
    if(isset($_SESSION['loggedin'])){
        require_once('../../secure/db.php');
        require_once('../../secure/hashing.php');
        $old = addslashes($_POST['old']);
        $new = addslashes($_POST['new']);
        $id = addslashes(trim($_SESSION['id']));
        if($old != '' && $new != ''){
            $query = "SELECT * FROM admin WHERE id = '$id'";
            $result = $sql->query($query);
            if($result){
                if($result->num_rows == 1){
                    $data = $result->fetch_assoc();
                    if($data['password'] == hashPassword($old)){
                        $password = hashPassword($new);
                        $query2 = "UPDATE admin SET password = '$password' WHERE id = '$id'";
                        $result2 = $sql->query($query2);
                        if($result2){
                            $json['success'] = true;
                        }
                    } else {
                        $json['error'] = true;
                    }
                }
            }
        }
        header('Content-type: application/json');
        echo json_encode($json);
    } else {
        header('Location: ../index.php');
    }