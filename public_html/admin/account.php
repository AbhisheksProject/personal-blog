<?php
    session_start();
    if(!isset($_SESSION['loggedin']))
        header('Location: ./');
    
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
<title><?php echo ucwords($me['name']); ?></title>
<link href="../handlers/photo.php?key=<?php echo $me['id']; ?>" rel="icon" type="image/png" />
<style>
    .hidden{
        display: none;
    }
    .image{
        border-radius: 50%;
        width: 200px;
        height: 200px;
        cursor: pointer;
    }
    .image-label{
        display: flex;
        justify-content: center;
    }
</style>
</head>
<body>
<?php include('../includes/admin/admin_header.php'); ?>
    <div class="container">
        <h1 class="display-1 text-uppercase">My account</h1>
        <br>
        <div class="row">
            <form class="col-12 col-lg-6" action="../handlers/update_photo.php" id="image" method="post" enctype="multipart/form-data">
                <label for="photo" class="image-label">
                    <img src="../handlers/photo.php?key=<?php echo $id; ?>" class="image img-thumbnail center-block">
                </label>
                <input type="file" id="photo" class="hidden" name="photo">
            </form>
            <div class="col-12 col-lg-6">
                <form action="#" id="info">
                    <div class="form-group">
                        <input type="text" placeholder="Name" name="name" value="<?php echo $me['name']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Description"><?php echo $me['description']; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary float-right" style="width:80px;">Save</button>
                    <br><br><br>
                </form>
            </div>
            <div class="col-12">
                <form action="" id="password">
                    <div class="form-group">
                        <input type="password" placeholder="Old Password" name='old' class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="New Password" name='new' class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary float-right" style="width:80px;">Save</button>
                </form>
            </div>
        </div>
    </div>
<?php include('../includes/js.php'); ?>
<script>
    $(document).ready(function(){
        $('.nav-item').removeClass('active');
        $('.account').addClass('active');
        $('#image').change(function(){
            $('#image').submit();
        });
        $('#image').submit(function(e){
            e.preventDefault();
            var url = '../handlers/update_photo.php';
            var data = new FormData($(this)[0]);
            $.ajax({
                type: 'post',
                url : url,
                data: data,
                processData: false,
                contentType: false,
                beforSend: function(){
                    alert('sending');
                },
                success: function(e){
                    if(e['success']){
                        alert('New informations updated!!!');
                    } else {
                        alert('Something went wrong!!!');
                    }
                }
            });
        });
        $('#info').submit(function(e){
            e.preventDefault();
            var url = '../handlers/update_info.php';
            var data = $(this).serialize();
            $.ajax({
                type: 'post',
                url : url,
                data: data,
                success: function(e){
                    if(e['success']){
                        alert('New informations updated!!!');
                    } else {
                        alert('Something went wrong!!!');
                    }
                }
            });
        });
        $('#password').submit(function(e){
            e.preventDefault();
            var url = '../handlers/update_password.php';
            var data = $(this).serialize();
            $.ajax({
                type: 'post',
                url : url,
                data: data,
                success: function(e){
                    console.log(e['success']);

                    if(e['success']){
                        alert('Password updated!!!');
                    } else if(e['error']){
                        alert('Sorry, old password didn\' match!!!');
                    } else {
                        alert('Something went wrong!!!');
                    }
                }
            });
        });
    });
</script>
</body>
</html>