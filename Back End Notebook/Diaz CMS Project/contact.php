<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>

<?php
if(isset($_POST['submit'])){

    $from = $_POST['email'];
    $subject = $_POST['subject'];
    $msg = $_POST['msg'];
    $to = 'barstuvwxyz@gmail.com';

    $msg = wordwrap($msg, 75, "\r\n");

    $headers = 'FROM: '. $from;

    mail($to, $subject, $msg, $headers);

}
?>
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>
                
                    <form role="form" action="" method="post" id="contact-form" autocomplete="off">
                        <div class="form-group">
                            <label for="email" >Email</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Enter Your Email">
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter mail subject">
                        </div>
                        
                         <div class="form-group">
                            <label for="message"">Message</label>
                            <textarea name="message" id="message" cols="58" rows="10" placeholder="Enter your message"></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
