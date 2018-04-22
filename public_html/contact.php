<?php include('includes/head.php'); ?>
    <title>Abhishek Chatterjee</title>
    <link rel="stylesheet" href="assets/css/layout1.css">
</head>
<body>
    <?php include('includes/header.php'); ?>
    <div class="container-fluid bb">
        <div class="box">
            <h1 class="display-4 text-uppercase text-center">
                contact us
            </h1>
            <hr>
            <p><b>The meeting of two personalities is like the contact of two chemical substances: if there is any reaction, both are transformed</b></p>
            <p>
            <i class="fa fa-envelope" aria-hidden="true"></i> - something@email.com
                <br>
                <i class="fa fa-phone" aria-hidden="true"></i>- +91-###-###-####
                <br>
                <i class="fa fa-map-marker" aria-hidden="true"></i> - City, State, Country ZIP
            </p>
        </div>
    </div>
    <?php include('includes/js.php'); ?>
    <script>
        $(document).ready(function(){
            $('.nav-item').removeClass('active');
            $('.contact').addClass('active');
        });
    </script>
</body>
</html>