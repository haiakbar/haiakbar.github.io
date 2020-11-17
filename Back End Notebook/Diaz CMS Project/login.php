<?php
include "includes/db.php";
include "includes/header.php"; 


checkIfUserIsLoggedInAndRedirect('/cms/admin');
if(ifItIsMethod('post')){
    if(isset($_POST['username'])&&isset($_POST['password'])){
        login_user($_POST['username'], $_POST['password']);
    } else {
        redirect('/cms/login.php');
    }
} 
/*
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

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
        header("Location: admin");
    } else{
        header("Location: index.php");
    }

} else{
    header("Location: index.php");
}

}
*/


?>

<!-- Navigation -->

<?php  include "includes/navigation.php"; ?>


<!-- Page Content -->
<div class="container">

	<div class="form-gap"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="text-center">


							<h3><i class="fa fa-user fa-4x"></i></h3>
							<h2 class="text-center">Login</h2>
							<div class="panel-body">


								<form id="login-form" role="form" autocomplete="off" class="form" method="post">

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span>

											<input name="username" type="text" class="form-control" placeholder="Enter Username">
										</div>
									</div>

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
											<input name="password" type="password" class="form-control" placeholder="Enter Password">
										</div>
									</div>

									<div class="form-group">

										<input name="login" class="btn btn-lg btn-primary btn-block" value="Login" type="submit">
									</div>


								</form>

							</div><!-- Body-->

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<hr>

	<?php include "includes/footer.php";?>

</div> <!-- /.container -->