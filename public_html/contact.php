<?php include('includes/head.php'); ?>
    <title>Abhishek Chatterjee</title>
    <style>
        body{
            display: flex;
            flex-direction: column;
            width: 100%;
            height: 100vh;
        }
        .bb{
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .box{
            border: 1px solid black;
            width: 500px;
            padding: 25px;
        }
        i{
            font-weight: 100;
        }
    </style>
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