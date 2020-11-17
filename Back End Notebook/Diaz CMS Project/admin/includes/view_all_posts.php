<?php 
include "modals/delete_modals.php";
?>

<form action="" method="post">
<div id="bulkOptionContainer" class="col-xs-4" style="padding: 0px;">
<select name="bulk_options" id="" class="form-control">
<option value="">Select Options</option>
<option value="published">Published</option>
<option value="draft">Draft</option>
<option value="clone">Clone</option>
<option value="delete">Delete</option>
</select>
<?php 
if(isset($_POST['checkBoxArray'])){
    foreach($_POST['checkBoxArray'] as $postValueId){
        $bulk_options = $_POST['bulk_options'];
    switch($bulk_options){
        case 'published':
        $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
        $update_to_published = mysqli_query($connection, $query);
        confirm($update_to_published);
        break;

        case 'draft':
        $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
        $update_to_draft = mysqli_query($connection,$query);
        confirm($update_to_draft);
        break;

        case 'clone':
        $query = "SELECT * FROM posts WHERE post_id = {$postValueId}";
        $select_post = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($select_post)){
            $post_author = $row['post_author'];
            $post_title = $row['post_title'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_content = $row['post_content'];
        }
        $query2 = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, 
        post_content, post_tags, post_comment_count, post_status)";
        $query2 .= "VALUES({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', 
        '{$post_content}', '{$post_tags}', 0 , '{$post_status}')";
        $clone_post_query = mysqli_query($connection, $query2);
        confirm($clone_post_query);
        break;

        case 'delete':
        $query = "DELETE FROM posts WHERE post_id = {$postValueId}";
        $bulk_delete = mysqli_query($connection,$query);
        confirm($bulk_delete);
        break;
    }
    }
}
?>
</div>
<div class="col-xs-4">
<input onClick="javascript: return confirm('Are you sure want to apply?');" type="submit" name="submit" class="btn btn-success" value="Apply">
<a class="btn btn-primary"href="posts.php?source=add_post">Add New</a></div>
<table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                    <th><input type="checkbox" id="selectAllBoxes"></th>                    
                    <th>Id</th>
                    <th>Author</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Tags</th>
                    <th>Comments</th>
                    <th>Date</th>
                    <th>Views</th>
                    <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

$query = "SELECT posts.post_id, posts.post_author, posts.post_title, posts.post_category_id, posts.post_status, posts.post_image, posts.post_tags, posts.post_date, posts.post_views_count, categories.cat_id, categories.cat_name FROM posts LEFT JOIN categories ON posts.post_category_id = categories.cat_id WHERE posts.post_author = {$_SESSION['user_id']} ORDER BY posts.post_id DESC";
$select_all_categories_query = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_all_categories_query)){
$post_id = $row['post_id'];
$post_author = $row['post_author'];
$post_title = $row['post_title'];
$post_category_id = $row['post_category_id'];
$post_status = $row['post_status'];
$post_image = $row['post_image'];
$post_tags = $row['post_tags'];
$post_date = $row['post_date'];
$post_views = $row['post_views_count'];
$post_category = $row['cat_name'];
$count_comments = mysqli_query($connection, "SELECT * FROM comments WHERE comment_post_id = '$post_id'");
$post_comment_count = mysqli_num_rows($count_comments);

$author_query = "SELECT * FROM users WHERE user_id = '$post_author'";
$select_author = mysqli_query($connection, $author_query);
$row = mysqli_fetch_assoc($select_author);
$post_author = $row['user_firstname'].' '.$row['user_lastname'];




echo "<tr>"; ?>
<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]'
value=' <?php echo $post_id; ?>'></td>
<?php
echo "<td>$post_id</td>";
echo "<td>$post_author</td>";
echo "<td>$post_title</td>";
echo "<td>$post_category</td>";
echo "<td>$post_status</td>";
echo "<td><img width='100px 'src='../images/$post_image'></td>";
echo "<td>$post_tags</td>";
?>
<td><a href="./comments.php?id=<?php echo $post_id; ?>"><?php echo $post_comment_count; ?></a></td>
<?php
echo "<td>$post_date</td>";
echo "<td>$post_views</td>";
echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a>
<br><a href='javascript:void(0)' rel='$post_id' class='delete_link'>Delete</a></td>";
//<a onClick=\"javascript: return confirm('Are you sure want to delete?'); \" href='posts.php?delete={$post_id}'>Delete</a>

echo "</tr>";
}
?>
                    </tbody>
                    </table>
</form>
<?php 
if(isset($_GET['delete'])){
$delete_post_id = $_GET['delete'];
$query = "DELETE FROM posts WHERE post_id = {$delete_post_id}";
$delete_query = mysqli_query($connection, $query);
header("Location: posts.php");
}
?>

<script>
$(document).ready(function(){
    $(".delete_link").on('click', function(){
        var id = $(this).attr("rel");
        var delete_url = "posts.php?delete="+ id + " ";
        $(".modal_delete_link").attr("href", delete_url);
        $("#myModal").modal('show');
    });
});
</script>