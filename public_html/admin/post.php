<?php
    session_start();
    if(!isset($_SESSION['loggedin']))
        header('Location: ./');
    
    require_once('../../secure/db.php');
    require_once('../functions/functions.php');
    $id = addslashes(trim($_SESSION['id']));
    $query = "SELECT * FROM admin WHERE id = '$id'";
    $result = $sql->query($query);
    if($result){
        if($result->num_rows==1){
            $me = $result->fetch_assoc();
        }
    }
    if(isset($_GET['key']))
        $key = addslashes(trim($_GET['key']));
    else header('Location: dashboard.php');

    require_once('../libs/Parsedown.php');
    $parse = new Parsedown();
?>
<?php include('../includes/head.php'); ?>
<title><?php echo ucwords($me['name']); ?></title>
<link href="../handlers/photo.php?key=<?php echo $me['id']; ?>" rel="icon" type="image/png" />
<style>
    .post-time{
        color: gray;
    }
</style>
</head>
<body>
<?php include('../includes/admin/admin_header.php'); ?><br>
    <div class="container">
    <?php 
        $query = "SELECT * FROM posts WHERE id = '$key'";
        $result = $sql->query($query);
        if($result){
            if($result->num_rows == 1){
                $data = $result->fetch_assoc();
                if($data['who'] == $me['id']){
                    ?>
                    <h1 class="display-3 text-uppercase"><?php echo $data['title']; ?></h1>
                    <hr>
                    <p><?php echo $parse->text($data['content']); ?></p>
                    <span class="post-time floatasd-right">
                        <?php 
                            echo 'Posted ' . date('l jS \of F Y',strtotime(str_replace('-','/', $data['time'])));
                        ?>
                    </span>
                    <br>
                    <div class="btn-group float-right">
                        <a href="edit.php?key=<?php echo $data['id']; ?>" class="btn btn-primary" style="width:80px;border-right:2px solid white;">Edit</a>
                        <a href="../handlers/delete_post.php?key=<?php echo $data['id']; ?>" class="btn btn-primary delete" style="width:80px;">Delete</a>
                    </div>
                    <?php
                } else {
                    header('Location: dashboard.php');
                }
            }
        }
    ?>  
    </div>
<?php include('../includes/js.php'); ?>
<script>
    $(document).ready(function(e){
        $('.nav-item').removeClass('active');
        $('.newpost').addClass('active');
        $('.delete').click(function(e){
            e.preventDefault();
            $.ajax({
                type: 'get',
                url: $('.delete').attr('href'),
                success: function(e){
                    if(e['success']){
                        window.location = "dashboard.php";
                    } else if(!e['success']){
                        alert('Something went wrong');
                    }
                }
            });
        });
    });
</script>
</body>
</html>