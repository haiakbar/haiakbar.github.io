<?php

if(isset($_GET['p_id'])){

$get_post_id = $_GET['p_id'];
$query = "SELECT * FROM posts WHERE post_id = '{$get_post_id}'";
$select_category_id = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($select_category_id);
$post_author = $row['post_author'];
$post_title = $row['post_title'];
$post_category_id = $row['post_category_id'];
$post_status = $row['post_status'];
$post_content = $row['post_content'];
$post_image = $row['post_image'];
$post_tags = $row['post_tags'];
$post_comment_count = $row['post_comment_count'];
$post_date = $row['post_date'];

} 

if(isset($_POST['edit_post'])){
    $post_title = $_POST['title'];
    $post_author = $_POST['post_author'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');

    move_uploaded_file($post_image_temp, "../images/$post_image");
    
    if(empty($post_image)){
    
        $query = "SELECT * FROM posts WHERE post_id = $get_post_id";
        $select_image = mysqli_query($connection, $query);

        while($row = mysqli_fetch_array($select_image)){
            $post_image = $row['post_image'];
        }
    }

    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$post_title}',";
    $query .= "post_category_id = '{$post_category_id}',";
    $query .= "post_author = '{$post_author}',";
    $query .= "post_date = now(),";
    $query .= "post_image = '{$post_image}',";
    $query .= "post_content = '{$post_content}',";
    $query .= "post_tags = '{$post_tags}',";
    $query .= "post_status = '{$post_status}' ";
    $query .= "WHERE post_id = {$get_post_id}";

    $edit_post_query = mysqli_query($connection, $query);
    confirm($edit_post_query);
    header("Location: posts.php");
}
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
    <label for="title">Post Title</label>
    <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label for="post_category_id">Post Category</label><br>
        <select name="post_category_id" id="post_category_id">

<?php 
$query = "SELECT * FROM categories";
$select_category = mysqli_query($connection, $query);
while($show_cat = mysqli_fetch_assoc($select_category)){
$cat_name = $show_cat['cat_name'];
$cat_id = $show_cat['cat_id'];
if($cat_id==$post_category_id){
    $selected = "selected";
} else{
    $selected = "";
}
echo "<option {$selected} value='{$cat_id}'>{$cat_name}</option>";
}
?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label><br>
        <select name="post_author" id="post_author">
        <option disabled selected value="none"> -- select an option -- </option>
<?php 
$query = "SELECT * FROM users";
$fetch_users = mysqli_query($connection, $query);
while($row = mysqli_fetch_assoc($fetch_users)){
    $user_fullname = $row['user_firstname']. " " . $row['user_lastname'];
    $user_id = $row['user_id'];
    if($user_id == $post_author){
        echo "<option selected value='{$user_id}'>{$user_fullname}</option>";
    } else {
        echo "<option value='{$user_id}'>{$user_fullname}</option>";
    }
}
?>
    </select>
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label><br>
        <select name="post_status" id="post_status">
            <option <?php if($post_status == 'draft'){echo "selected";}?> value='draft'>Draft</option>
            <option <?php if($post_status == 'published'){echo "selected";}?> value='published'>Published</option>
        </select>
    </div>

    <div class="form-group">
        <label for="image">Images</label><br>
        <img width="400px" src="../images/<?php echo $post_image ?>" alt="">
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags; ?>"  type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="body" cols="30" rows="10"><?php echo $post_content; ?></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_post" value="Edit Post">
    </div>
</form>