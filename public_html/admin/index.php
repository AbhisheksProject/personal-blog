<?php 
    session_start();
    if(isset($_SESSION['loggedin']))    
        header('Location: dashboard.php');
?>
<?php include('../includes/head.php'); ?>
    <title>Abhishek Chatterjee</title>
    <link rel="stylesheet" href="../assets/css/forms.css">
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