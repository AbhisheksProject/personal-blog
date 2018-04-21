<?php
    require_once('../secure/db.php');
    if(isset($_GET['key']))
        $key = addslashes(trim($_GET['key']));
    else header('Location: posts.php');
?>
<?php include('/includes/head.php'); ?>
<title>Abhishek Chatterjee</title>
<style>
    .post-time{
        color: gray;
    }
</style>
</head>
<body>
<?php include('/includes/header.php'); ?><br>
    <div class="container">
    <?php 
        $query = "SELECT * FROM posts WHERE id = '$key'";
        $result = $sql->query($query);
        if($result){
            if($result->num_rows == 1){
                $data = $result->fetch_assoc();
                $who = $data['who'];
                $query2 = "SELECT * FROM admin WHERE id = '$who'";
                $result2 = $sql->query($query2);
                if($result2){
                    if($result2->num_rows == 1){
                        $row = $result2->fetch_assoc();
                        $name = $row['name'];
                    }
                }
                ?>
                <h1 class="display-3 text-uppercase"><?php echo $data['title']; ?></h1>
                <small class="post-author">
                    <?php
                        echo 'Posted by ' . ucwords($name) . ' at ' . date('g:i a l jS \of F Y',strtotime(str_replace('-','/', $data['time']))); 
                    ?>
                </small>
                <hr>
                <p><?php echo $data['content'] ?></p>
                <?php
            
            }
        }
    ?>
        
    </div>
<?php include('/includes/js.php'); ?>
<script>
    $(document).ready(function(e){
        $('.delete').click(function(e){
            e.preventDefault();
            $.ajax({
                type: 'get',
                url: $('.delete').attr('href'),
                success: function(e){
                    if(e['success']){
                        window.location = "dashboard.php";
                    } else if(!e['success']){
                        alert('Something went wrong');
                    }
                }
            });
        });
    });
</script>
</body>
</html>