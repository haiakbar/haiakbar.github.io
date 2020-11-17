<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>

<?php

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$options = array(
  'cluster' => 'ap1',
  'useTLS' => true
);
$pusher = new Pusher\Pusher(
  getenv('APP_KEY'),
  getenv('APP_SECRET'),
  getenv('APP_ID'),
  $options
);



if($_SERVER['REQUEST_METHOD']=="POST"){
    $username = trim($_POST['username']);
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $error = [
        'username'=>'',
        'email'=>'',
        'password'=>''
    ];

    if(strlen($username)<4){
        $error['username'] = 'Username needs to be longer';
    }

    if($username == ''){
        $error['username'] = 'Username cannot be empty';
    }

    if(username_exists($username)){
        $error['username'] = 'Username already exists, pick another username';
    }

    if($email==''){
        $error['email'] = 'Email cannot be empty';
    }

    if(email_exists($email)){
        $error['email'] = 'Email already exists';
    }
    
    foreach ($error as $key => $value){
        if(empty($value)){
            unset($error[$key]);
        }
    }

    if(empty($error)){
        register_user($username, $first_name, $last_name, $email, $password);
        $data['message'] = $username;
        $pusher->trigger('my-channel', 'my-event', $data);
    }
}



?>
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>   
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                            <p><?php echo isset($error['username']) ? $error['username'] : ''?></p>
                        </div>
                        <div class="form-group">
                            <label for="first_name" class="sr-only">first name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Adam">
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="sr-only">last name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Smith">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                            <p><?php echo isset($error['email']) ? $error['email'] : ''?></p>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                            <p><?php echo isset($error['password']) ? $error['password'] : ''?></p>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
