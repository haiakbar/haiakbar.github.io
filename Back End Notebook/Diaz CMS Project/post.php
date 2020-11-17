<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

    <!-- Navigation -->

<?php include "includes/navigation.php"; ?>

<?php 
if(isset($_POST['liked'])){
    $user_id = $_POST['user_id'];
    $post_id = $_POST['post_id'];

    mysqli_query($connection, "UPDATE posts SET post_likes = post_likes + 1 WHERE post_id = $post_id");

    mysqli_query($connection, "INSERT INTO likes (user_id, post_id) VALUES ($user_id, $post_id)");
    header("Refresh: 0");
}

if(isset($_POST['unliked'])){
    $user_id = $_POST['user_id'];
    $post_id = $_POST['post_id'];

    mysqli_query($connection, "UPDATE posts SET post_likes = post_likes - 1 WHERE post_id = $post_id");

    mysqli_query($connection, "DELETE FROM likes WHERE post_id = $post_id AND user_id = $user_id");
    header("Refresh: 0");
}
?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

            <?php 
            if(isset($_GET['p_id'])){

            

                $get_post_id = $_GET['p_id'];
                $query = "SELECT * FROM posts WHERE post_id = '{$get_post_id}'";
                $select_category_id = mysqli_query($connection, $query);
                $row = mysqli_fetch_array($select_category_id);
                $post_author = $row['post_author'];
                $post_title = $row['post_title'];
                $post_category_id = $row['post_category_id'];
                $post_status = $row['post_status'];
                $post_content = $row['post_content'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_date = $row['post_date'];
                $post_likes = $row['post_likes'];

                $query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = {$get_post_id}";
                $update_views = mysqli_query($connection, $query);

                $author_query = "SELECT * FROM users WHERE user_id = '$post_author'";
                $select_author = mysqli_query($connection, $author_query);
                $raw = mysqli_fetch_assoc($select_author);
                $post_author = $raw['user_firstname'].' '.$raw['user_lastname'];

                if(!$update_views){
                    die('VIEWS QUERY FAILED');
                }
            }
            ?>                       

                <!-- <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1> -->

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $_GET['p_id']; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo imagePlaceholder($post_image); ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                
                <hr>
                <div class="row">
                <?php 
                if(isLoggedIn()){
                    if(isLikedPost($get_post_id,$_SESSION['user_id'])){
                        echo '<p class="pull-right"><a class="unlike" href="#"><span class="glyphicon glyph-thumbs-up"></span> Unlike</a></p>';
                    } else {
                        echo '<p class="pull-right"><a class="like" href="#"><span class="glyphicon glyph-thumbs-up"></span> Like</a></p>';
                    }
                
                } else{
                    echo '<p class="pull-right">You should login to like</p>';
                }
                ?>
                </div>
                
                <div class="row">
                <p class="pull-right">Likes: <?php echo $post_likes; ?></p></div>
            
            
            
  <!-- Comments Form -->
  <?php include "comments.php"; ?>
           
            <!-- Blog Sidebar Widgets Column -->
            
            </div>
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
<?php include "includes/footer.php"; ?>

<script>
$(document).ready(function(){
    var post_id = <?php echo $get_post_id; ?>;
    var user_id = <?php echo $_SESSION['user_id']; ?>;

    $('.like').click(function(){
        $.ajax({
            url:"/cms/post.php?p_id=<?php echo $get_post_id; ?>",
            type: "post",
            data: {
                'liked': 1,
                'post_id': post_id,
                'user_id': user_id
            }
        })
    });

    $('.unlike').click(function(){
        $.ajax({
            url:"/cms/post.php?p_id=<?php echo $get_post_id; ?>",
            type: "post",
            data: {
                'unliked': 1,
                'post_id': post_id,
                'user_id': user_id
            }
        })
    });
});
</script>