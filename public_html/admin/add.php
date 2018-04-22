<?php
    session_start();
    if(!isset($_SESSION['loggedin'])){
        header('Location: dashboard.php');
    }
    require_once('../../secure/db.php');
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
    <title>Abhishek Chatterjee</title>
    <style>
        .wrapper {    
            margin-top: 80px;
            margin-bottom: 20px;
        }

        .form-signin {
        max-width: 420px;
        padding: 30px 38px 66px;
        margin: 0 auto;
        border: 3px solid rgba(0,0,0,0.1);  
        }

        .form-signin-heading {
        text-align:center;
        margin-bottom: 30px;
        }

        .form-control {
        position: relative;
        font-size: 16px;
        height: auto;
        padding: 10px;
        }

        input[type="text"] {
        margin-bottom: 0px;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
        }

        input[type="password"] {
        margin-bottom: 20px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        }

        .colorgraph {
        height: 7px;
        border-top: 0;
        background: #c4e17f;
        border-radius: 5px;
        background-image: -webkit-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
        background-image: -moz-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
        background-image: -o-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
        background-image: linear-gradient(to right, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
        }
    </style>
    <link href="../handlers/photo.php?key=<?php echo $me['id']; ?>" rel="icon" type="image/png" />
</head>
<body>
    <?php include('../includes/admin/admin_header.php'); ?>
    <div class = "container">
        <div class="wrapper">
            <form action="../handlers/registration.php" method="post" name="Login_Form" class="form-signin">       
                <h3 class="form-signin-heading">So Ready To Create An Account</h3>
                <hr class="colorgraph"><br>
                <input type="text" placeholder="Name" class="form-control" id="name" name="name" required autofocus>
                <input type="text" class="form-control" name="username" id="username" placeholder="Username" required />
                <div class="invalid-feedback">
                    This username is already registared with other account
                  </div>
                <input type="password" class="form-control" name="password" placeholder="Password" required=""/>     	
                
                <textarea name="description" class="form-control" placeholder="Description"></textarea>
                
                <br>
                <button class="btn btn-lg btn-primary btn-block"  name="register" value="Login" type="Submit">Register</button>  
            </form>			
        </div>
    </div>
    <?php include('../includes/js.php'); ?>
    <script>
        $(document).ready(function(){
            $('.nav-item').removeClass('active');
            $('.addadmin').addClass('active');
            $("#username").on("change paste", function(){
                $.ajax({
                    type: 'post',
                    data: 'username=' + $('#username').val(),
                    url: '../handlers/username.php',
                    success: function(e){
                        if(e['valid'] == false){
                            $('#username').addClass('is-invalid');
                        } else {
                            $('#username').removeClass('is-invalid');
                        }
                        
                    }
                });
            });
            $('.form-signin').submit(function(e){
                e.preventDefault();
                var data = $(this).serialize();
                var url = $(this).attr('action');
                $.ajax({
                    type: 'post',
                    url: url,
                    data: data,
                    success: function(e){
                        if(e['success']){
                            window.location = '/admin/';
                        }
                        if(e['error'] == 'server'){
                            alert('Oops something went wrong!!!');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>