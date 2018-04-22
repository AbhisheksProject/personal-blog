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
        } else {
            exit();
        }
    } else {
        exit();
    }
?>
<?php include('../includes/head.php'); ?>
    <title>Abhishek Chatterjee</title>
    <link rel="stylesheet" href="../assets/css/forms.css">
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