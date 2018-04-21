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

    $key = addslashes(trim($_GET['key']));
    $query = "SELECT * FROM posts WHERE id = '$key'";
    $result = $sql->query($query);
    if($result){
        if($result->num_rows == 1){
            $data = $result->fetch_assoc();
            if($data['who'] == $me['id']){
                $title = $data['title'];
                $content = $data['content'];
            } else {
                header('Location: dashboard.php');
            }
        }
    }
?>
<?php include('../includes/head.php'); ?>
<title><?php echo ucwords($me['name']); ?></title>
</head>
<body>
<?php include('../includes/admin/admin_header.php'); ?>
    <div class="container">
        <form action="../handlers/edit_post.php" method="post">
            <h1 class="display-1 text-uppercase">edit post</h1>
            <input type="text" name="title" class="form-control" placeholder="Title" requird autofocus value="<?php echo $title; ?>"><br>
            <textarea name="content" id="content" cols="30" rows="15" class="form-control" placeholder="Write your post here" requird><?php echo $content; ?></textarea>
            <br>
            <button type="submit" class="btn btn-primary float-right" style="width:80px;">Update</button>
        </form>
    </div>
<?php include('../includes/js.php'); ?>
<script>
    $(document).ready(function(){
        $('form').submit(function(e){
            
            e.preventDefault();
            var data = $(this).serialize() + '&id=<?php echo $data['id']; ?>';
            $.ajax({
                type: 'post',
                url: $(this).attr('action'),
                data: data,
                success: function(e){
                    if(e['success']){
                        window.location = 'post.php?key=<?php echo $data['id']; ?>'
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