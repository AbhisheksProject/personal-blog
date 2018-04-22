<?php
    session_start();
    require_once('../../secure/db.php');
    if(!isset($_SESSION['loggedin']))
        header('Location: ./');
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
<title><?php echo ucwords($me['name']); ?></title>
<link href="../handlers/photo.php?key=<?php echo $me['id']; ?>" rel="icon" type="image/png" />
</head>
<body>
<?php include('../includes/admin/admin_header.php'); ?>
    <div class="container">
        <form action="../handlers/post.php" method="post">
            <h1 class="display-1 text-uppercase">post something</h1>
            <input type="text" name="title" class="form-control" placeholder="Title" requird autofocus><br>
            <textarea name="content" id="content" cols="30" rows="15" class="form-control" placeholder="Write your post here" requird></textarea>
            <br>
            <button type="submit" class="btn btn-primary float-right" style="width:80px;">Post</button>
        </form>
    </div>
<?php include('../includes/js.php'); ?>
<script>
    $(document).ready(function(){
        $('.nav-item').removeClass('active');
        $('.newpost').addClass('active');
        $('form').submit(function(e){
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function(e){
                    if(e['success']){
                        window.location = 'dashboard.php'
                    } else if(e['success']) {
                        alert('something went wrong');
                    }
                }
            });
        });
    });
</script>
</body>
</html>