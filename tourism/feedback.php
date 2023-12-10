<?php include('config/db.php');
?>
<?php session_start();?>
<?php
$tourist_user_id=$_SESSION['tourist_user_id'];
if(!isset($tourist_user_id)){
    header('location:Login.php');
}
if(isset($_POST['submitFeedback'])){
    $user_id=$_SESSION['tourist_user_id'];
    $role_id=$_SESSION['tourist_role_id'];
    $user_feedback = $_POST['feedback'];
    $sql_query = "INSERT INTO feedback (feedback, user_id, user_role_id)
                  VALUES ('$user_feedback', '$user_id', '$role_id')";
    if (mysqli_query($conn, $sql_query)) {
        header('location: feedback.php');
        $message[] = 'Feedback submitted successfully!';
    } else {
        header('location: feedback.php');
        $message[] = 'Failed to submit feedback: ' . mysqli_error($conn);
    }
    
    }
?>
<?php include('inc/header.php');?>
<div class="container">
<div class="col-md-3">
    <?php include('sidebar/touristsidebar.php');?>
    </div>
    <div class="col-md-9">
        <h3>FEEDBACK</h3>
        <form method="post" action="feedback.php">
            <div class="box">
                <div class="row" style="padding: 0px 30px;margin-bottom:10px;">
                 <div class="col-md-5">
                    <div class="form-group">
                        <textarea class="form-control" name="feedback" rows="5" cols="40" placeholder="Feedback"></textarea>
                    </div>
                 </div>
            </div>

            <div class="row" style="padding: 0px 30px;">
          <div class="col-md-5">
            <input type="submit" name="submitFeedback" value="Submit" class="btn btn-success">
          </div>    
        
        </div>
            </div>
        </form>
    </div>
</div>
<?php include('inc/footer.php');?>