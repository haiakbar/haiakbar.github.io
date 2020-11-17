  <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" role="form" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="comment_author">Name</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>
                        <div class="form-group">
                            <label for="comment_email">Email</label>
                            <input type="text" class="form-control" name="comment_email">
                        </div>
                        <div class="form-group">
                            <label for="comment_content">Comment</label>
                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>

<?php
if(isset($_POST['create_comment'])){
    $comment_author = $_POST['comment_author'];
    $comment_email = $_POST['comment_email'];
    $comment_content = $_POST['comment_content'];
    $comment_post_id = $_GET['p_id'];
    $comment_date = date('d-m-y');
if(!empty($comment_author)& !empty($comment_email)& !empty($comment_content)){
    $query = "INSERT INTO comments(comment_author, comment_email, comment_content, comment_post_id, comment_date, comment_status)";
    $query .= "VALUES('{$comment_author}', '{$comment_email}', '{$comment_content}', '$comment_post_id', now(), 'pending')";

    $create_comment_query = mysqli_query($connection, $query);
    confirm($create_comment_query);
    header ("Location: post.php?p_id={$comment_post_id}");
} else{
    echo "<script>alert('Please fill all the form!')</script>";
}

}
?>

                <hr>

                <!-- Posted Comments -->
<?php 
$get_post_id = $_GET['p_id'];
$query = "SELECT * FROM comments WHERE comment_post_id = '{$get_post_id}'";
$query .= "AND comment_status = 'approved'";
$query .= "ORDER BY comment_id DESC";
$select_comment_id = mysqli_query($connection, $query);
while($row = mysqli_fetch_assoc($select_comment_id)){

$comment_author = $row['comment_author'];
$comment_content = $row['comment_content'];
$comment_date = $row['comment_date'];
?>
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>
<?php } ?>
                


