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
                    use PHPMailer\PHPMailer\PHPMailer;
                    use PHPMailer\PHPMailer\Exception;

                    if(isset($_POST['submit']))
                    {
                        $to         = "PhatNNTGCS17275@fpt.edu.vn";
                        $subject    = $_POST['subject'];
                        $body       = $_POST['body'];
                        $email      = $_POST['email'];

                        require_once('includes/PHPMailer/src/PHPMailer.php');
                        require_once('includes/PHPMailer/src/Exception.php');
                        require_once('includes/PHPMailer/src/SMTP.php');

                        $mail = new PHPMailer();
                        $mail ->isSMTP();
                        $mail ->SMTPAuth = true;
                        $mail ->SMTPSecure = 'ssl';
                        $mail ->Host = 'smtp.gmail.com';
                        $mail ->Port = '465';
                        $mail ->isHTML();
                        $mail ->Username = 'thanhphat19@gmail.com';
                        $mail ->Password = 'Thanhphat0937994252';
                        $mail ->SetFrom($email);
                        $mail ->AddReplyTo($email);
                        $mail ->Subject = $subject;
                        $mail ->Body = $body;
                        $mail ->AddAddress($to);

                        $mail ->Send();

                        if($mail->Send())
                        {
                            echo "<p class='bg-success'>Send mail successful</p>";
                        }
                        else {
                            echo "<p class='bg-danger'>Send mail failed</p>";
                        }
                    }
                ?>

                    <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
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
<!-- Footer -->
<?php include "includes/footer.php";?>
