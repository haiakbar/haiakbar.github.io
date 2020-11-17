<?php

function imagePlaceholder($image=''){
    if(!$image){
        return "image_1.jpg";
    }
}

function redirect($location){
    header("Location: ".$location);
    exit;
}

function ifItIsMethod($method=null){
    if($_SERVER['REQUEST_METHOD']==strtoupper($method)){
        return true;
    } 
    return false;
}

function isLoggedIn(){
    if(isset($_SESSION['user_role'])){
        return true;
    }
    return false;
}

function checkIfUserIsLoggedInAndRedirect($redirectLocation=null){
    if(isLoggedIn()){
        redirect($redirectLocation);
    }
}

function escape($string){
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));
}

function confirm($result){
    global $connection;
    if(!$result){
        die("QUERY FAILED". mysqli_error($connection));
    }

    
}

function users_online(){
    global $connection;
    if(isset($_GET['onlineusers'])){
       
        if(!$connection){
            session_start();
            include "db.php";
    
$session = session_id();
$time = time();
$time_out_in_seconds = 60;
$time_out = $time - $time_out_in_seconds;

$query = "SELECT * FROM users_online WHERE session = '$session'";
$send_query = mysqli_query($connection, $query);
$count = mysqli_num_rows($send_query);

if($count == NULL){
    mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session', '$time')");
} else {
    mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
}

$users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");

echo $result = mysqli_num_rows($users_online_query);


    }
}
} //GET REQUEST ISSET END


users_online();
function create_category(){
    if(isset($_POST['submit'])) {
        global $connection;
        $cat_name = $_POST['cat_name'];
    
        if($cat_name == "" || empty($cat_name)) {
            echo "This field should not be empty";
        } else {
            $query = "INSERT INTO categories(cat_name)";
            $query .= "VALUE ('$cat_name')";
    
            $create_category_query = mysqli_query($connection, $query);
    
            if(!$create_category_query){
                die('QUERY FAILED' . mysqli_error($connection));
            }
        }
    }
}

function view_all_categories(){
    global $connection;
    $query = "SELECT * FROM categories";
    $select_all_categories_query = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_all_categories_query)){
    $cat_id = $row['cat_id'];
    $cat_name = $row['cat_name'];
    echo "<tr>";
    echo "<td>{$cat_id}</td>";
    echo "<td>{$cat_name}</td>";
    echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a><br><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
    echo "</tr>";
    }
}

function delete_category(){
    if(isset($_GET['delete'])){
        global $connection;
        $delete_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$delete_cat_id}";
        $delete_query = mysqli_query($connection, $query);
        header("Location: categories.php");
        }
}

function insert_categories(){
    global $connection;
    if(isset($_POST['submit'])){
        $cat_name = $_POST['cat_name'];

        if($cat_name == "" || empty($cat_name)){
            echo "This Field should not be empty";
        } else {
            $stmt = mysqli_prepare($connection, "INSERT INTO categories(cat_name) VALUES(?)");

            mysqli_stmt_bind_param($stmt, 's', $cat_name);

            mysqli_stmt_execute($stmt);

            confirm($stmt);
            mysqli_stmt_close($stmt);
        }
    }
}

function update_category(){
    global $connection;
    global $cat_id;
    if(isset($_POST['edit_category'])){
        $cat_name = $_POST['edit'];

        if($cat_name == ""||empty($cat_name)){
            echo "This field should not be empty";
        } else {
            $stmt = mysqli_prepare($connection, "UPDATE categories SET cat_name = ? WHERE cat_id = ?");

            mysqli_stmt_bind_param($stmt, 'si', $cat_name, $cat_id);
            echo $cat_name;
            echo $cat_id;
            mysqli_stmt_execute($stmt);
            confirm($stmt);
            mysqli_stmt_close($stmt);
            redirect('categories.php');
        }
    }
}

function showStats($parameter){
    global $connection;
    $query = "SELECT * FROM ".$parameter;
    $counter = mysqli_query($connection, $query);
    return mysqli_num_rows($counter);
}

function specStats($table, $col, $val){
    global $connection;

    $query = "SELECT * FROM $table WHERE $col = '$val'";
    $counter = mysqli_query($connection, $query);
    return mysqli_num_rows($counter);
}

function is_admin($username=''){
    global $connection;

    $query = "SELECT user_role FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($result);

    if($row['user_role']=='admin'){
        return True;
    } else {
        return False;
    }
}

function username_exists($username){
    global $connection;
    $query = "SELECT username FROM users WHERE username='$username'";
    $result = mysqli_query($connection, $query);

    if(mysqli_num_rows($result)>0){
        return True;
    } else{
        return False;
    }
}

function email_exists($email){
    global $connection;
    $query = "SELECT user_email FROM users WHERE user_email = '$email'";
    $result = mysqli_query($connection, $query);

    if(mysqli_num_rows($result)>0){
        return True;
    } else {
        return False;
    }
}

function register_user($username, $first_name, $last_name, $email, $password){
    global $connection;



    $username = mysqli_real_escape_string($connection, $username);
    $first_name = mysqli_real_escape_string($connection, $first_name);
    $last_name = mysqli_real_escape_string($connection, $last_name);
    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);

    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users(username, user_firstname, user_lastname, user_role, user_email, 
        user_password)";
    $query .= "VALUES('{$username}', '{$first_name}', '{$last_name}', 'subscriber', 
        '{$email}', '{$password}')";
    
    $create_user_query = mysqli_query($connection, $query);
    

}

function login_user($username, $password){
    global $connection;

    $username = escape($username);
    $password = escape($password);

    $query = "SELECT * FROM users WHERE username = '{$username}'";
    $verify_user = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($verify_user);
    
    if(password_verify($password, $user['user_password'])){
    
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['user_firstname'] = $user['user_firstname'];
    $_SESSION['user_lastname'] = $user['user_lastname'];
    $_SESSION['user_role'] = $user['user_role'];
    
        if($_SESSION['user_role'] == 'admin'){
            redirect('admin');
        } else{
            redirect('index.php');
        }
    
    } else{
        redirect('index.php');
    }
}

function query($someQuery){
    global $connection;
    return mysqli_query($connection, $someQuery);

}

function isLikedPost($post_id, $user_id){
    $result = query("SELECT * FROM likes WHERE post_id = $post_id AND user_id = $user_id");
    return mysqli_num_rows($result)>= 1 ? True : False;
    // if($isLiked = mysqli_query($connection, "SELECT * FROM likes WHERE post_id = $post_id AND user_id = $user_id")){
    // $liked = mysqli_fetch_assoc($isLiked);
    // if(mysqli_num_rows($liked)==1){
    //     return True;
    // }} else{
    // return False;}
}
?>


