<?php include('config/db.php');
?>
<?php session_start();?>
<?php
$admin_user_id=$_SESSION['admin_user_id'];
if(!isset($admin_user_id)){
    header('location:Login.php');
}
?>
<?php include('inc/header.php');?>
<div class="container">
    <div class="col-md-3">
    <?php include('sidebar/adminsidebar.php');?>
    </div>
    <div class="col-md-9">
    <h2>Guides</h2>
    <table class="table table-dark">
        <thead>
        <tr>
            <th scope="col" style="width:10%;">Image</th>
            <th scope="col" style="width:25%;">Guide Name</th>
            <th scope="col" style="width:10%;">Age</th>
            <th scope="col" style="width:10%;">Gender</th>
            <th scope="col" style="width:10%;">Experience</th>
            <th scope="col" style="width:30%;">Address</th>
        </tr>
        </thead>
        <tbody>
    <?php 
    $sql="SELECT * FROM guide";
    $guides=mysqli_query($conn,$sql);

    if(mysqli_num_rows($guides)>0){
        while($row=mysqli_fetch_assoc($guides)){ 
    ?>
        <tr>
            <td style="width:10%;" class="image">
                <?php
                if($row['i_image']==null){
                ?>
                    <p style="text-align: center;border-radius: 50%;">
                        <img src="assets/img/2.webp" style="width:50%;">
                    </p>
                <?php
                }
                else{
                ?>
                    <p style="text-align: center;border-radius: 50%;">
                        <img src=<?php echo $row['i_image'];?> style="width:50%;border-radius: 50%;">
                    </p>
                <?php          
                }
                ?>
            </td>
            <td style="width: 25%;font-size:14px;"><?php echo $row['guide_name'];?></td>  
            <td style="width: 10%;font-size:14px;"><?php echo $row['age'];?></td>  
            <td style="width: 10%;font-size:14px;"><?php echo $row['gender'];?></td> 
            <td style="width: 10%;font-size:14px;"><?php echo $row['experience'];?></td> 
            <td style="width: 30%;font-size:14px;"><?php echo $row['address'];?></td>   
        </tr>
    <?php
        } 
    }
    else{
    ?>
        <tr>
            <td colspan="50px">No guides registered yet!</td>
        </tr>
    <?php
    }
    ?>
</tbody>
    </table>
    </div>
</div>
<script>
    $('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
    </script>
<?php include('inc/footer.php');?>