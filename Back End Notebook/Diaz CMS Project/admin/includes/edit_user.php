<?php

if(isset($_GET['u_id'])){

$get_user_id = $_GET['u_id'];
$query = "SELECT * FROM users WHERE user_id = '{$get_user_id}'";
$select_user_id = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($select_user_id);
$username = $row['username'];
$user_firstname = $row['user_firstname'];
$user_lastname = $row['user_lastname'];
$user_role = $row['user_role'];
$user_email = $row['user_email'];
} 

if(isset($_POST['edit_user'])){
    $username = $_POST['username'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $user_email = $_POST['user_email'];
    $user_password = password_hash($_POST['user_password'], PASSWORD_DEFAULT);

    $query = "UPDATE users SET ";
    $query .= "username = '{$username}',";
    $query .= "user_firstname = '{$user_firstname}',";
    $query .= "user_lastname = '{$user_lastname}',";
    $query .= "user_role = '{$user_role}',";

if(isset($_POST['user_password'])){
    $query .= "user_password = '{$user_password}',";
}
    $query .= "user_email = '{$user_email}' ";
    $query .= "WHERE user_id = {$get_user_id}";

    $edit_user_query = mysqli_query($connection, $query);
    confirm($edit_user_query);
    header: ("Location: users.php");
}
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="username">Username</label>
        <input value="<?php echo $username; ?>"type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input value="<?php echo $user_firstname; ?>" type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input value="<?php echo $user_lastname; ?>" type="text" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input value="<?php echo $user_email; ?>" type="text" class="form-control" name="user_email">
    </div>



    <div class="form-group">
        <label for="user_role">Role</label><br>
        <select name="user_role" id="user_role">
<?php 
$query = "SELECT * FROM users WHERE user_id = '{$get_user_id}'";
$select_user_role = mysqli_query($connection, $query);
$show_role = mysqli_fetch_assoc($select_user_role);
$role_name = $show_role['user_role'];
if($role_name=="admin"){
    echo "<option selected value='admin'>Admin</option>";
    echo "<option value='subscriber'>Subscriber</option>";
} else{
    echo "<option value='admin'>Admin</option>";
    echo "<option selected value='subscriber'>Subscriber</option>";
}
?>

        </select>
    </div>

    <div class="form-group">
        <label for="post_tags">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Edit User">
    </div>
</form>