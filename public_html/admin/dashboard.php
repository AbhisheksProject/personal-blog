<?php
    session_start();
    require_once('../../secure/db.php');
    require_once('../functions/functions.php');
    require_once('../libs/Parsedown.php');
    if(!isset($_SESSION['loggedin']))
        header('Location: ./');
    $id = addslashes(trim($_SESSION['id']));
    $query = "SELECT * FROM admin WHERE id = '$id'";
    $result = $sql->query($query);
    if($result){
        if($result->num_rows==1){
            $me = $result->fetch_assoc();
        } else {
            exit();
        }
    } else {
        exit();
    }
    $parse = new Parsedown();
?>
<?php include('../includes/head.php'); ?>
<title><?php echo ucwords($me['name']); ?></title>
<link href="../handlers/photo.php?key=<?php echo $me['id']; ?>" rel="icon" type="image/png" />
<style>
.post-box{
    position: relative;
    overflow: auto;
}
    .post-time{
        color: gray;
    }
</style>
</head>
<body>
<?php include('../includes/admin/admin_header.php'); ?>
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
                                <div class="markdown-normal-text"><?php echo $parse->line(limit_text($rows['content'], 20)); ?></div>
                                <span class="post-time float-right">
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
                            <p class="display-4 text-uppercase">YOu don't have any posts</p>
                        </div>
                    <?php
                }
            }
        ?>
    </div>
<?php include('../includes/js.php'); ?>
<script>
    $(document).ready(function(){
        $('.nav-item').removeClass('active');
        $('.home').addClass('active');
    });
</script>
</body>
</html>