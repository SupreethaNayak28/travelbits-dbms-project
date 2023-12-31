<?php
include('config/db.php');
if(isset($_POST['submit'])){
$username=mysqli_real_escape_string($conn,$_POST['username']);
$email=mysqli_real_escape_string($conn,$_POST['email']);
$mobile=mysqli_real_escape_string($conn,$_POST['mobile']);
$password=mysqli_real_escape_string($conn,sha1($_POST['password']));
$conf_password=mysqli_real_escape_string($conn,sha1($_POST['conf_password']));
$user_role_id=$_POST['user_role_id'];
$getUser=mysqli_query($conn,"SELECT * FROM users WHERE mobile='$mobile'");
if(mysqli_num_rows($getUser)>0){
$message[]='User already exist!';
}else{
if($password != $conf_password){
    $message[]='confirm password not matched!';
}else{
    $sql="INSERT INTO users(username,email,mobile,password,user_role_id) VALUES('$username','$email','$mobile','$password','$user_role_id')";
    mysqli_query($conn,$sql);
    header('location:Login.php');
}
}
}
?>
<?php include('inc/header.php');?>
<!--registration form-->
<div class="container">
    <div class="row justify-content-between">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default" style="margin-top:20px;">
        <div class="panel-heading"><strong>USER REGISTRATION</strong></div>
        <div class="panel-body">
            <form method="post" action="register.php">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required="" placeholder="Username">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required="" placeholder="Email">
                </div>
       <div class="form-group">
    <label>Mobile</label>
    <input type="text" name="mobile" class="form-control" id="mobileInput" required="" placeholder="Mobile">
    <span id="mobileError" style="color: red;"></span>
    </div>
<script>
    document.getElementById('mobileInput').addEventListener('input', function () {
        var mobileInput = this.value;
        var mobileError = document.getElementById('mobileError');

        // Define the Indian mobile number validation pattern
        var mobilePattern = /^[6789]\d{9}$/;

        if (mobilePattern.test(mobileInput)) {
            mobileError.textContent = ''; // No error
        } else {
            mobileError.textContent = 'Invalid Indian mobile number';
        }
    });
</script>
<script>
    function checkPasswordLength() {
        var password = document.getElementById("password").value;
        // Check the minimum length
        if (password.length < 4) {
            document.getElementById("passwordError").innerText = "Password must be at least 4 characters long.";
        } else {
            document.getElementById("passwordError").innerText = "";
        }
    }
</script>
<div class="form-group">
    <label>Password</label>
    <input type="password" id="password" name="password" class="form-control" required="" placeholder="Password" oninput="checkPasswordLength()">
    <span id="passwordError" style="color: red;"></span>
</div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="conf_password" class="form-control" required="" placeholder="Confirm Password">                        
                </div>
                <div class="form-group">
                    <label>User Role</label>
                   <select name="user_role_id" class="form-control">
                    <?php 
                    $getRoles=mysqli_query($conn,"SELECT user_role_id FROM users WHERE user_role_id='1'");
                    if(mysqli_num_rows($getRoles)>0){ ?>
                        <option value="2">Guide</option>
                        <option value="3">Tourist</option>
                    <?php }else{ ?>
                        <option value="1">Admin</option>
                        <option value="2">Guide</option>
                        <option value="3">Tourist</option>
                    <?php }?>
                   </select>
                </div>
                <input type="submit" name="submit" value="Register now" class="btn success-btn" style="width:100%;">
                <p>Already have an account? <a href="Login.php">Login now</a></p>
            </form>
        </div>
        </div>
        </div>
    </div>
</div>
<?php include('inc/footer.php');?>