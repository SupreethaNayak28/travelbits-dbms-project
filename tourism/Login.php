<?php
include('config/db.php');
session_start();
// Function to generate a new captcha
function generateCaptcha() {
    $captchaChars = str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
    return substr($captchaChars, 0, 6); // Adjust the length as needed
}

if (isset($_POST['submit'])) {
    // Validate the captcha
    if (isset($_POST['userCaptcha']) && isset($_SESSION['captcha'])) {
        $enteredCaptcha = $_POST['userCaptcha'];
        $actualCaptcha = $_SESSION['captcha'];
        if ($enteredCaptcha == $actualCaptcha) {
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $password=mysqli_real_escape_string($conn,sha1($_POST['password']));
    $query="SELECT * FROM users WHERE email='$email' AND password='$password'";
    $getUser=mysqli_query($conn,$query);
    if(mysqli_num_rows($getUser)>0){
        $row=mysqli_fetch_assoc($getUser);
        if($row['user_role_id']=='1'){
            $_SESSION['username']=$row['username'];
            $_SESSION['email']=$row['email'];
            $_SESSION['admin_user_id']=$row['user_id'];
            $_SESSION['admin_role_id']=$row['user_role_id'];
            header('Location:admin_dashboard.php');
            
        }else if($row['user_role_id']=='2'){
            $_SESSION['username']=$row['username'];
            $_SESSION['email']=$row['email'];
            $_SESSION['guide_user_id']=$row['user_id'];
            $_SESSION['guide_role_id']=$row['user_role_id'];
            header('Location:guide_dashboard.php');
        }else if($row['user_role_id']=='3'){
            $_SESSION['username']=$row['username'];
            $_SESSION['email']=$row['email'];
            $_SESSION['tourist_user_id']=$row['user_id'];
            $_SESSION['tourist_role_id']=$row['user_role_id'];
            header('Location:tourist_dashboard.php');
           
        }else{
        $message[]='incorrect email or password!';
    }
}else{
    $message[] = '<span style="color: #ff0000;">Invalid captcha entered!</span>';
}
}
}
}

?>
<?php include('inc/header.php');?>
<div class="container">
   <!--Login Form-->
    <div class="row justify-content-between">
    <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default" style="margin-top:20px;">
        <div class="panel-heading"><strong>USER LOGIN</strong></div>
        <div class="panel-body">
            <form method="post"action="Login.php">
            <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required="" placeholder="Email"> 
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required="" placeholder="Password">
                </div>
                 <!-- Captcha Section -->
                 <div style="margin-top: 10px; display: flex; align-items: center;">
    <?php
        // Generate a new captcha or get the existing one from the session
        $captcha = isset($_SESSION['captcha']) ? $_SESSION['captcha'] : generateCaptcha();
    ?>
    <label style="margin-right: 15px; font-size: 16px; " for="captcha">Captcha:</label>
    <input type="text" id="captcha" name="captcha" class="form-control" style="width: 100px; padding: 5px; font-size: 14px; background-color: #D8E6FF; color: black; margin-right: 10px; border: 2px solid #4A90E2; border-radius: 5px;" required="" placeholder="Enter the characters you see" value="<?php echo $captcha; ?>" readonly>
    <button type="button" onclick="refreshCaptcha()" style="margin-left: 10px; background-color: #4A90E2; color: #fff; border: none; padding: 5px 8px; cursor: pointer; border-radius: 5px;">
        <!-- Use the Font Awesome refresh icon -->
        <i class="fas fa-sync-alt"></i>
    </button>
</div>
<div style="margin-top: 10px; display: flex; justify-content: center; align-items: center;">
    <label for="userCaptcha" style="margin-right: 10px;">Enter Captcha:</label>
    <input type="text" name="userCaptcha" class="form-control" style="width: 212px; padding: 10px; font-size: 16px; background-color: #D8BFD8; color: black; border: 2px solid #800080; border-radius: 8px;" required="" placeholder="Enter the captcha" onpaste="return false;">
</div>

<!-- End Captcha Section -->

                <input type="submit" name="submit" value="Login now" class="btn success-btn" style="width:100%;">
                <p>Don't have an account? <a href="register.php">Register now</a></p>
            </form>
        </div>
    </div>
    </div>
</div>
</div>
<script>
    function refreshCaptcha() {
        // Using AJAX to dynamically update the captcha
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var captchaInput = document.getElementById("captcha");
                captchaInput.value = xhr.responseText;

                // Also clear the user-entered captcha
                document.getElementsByName("userCaptcha")[0].value = "";
            }
        };
        xhr.open("GET", "generateCaptcha.php", true);
        xhr.send();
    }
</script>
<?php include('inc/footer.php');?>