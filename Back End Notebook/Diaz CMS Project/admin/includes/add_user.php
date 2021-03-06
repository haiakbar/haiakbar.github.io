<?php
if(isset($_POST['create_user'])){
    $username = $_POST['username'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $user_email = $_POST['user_email'];
    $user_password = password_hash($_POST['user_password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO users(username, user_firstname, user_lastname, user_role, user_email, 
    user_password)";
    $query .= "VALUES('{$username}', '{$user_firstname}', '{$user_lastname}', '{$user_role}', 
    '{$user_email}', '{$user_password}')";

    $create_user_query = mysqli_query($connection, $query);
    confirm($create_user_query);
    header("Location: users.php");
}

?>
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="text" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="user_role">Role</label><br>
        <select name="user_role" id="user_role">
            <option value="subscriber" selected>Subscriber</option>
            <option value="admin">Admin</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_tags">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Create User">
    </div>
</form>