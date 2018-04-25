<?php
    require_once('libs/Parsedown.php');
    require_once('../secure/db.php');
    require_once('functions/functions.php');
    $parse = new Parsedown();
?>
<?php include('includes/head.php'); ?>
    <title>Abhishek Chatterjee</title>
    <link rel="stylesheet" href="assets/css/index.css">
</head>
<body>
    <div class="container-fluid">
        <?php include('includes/header.php'); ?>
        <div class="hero">
            <div class="wrapper">
                <h1 class="display-1 text-center text-uppercase text-light">welcome to blog.com</h1>
                <hr class="text-light bg-light">
                <p class="text-center text-light">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim eligendi ipsum omnis consequatur possimus nemo quidem facere ex, cupiditate rem aliquid veritatis non ad magni sequi unde incidunt consectetur facilis?</p>
                <a href="about.php" class="btn btn-primary" style="width:80px;">More</a>
            </div>
        </div>
        <br>
        <div class="container">
            <h1 class="display-4 text-center text-uppercase">Categories</h1>
            <hr>
            <div class="row">
            <?php 
                $query = "SELECT * FROM categories LIMIT 6";
                $result = $sql->query($query);
                if($result){
                    if($result->num_rows > 0){
                        while($rows = $result->fetch_assoc()){
                            ?>
                                <div class="col-12 col-md-4">
                                    <div class="cate" style="background-image: url('handlers/categories_image.php?key=<?php echo $rows['id']; ?>');">
                                        <div class="cate-box">
                                            <p class="text-center text-light display-4 text-uppercase cate-text" data-replace="<?php echo $rows['description']; ?>"><?php echo $rows['title']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        }
                    }
                }
            ?>
            </div>
            <div class="text-center">
            <br>
            <a href="categories.php" class="btn btn-primary text-center">All Categories</a>
            </div>
            <hr>
            <br><br>
            <h2 class="display-4 text-center text-uppercase">Recent posts</h2>
            <hr>
            <div class="row">
                <?php
                    $query = "SELECT * FROM posts ORDER BY time DESC  LIMIT 9";
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
                                            <div class="col-12 col-md-4 post-box">
                                                <a href="post.php?key=<?php echo $rows['id']; ?>" class="post-title text-uppercase"><?php echo $rows['title']; ?></a><br>
                                                <small><?php echo 'Posted by ' . ucwords($name) . ' at ' . date('g:i a l jS \of F Y',strtotime(str_replace('-','/', $rows['time']))); ?></small><br><br>
                                                <div>
                                                    <?php 
                                                        //Need some work)
                                                        $content = preg_replace("/!\[[^\]]+\]\([^)]+\)/", "(Image)", $rows['content']);
                                                        $content = str_replace('#','', $content);
                                                        echo $parse->line(limit_text($content, 50));  
                                                    ?>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                }
                            }
                        } else {
                            ?>
                                <div class="post-box col-12">
                                    <p class="display-4 text-uppercase">You dont have any posts</p>
                                </div>
                            <?php
                        }
                    }
                ?>
            </div>
            <br>
            <div class="text-center">
            <a href="#" class="btn btn-primary more-post" style="width:80px;">More</a>
            </div><br>
            
        </div>
        <footer>
            <div class="footer-top">
                <h1 class="display-4 text-center text-uppercase">blog.com</h1>
                <nav class="footer-nav text-center text-uppercase">
                    <a href="index.php">HOME</a>
                    <span class="text-light">|</span>
                    <a href="posts.php">POSTS</a>
                    <span class="text-light">|</span>
                    <a href="contact.php">CONTACT</a>
                    <span class="text-light">|</span>
                    <a href="about.php">ABOUT</a>
                </nav>
                <div class="social text-center">
                    <a href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a>
                    <a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                    <a href="#"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                    <a href="#"><i class="fab fa-github" aria-hidden="true"></i></a>
                    <a href="#"><i class="fab fa-pinterest" aria-hidden="true"></i></a>
                </div>
            </div>
            <div class="footer-bottom text-center">
                <p class="text-white">Developed &amp; Designed by Abhishek Chatterjee</p>
            </div>
        </footer>    
    </div>
    <?php include('includes/js.php'); ?>
    <script>
        $(document).ready(function(){
            $('.nav-item').removeClass('active');
            $('.home').addClass('active');
            $('.cate-box').mouseenter(function(){
                $(this).find('p').fadeOut(250, function() {
                    var description = $(this).attr('data-replace');
                    var title = $(this).text();
                    $(this).attr('data-replace', title);
                    $(this).html(description).fadeIn(250);
                    $(this).removeClass('display-4');
                    $(this).addClass('w-75');
                });
            });
            $('.cate-box').mouseleave(function(){
                $(this).find('p').fadeOut(250, function() {
                    var title = $(this).attr('data-replace');
                    var description = $(this).text();
                    $(this).attr('data-replace', description);
                    $(this).html(title).fadeIn(250);
                    $(this).addClass('display-4');
                    $(this).removeClass('w-75');
                });
            });

            $('.my-navbar').css('backgroundColor', 'rgba(0,0,0,'+ $(window).scrollTop()/800 +')');
            $(document).scroll(function(){
                var st = $(window).scrollTop();
                $('.my-navbar').css('backgroundColor', 'rgba(0,0,0,'+st/800+')');
            });
        });
    </script>
</body>
</html>