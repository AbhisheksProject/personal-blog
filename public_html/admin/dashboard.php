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
?>
<?php include('../includes/head.php'); ?>
<title><?php echo ucwords($me['name']); ?></title>
<style>
    .post-time{
        color: gray;
    }
</style>
</head>
<body>
<?php include('../includes/admin/admin_header.php'); ?>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-1 text-center text-uppercase">This is <?php echo $me['name']; ?></h1>
            <p class="lead text-center">This is the Admin Panel</p>
        </div>
    </div>
    <div class="container">
        <h1 class="display-1 text-uppercase">my all posts</h1> 
        <hr>
        <?php
            $query = "SELECT * FROM posts WHERE who = '$id'";
            $result = $sql->query($query);
            if($result){
                if($result->num_rows > 0){
                    while($rows = $result->fetch_assoc()){
                        ?>
                            <div class="post-box">
                                <a href="post.php?key=<?php echo $rows['id']; ?>" class="display-4 text-uppercase"><?php echo $rows['title'] ?></a>
                                <p><?php echo limit_text($rows['content'], 20); ?></p>
                                <span class="post-time floatasd-right">
                                <?php 
                                    echo 'Posted ' . date('l jS \of F Y',strtotime(str_replace('-','/', $rows['time'])));
                                ?>
                                </span>
                            </div>
                            <hr>
                        <?php
                    }
                } else {
                    ?>
                        <div class="post-box">
                            <p class="display-4 text-uppercase">YOu dont have any posts</p>
                        </div>
                    <?php
                }
            }



        ?>
    </div>
<?php include('../includes/js.php'); ?>
</body>
</html>