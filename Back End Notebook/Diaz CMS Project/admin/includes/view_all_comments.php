<form action="" method="post">
<div id="bulkOptionContainer" class="col-xs-4" style="padding: 0px;">
<select name="bulk_options" id="" class="form-control">
<option value="">Select Options</option>
<option value="approved">approved</option>
<option value="pending">pending</option>
<option value="delete">Delete</option>
</select>
</div>

<?php 
if(isset($_POST['checkBoxArray'])){
    foreach($_POST['checkBoxArray'] as $commentValueId){
        $bulk_options = $_POST['bulk_options'];
    switch($bulk_options){
        case 'approved':
        $query = "UPDATE comments SET comment_status = '{$bulk_options}' WHERE comment_id = {$commentValueId}";
        $update_to_approved = mysqli_query($connection, $query);
        confirm($update_to_approved);
        break;

        case 'pending':
        $query = "UPDATE comments SET comment_status = '{$bulk_options}' WHERE comment_id = {$commentValueId}";
        $update_to_pending = mysqli_query($connection,$query);
        confirm($update_to_pending);
        break;

        case 'delete':
        $query = "DELETE FROM posts WHERE comment_id = {$commentValueId}";
        $bulk_delete = mysqli_query($connection,$query);
        confirm($bulk_delete);
        break;
    }
    }
}
?>

<div class="col-xs-4">
<input onClick="javascript: return confirm('Are you sure want to apply?');" type="submit" name="submit" class="btn btn-success" value="Apply">
</div>
<table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                    <th><input type="checkbox" id="selectAllBoxes"></th>                       
                    <th>Id</th>
                    <th>Author</th>
                    <th>Content</th>
                    <th>In Response To</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Status</th>                
                    <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
$query = "SELECT * FROM comments";
if(isset($_GET['id'])){
    $specific_post_id = $_GET['id'];
    $query .= " WHERE comment_post_id = '$specific_post_id'";
}
$query .= " ORDER BY comment_id DESC";
$select_all_categories_query = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_all_categories_query)){
$comment_id = $row['comment_id'];
$comment_post_id = $row['comment_post_id'];
$comment_author = $row['comment_author'];
$comment_email = $row['comment_email'];
$comment_content = $row['comment_content'];
$comment_status = $row['comment_status'];
$comment_date = $row['comment_date'];

$title_query = "SELECT * FROM posts WHERE post_id = {$comment_post_id}";
$select_query = mysqli_query($connection, $title_query);
$fetch_post_title = mysqli_fetch_assoc($select_query);
$post_title = $fetch_post_title['post_title'];

echo "<tr>"; ?>
<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]'
value=' <?php echo $comment_id; ?>'></td>
<?php
echo "<td>$comment_id</td>";
echo "<td>$comment_author</td>";
echo "<td>$comment_content</td>";
echo "<td><a href='..\posts.php?p_id={$comment_post_id}'>{$post_title}</a></td>";
echo "<td>$comment_email</td>";
echo "<td>$comment_date</td>";
echo "<td>$comment_status</td>";
echo "<td><a href='comments.php?delete={$comment_id}'>Delete</a>
<br><a href='comments.php?approve={$comment_id}'>Approve</a>
<br><a href='comments.php?reject={$comment_id}'>Reject</a></td>";
echo "</tr>";
}
?>
                    </tbody>
                    </table>
</form>
<?php 
if(isset($_GET['delete'])){
$delete_comment_id = $_GET['delete'];
$query = "DELETE FROM comments WHERE comment_id = {$delete_comment_id}";
$delete_query = mysqli_query($connection, $query);
header("Location: comments.php");
}

if(isset($_GET['approve'])){
    $approved_comment_id = $_GET['approve'];
    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$approved_comment_id}";
    $approve_query = mysqli_query($connection, $query);
    header("Location: comments.php");
}

if(isset($_GET['reject'])){
    $rejected_comment_id = $_GET['reject'];
    $query = "UPDATE comments SET comment_status = 'rejected' WHERE comment_id = {$rejected_comment_id}";
    $approve_query = mysqli_query($connection, $query);
    header("Location: comments.php");
}
?>
