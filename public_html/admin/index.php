<?php 
    session_start();
    if(isset($_SESSION['loggedin']))    
        header('Location: dashboard.php');

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
        margin-bottom: 0;
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
</head>
<body>
    <div class = "container">
        <div class="wrapper">
            <form action="../handlers/login.php" method="post" name="Login_Form" class="form-signin">       
                <h3 class="form-signin-heading">Welcome Back! Please Sign In</h3>
                <hr class="colorgraph"><br>
                
                <input type="text" class="form-control" name="username" placeholder="Username" id="username" required autofocus />
                <div class="invalid-feedback">
                    Invalid Username!
                </div>
                <div>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required/>     	
                    <div class="invalid-feedback">
                        Invlaid Password
                    </div>	  
                </div>
                <br>
                <button class="btn btn-lg btn-primary btn-block"  name="Submit" value="Login" type="Submit">Login</button>  	
            </form>			
        </div>
    </div>
    <?php include('../includes/js.php'); ?>
    <script>
        $(document).ready(function(){
            $('.form-signin').submit(function(e){
                e.preventDefault();
                $.ajax({
                    type: 'post',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(e){
                        if(e['success']){
                            window.location = 'dashboard.php';
                        }
                        if(e['error'] == 'username'){
                            $('#username').addClass('is-invalid');
                            $('#password').removeClass('is-invalid');    
                        } else if(e['error'] == 'password'){
                            $('#username').removeClass('is-invalid');
                            $('#password').addClass('is-invalid'); 
                        }
                    }
                });
            })
        });
    </script>
</body>
</html>