<?php 
include('config/db.php'); 
session_start();

$tourist_user_id = $_SESSION['tourist_user_id'];

if (!isset($tourist_user_id)) {
    header('location:Login.php');
    exit(); // Always use exit() after header redirection
}

if (isset($_POST['submitTourist'])) {
    $user_id = $_SESSION['tourist_user_id'];
    $tourist_name = $_SESSION['username'];
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $tourist_role_id = $_SESSION['tourist_role_id'];
    $image = $_FILES['s_image']['name'];
    $image_size = $_FILES['s_image']['size'];
    $tmp_name = $_FILES['s_image']['tmp_name'];
    $img_path = 'uploads/tourists/' . $image;
    $doj = date('Y/m/d');

    // Check if the user has already uploaded a profile
    $profile_query = "SELECT * FROM tourist WHERE user_id = '$user_id'";
    $profile_result = mysqli_query($conn, $profile_query);

    if (mysqli_num_rows($profile_result) > 0) {
        // User has already uploaded a profile, update only modified fields
        $updateFields = array();

        if (!empty($age)) {
            $updateFields[] = "age='$age'";
        }
        if (!empty($gender)) {
            $updateFields[] = "gender='$gender'";
        }
        if (!empty($address)) {
            $updateFields[] = "address='$address'";
        }

        if (!empty($updateFields)) {
            $updateFieldsString = implode(', ', $updateFields);
            $updateProfileQuery = "UPDATE tourist SET $updateFieldsString WHERE user_id='$user_id'";
            mysqli_query($conn, $updateProfileQuery);
        }
    } else {
        // User is uploading profile for the first time
        if ($image_size > 2000000) {
            $message[] = 'Image file is too large!';
        } else {
            $touristProfile = "INSERT INTO tourist(user_id, tourist_name, age, gender, user_role_id, address, s_image, doj, guide_id)
                   VALUES('$user_id', '$tourist_name', '$age', '$gender', '$tourist_role_id', '$address', '$img_path', '$doj', 0)";

            mysqli_query($conn, $touristProfile);
            move_uploaded_file($tmp_name, $img_path);
        }
    }

    // Handle image update separately
    if (!empty($_FILES['s_image']['name'])) {
        $new_image = $_FILES['s_image']['name'];
        $new_image_size = $_FILES['s_image']['size'];
        $new_tmp_name = $_FILES['s_image']['tmp_name'];
        $new_img_path = 'uploads/tourists/' . $new_image;

        if ($new_image_size > 2000000) {
            $message[] = 'New image file is too large!';
        } else {
            move_uploaded_file($new_tmp_name, $new_img_path);

            // Update the image path in the database
            $updateImageQuery = "UPDATE tourist SET s_image='$new_img_path' WHERE user_id='$user_id'";
            mysqli_query($conn, $updateImageQuery);
        }
    }

    header('location:tourist_dashboard.php');
    exit(); // Always use exit() after header redirection
}
?>


<?php include('inc/header.php'); ?>

<div class="container">
    <div class="col-md-3">
        <?php include('sidebar/touristsidebar.php'); ?>
    </div>
    <div class="col-md-9">
        <h3>UPLOAD PROFILE</h3>
        <form method="post" action="uploadTourist.php" enctype="multipart/form-data">
            <div class="box">
                <div class="row" style="padding:0px 30px;margin: bottom 10px;">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Age</label>
                            <input type="text" name="age" class="form-control" required="" placeholder="Age">
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Gender</label>
                            <select name="gender" class="form-control">
                                <option>Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row" style="padding:0px 30px;">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Date of update</label>
                            <input type="text" name="doj" id="datepicker" class="form-control" required=""
                                placeholder="Date of update">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" name="address" placeholder="Address"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row" style="padding:0px 40px;">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Upload Image</label>
                            <input type="file" name="s_image" class="form-control;">
                        </div>
                    </div>
                </div>

                <div class="row" style="padding:0px 30px;">
                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="submit" name="submitTourist" value="Upload Profile" class="btn btn-success">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>

<?php include('inc/footer.php'); ?>
