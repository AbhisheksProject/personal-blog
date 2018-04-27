<?php
    require_once('libs/Parsedown.php');
    require_once('../secure/db.php');
    require_once('functions/functions.php');
    $parse = new Parsedown();
?>
<?php include('includes/head.php'); ?>
    <title>Abhishek Chatterjee</title>
    <link rel="stylesheet" href="assets/css/posts.css">
</head>
<body>
    <div class="container-fluid">
        <?php include('includes/header.php'); ?>
        <br><br><br>
        <form action="#" method="get">
            <input type="search" placeholder="Search..." class="form-control">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        <div class="container">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#posts">Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#authors">Authors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#categories">Categories</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active container" id="posts">
                    <h1>Posts</h1>
                </div>
                <div class="tab-pane container" id="authors">
                    <h1>Authors</h1>
                </div>
                <div class="tab-pane container" id="categories">
                    <h1>Categories</h1>
                </div>
            </div>
        </div>
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