<?php
    require_once('libs/Parsedown.php');
    $parse = new Parsedown();
?>
<?php include('includes/head.php'); ?>
    <title>Abhishek Chatterjee</title>
    <style>
        .markdown-normal-text h1, .markdown-normal-text h2, .markdown-normal-text h3, .markdown-normal-text h4, .markdown-normal-text h5, .markdown-normal-text h6, .markdown-normal-text p{
            font-size: 1rem;
        }
    </style>
</head>
<body>
    <?php include('includes/header.php'); ?>
    <div class="container">
    <h1 class="display-1 text-uppercase">my all posts</h1> 
        <hr>
        <?php
            require_once('../secure/db.php');
            require_once('functions/functions.php');
            $query = "SELECT * FROM posts";
            $result = $sql->query($query);
            if($result){
                if($result->num_rows > 0){
                    while($rows = $result->fetch_assoc()){
                        $who = $rows['who'];
                        $query2 = "SELECT * FROM admin WHERE id = '$who'";
                        $result2 = $sql->query($query2);
                        if($result2){
                            if($result2->num_rows == 1){
                                $who = $result2->fetch_assoc();
                                $name = $who['name']
                                ?>
                                    <div class="post-box">
                                        <a href="post.php?key=<?php echo $rows['id']; ?>" class="display-4 text-uppercase"><?php echo $rows['title'] ?></a>
                                        <div class="markdown-normal-text"><?php echo $parse->text(limit_text($rows['content'], 20)); ?></div>
                                        <small class="post-author">
                                        <?php
                                            echo 'Posted by ' . ucwords($name) . ' at ' . date('g:i a l jS \of F Y',strtotime(str_replace('-','/', $rows['time']))); 
                                        ?>
                                        </small>
                                    </div>
                                    <hr>
                                <?php
                            }
                        }
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

    <?php include('includes/js.php'); ?>
    <script>
        $(document).ready(function(){
            $('.nav-item').removeClass('active');
            $('.posts').addClass('active');
        });
    </script>
</body>
</html>