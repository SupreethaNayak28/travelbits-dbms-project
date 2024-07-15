<?php
include('config/db.php');
?>
<?php session_start();?>
<?php
   $admin_user_id=$_SESSION['admin_user_id'];
   if(!isset($admin_user_id)){
    header('location:Login.php');
   }
   if(isset($_POST['hotels'])){
    $hotel_name=mysqli_real_escape_string($conn,$_POST['hotel_name']);
    $tag_name=mysqli_real_escape_string($conn,$_POST['tag_name']);
    $image=$_FILES['hotel_image']['name'];
    $image_size=$_FILES['hotel_image']['size'];
    $tmp_name=$_FILES['hotel_image']['tmp_name'];
    $img_path='uploads/hotels/'.$image;
    if(!empty($image)){
        if($image_size > 2000000){
           $message[]='image file size is too large';
        }else{
           $insertHotel="INSERT INTO tbl_tourist_hotels(hotel_name,tag_name,hotel_image) VALUES('$hotel_name','$tag_name','$img_path')";
           mysqli_query($conn,$insertHotel);
           move_uploaded_file($tmp_name,$img_path);
           header('location:hotels.php');
        }
    }

}
if(isset($_POST['updHotels'])){
    $hotel_id= mysqli_real_escape_string($conn, $_POST['hotel_id']);
    $hotel_name= mysqli_real_escape_string($conn, $_POST['hotel_name']);
    $tag_name= mysqli_real_escape_string($conn, $_POST['tag_name']);
    $image=$_FILES['hotel_image']['name'];
    $image_size=$_FILES['hotel_image']['size'];
    $tmp_name=$_FILES['hotel_image']['tmp_name'];
    $img_path='uploads/hotels/'.$image;
    if(!empty($image)){
        if($image_size > 2000000){
           $message[]='image file size is too large';
        }else{
            $updateCategory="UPDATE tbl_tourist_hotels SET hotel_name='$hotel_name', tag_name='$tag_name', hotel_image='$img_path' WHERE hotel_id='$hotel_id'";
            mysqli_query($conn,$updateCategory);
            move_uploaded_file($tmp_name,$img_path);
            header('location:hotels.php');
        }
    }
}
?>
<?php include('inc/header.php');?>

<div class="container">
    <div class="col-md-3">
        <?php include('sidebar/adminsidebar.php');?>
    </div>
    <div class="col-md-9">
        <div class="row" style="margin-left: 1px;margin-top: 18px;">
             <a href="" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">Add Category</a>
    </div>
    

    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Hotel Name</th>
                <th scope="col">Tag</th>
                <th scope="col">Image</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

            <?php 
            $sql="SELECT * FROM tbl_tourist_hotels";
            $getCategories = mysqli_query($conn,$sql);
            if(mysqli_num_rows($getCategories) > 0){
               while($row=mysqli_fetch_assoc($getCategories)){
                ?>
                <tr>
                    <td style="width: 5%;font-size: 14px;"><?php echo $row['hotel_id'];?></td>
                    <td style="width: 35%;font-size: 14px;"><?php echo $row['hotel_name'];?></td>
                    <td style="width: 10%;font-size: 14px;"><?php echo $row['tag_name'];?></td>
                    <td style="width: 20%;font-size: 14px;" class="image">
                       <img src=<?php echo $row['hotel_image'];?> style="width: 30%;" alt="Hotel">
                    </td>
                    <td style="width: 25%;" class="actions">
                      <a href="" class="btn-sm btn-primary editCategory" data-val=<?php echo $row['hotel_id'];?> data-toggle="modal" data-target="#editCategory"><i class="fa fa-edit"></i>Edit</a>
                      <a href="" class="btn-sm btn-danger deleteCategory" data-val=<?php echo $row['hotel_id'];?> data-toggle="modal" data-target="#deleteCategory"><i class="fa fa-trash"></i>Delete</a>
                </td>
                </tr>
                <?php
               }
            }
            else{
                ?>
                <tr>
                    <td>No categories added yet!</td>
                </tr>
                <?php
            }
        ?>
               </tbody>
            </table>
        </div>
         
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Hotel Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
        </div>
        <div class="modal-body">
        <form method="post" action="hotels.php" enctype="multipart/form-data">
        <div class="modal-body">
        <div class="form-group">
        <label>Hotel</label>
        <input type="text" name="hotel_name" class="form-control" required="" placeholder="Hotel">
        </div>
        <div class="form-group">
        <label>Tag Name</label>
        <input type="text" name="tag_name" id="tag_name" class="form-control" required="" placeholder="Tag name">
    
        </div>
        <div class="form-group">
        <label>Upload Image</label>
        <input type="file" name="hotel_image" accept="image/jpg, image/jpeg, image/png" required="" class="form-control">
        </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload();">Close</button>
                            <input type="submit" name="hotels" value="Save Changes" class="btn btn-primary">
        </div>
        </form>
        </div>
        </div>
        </div>
        </div>

        <div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Hotels</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="window.location.reload();">
                       <span aria-hidden="true">&times;</span>
                     </button>
                </div>
                <div class="modal-body">
                <form method="post" action="hotels.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="hotel_id" id="hotel_id">
                    <div class="form-group">
                            <label>Hotel</label>
                            <input type="text" name="hotel_name" id="hotel_name" value="" class="form-control" required="" placeholder="Hotel">
                    </div>
                    <div class="form-group">
                            <label>Tag Name</label>
                            <input type="text" name="tag_name"  value="" class="form-control tag_name" required="" placeholder="Tag Name">
                    </div>
                    <div class="form-group">
                        <div id="hotel_image"></div>
                        <label>Upload Image</div>
                        <input type="file" name="hotel_image" accept="image/jpg, image/jpeg, image/png" required="" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload();">Close</button>
                        <input type="submit" name="updHotels" value="Update Changes" class="btn btn-primary">
                 </div>
                </form>
                </div>
            </div>
         </div>
        </div>



    </div>
<?php include('inc/footer.php');?>

<script type="text/javascript">
    $('.editCategory').click(function(){
        var id= $(this).attr('data-val');
        $.ajax({
            url: "updHotels.php",
            type: "POST",
            data: {
                type: 1,
                id: id,
            },
            cache: false,
            success: function(data){
                var jsonData= $.parseJSON(data);
                $('#hotel_id').val(jsonData.hotel_id);
                $('#hotel_name').val(jsonData.hotel_name);
                $('.tag_name').val(jsonData.tag_name);
                $('#hotel_image').append('<img src="'+jsonData.hotel_image+'">');

            }
        });
    })

    $('.deleteCategory').click(function(){
        var id= $(this).attr('data-val');
        $.ajax({
            url: "deleteHotel.php",
            type: "POST",
            data: {
                type: 1,
                id: id,
            },
            cache: false,
            success: function(data){
                alert(data);
            }
        });
    })
</script>