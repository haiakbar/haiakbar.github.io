<?php
$query = "SELECT * FROM categories WHERE cat_id = '{$cat_id}'";
$select_category_query = mysqli_query($connection, $query);
$show_cat = mysqli_fetch_assoc($select_category_query);
$cat_name = $show_cat['cat_name'];
?>

<form action="" method="post">
        <div class="form-group">
            <label for="cat-title">Edit Category</label>

<input value="<?php if(isset($cat_name)){echo "$cat_name";}?>" type="text" class="form-control" name="edit">
               
        </div>
        <div class="form-group">
                <input class="btn btn-primary" type="submit" name="edit_category" value="Edit Category">
        </div>
<?php


update_category();
/*
if(isset($_POST['edit_category'])){ 
    $cat_name = $_POST['edit'];
    $query = "UPDATE categories SET cat_name = '{$cat_name}' WHERE cat_id = {$cat_id}";
    $edit_categories_query = mysqli_query($connection, $query);

    if(!$edit_categories_query){
        die("Query Failed" . mysqli_error($connection));
    }
    header("Location: categories.php"); 
} */
?>
</form>