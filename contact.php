<?php  include "includes/header.php"; ?>
    <!-- Navigation -->   
    <?php  include "includes/navigation.php"; ?>
    <!-- Page Content -->
    <div class="container">
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>

                <?php
                    $msg = "First line of text\nSecond line of text";

                    // use wordwrap() if lines are longer than 70 characters
                    $msg = wordwrap($msg,70);
                    
                    // send email
                    mail("thanhphat19@gmail.com","My subject",$msg);

                    if(isset($_POST['submit']))
                    {
                        $to         = "thanhphat19@gmail.com";
                        $subject    = $_POST['subject'];
                        $body       = $_POST['body'];
                    }
                ?>

                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                        </div>
                        <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter your subject" required>
                        </div>
                         <div class="form-group">
                            <textarea name="body" id="body" cols="50" rows="10" class="form-control" placeholder="Enter your content"></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-success btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
