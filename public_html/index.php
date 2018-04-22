<?php include('includes/head.php'); ?>
    <title>Abhishek Chatterjee</title>
</head>
<body>
    <?php include('includes/header.php'); ?>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-1 text-center text-uppercase">This is abhishek chatterjee</h1>
            <p class="lead text-center">Welcome to my blog project.</p>
        </div>
    </div>

    <?php include('includes/js.php'); ?>
    <script>
        $(document).ready(function(){
            $('.nav-item').removeClass('active');
            $('.home').addClass('active');
        });
    </script>
</body>
</html>