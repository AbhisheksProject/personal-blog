<?php include('includes/head.php'); ?>
    <title>Abhishek Chatterjee</title>
    <link rel="stylesheet" href="assets/css/layout1.css">
</head>
<body>
    <?php include('includes/header.php'); ?>
    <div class="container-fluid bb">
        <div class="box">
            <h1 class="display-4 text-uppercase text-center">
                about
            </h1>
            <hr>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sed accusantium adipisci iure vero facilis, perspiciatis id quos unde libero vitae?</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam voluptas ipsam autem? Laborum, temporibus dolore?</p>
        </div>
    </div>
    <?php include('includes/js.php'); ?>
    <script>
        $(document).ready(function(){
            $('.nav-item').removeClass('active');
            $('.about').addClass('active');
        });
    </script>
</body>
</html>