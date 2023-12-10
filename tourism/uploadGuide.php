<?php include('config/db.php');?>
<?php session_start();?>
<?php
$guide_user_id = $_SESSION['guide_user_id'];

if(!isset($guide_user_id)) {
    header('location:Login.php');
}

if(isset($_POST['submitProfile'])) {
    $guide_name = $_SESSION['username'];
    $user_id = $_SESSION['guide_user_id'];
    $guide_role_id = $_SESSION['guide_role_id'];
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $experience = mysqli_real_escape_string($conn, $_POST['experience']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $doj = date('Y/m/d');

    // Check if the user has already uploaded a profile
    $profile_query = "SELECT * FROM guide WHERE user_id = '$user_id'";
    $profile_result = mysqli_query($conn, $profile_query);

    if(mysqli_num_rows($profile_result) > 0) {
        // User has already uploaded a profile, update only modified fields
        $updateFields = array();

        if(!empty($age)) {
            $updateFields[] = "age='$age'";
        }
        if(!empty($gender)) {
            $updateFields[] = "gender='$gender'";
        }
        if(!empty($experience)) {
            $updateFields[] = "experience='$experience'";
        }
        if(!empty($address)) {
            $updateFields[] = "address='$address'";
        }

        if(!empty($updateFields)) {
            $updateFieldsString = implode(', ', $updateFields);
            $updateProfileQuery = "UPDATE guide SET $updateFieldsString WHERE user_id='$user_id'";
            mysqli_query($conn, $updateProfileQuery);
        }
    } else {
        // User is uploading profile for the first time
        $image = $_FILES['i_image']['name'];
        $image_size = $_FILES['i_image']['size'];
        $tmp_name = $_FILES['i_image']['tmp_name'];
        $img_path = 'uploads/guides/' . $image;

        if($image_size > 2000000) {
            $message[] = 'Image file is too large!';
        } else {
            $guideProfile = "INSERT INTO guide(user_id, guide_name, age, gender, user_role_id, experience, address, i_image, date_of_job)
            VALUES('$user_id', '$guide_name', '$age', '$gender', '$guide_role_id', '$experience', '$address', '$img_path', '$doj')";

            mysqli_query($conn, $guideProfile);
            move_uploaded_file($tmp_name, $img_path);
        }
    }

    // Handle image update separately
    if (!empty($_FILES['i_image']['name'])) {
        $new_image = $_FILES['i_image']['name'];
        $new_image_size = $_FILES['i_image']['size'];
        $new_tmp_name = $_FILES['i_image']['tmp_name'];
        $new_img_path = 'uploads/guides/' . $new_image;

        if ($new_image_size > 2000000) {
            $message[] = 'New image file is too large!';
        } else {
            move_uploaded_file($new_tmp_name, $new_img_path);

            // Update the image path in the database
            $updateImageQuery = "UPDATE guide SET i_image='$new_img_path' WHERE user_id='$user_id'";
            mysqli_query($conn, $updateImageQuery);
        }
    }

    header('location:guide_dashboard.php');
}
?>
<?php include('inc/header.php');?>


<div class="container">
    <div class="col-md-3">
        <?php include('sidebar/guidesidebar.php');?>
    </div>
    <div class="col-md-9">
        <h3>DASHBOARD</h3>
        <form method="post" action="uploadGuide.php" enctype="multipart/form-data">
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
                            <label>Experience</label>
                            <input type="text" name="experience" class="form-control" required="" placeholder="Experience">
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="form-group">
                            <label>Address</label>
                           <textarea class="form-control" name="address" placeholder="Address"></textarea>
                        </div>
                      </div>
            </div>
            <div class="row" style="padding:0px 30px;">
            <div class="col-md-5">
                        <div class="form-group">
                            <label>Date of Joining</label>
                            <input type="text" name="doj" id="datepicker" class="form-control" required=""
                            placeholder="Date of join">
                        </div>
            </div>
            <div class="col-md-5">
                        <div class="form-group">
                            <label>Upload Image</label>
                            <input type="file" name="i_image" class="form-control">
                        </div>
            </div>
            </div>
            <div class="row" style="padding:0px 30px;">
            <div class="col-md-5">
                        <div class="form-group">
                            <input type="submit" name="submitProfile" value="Upload Profile" class="btn btn-success">
                        </div>
            </div>
            </div>
            </div>
            
        </form>
    </div>
</div>
<?php include('inc/footer.php');?>