<?php
$conn=mysqli_connect('localhost','root','','tours') or die('connection failure');
?>
<?php session_start();?>
<?php
   $admin_user_id= $_SESSION['admin_user_id'];
   if(!isset($admin_user_id)){
          header('location:Login.php');
   }
   if(isset($_POST['addRoom'])){
    $room_name=mysqli_real_escape_string($conn,$_POST['room_name']);
    $hotel_id=mysqli_real_escape_string($conn,$_POST['hotel_id']);
    $price=mysqli_real_escape_string($conn,$_POST['price']);
    $image=$_FILES['room_image']['name'];
    $image_size=$_FILES['room_image']['size'];
    $tmp_name=$_FILES['room_image']['tmp_name'];
    $img_path='uploads/rooms/'.$image;
    if(!empty($image)){
        if($image_size > 2000000){
           $message[]='image file size is too large';
        }else{
           $insertRoom="INSERT INTO tbl_tourist_rooms(room_name,hotel_id,price,room_image) VALUES('$room_name','$hotel_id','$price','$img_path')";
           mysqli_query($conn,$insertRoom);
           move_uploaded_file($tmp_name,$img_path);
           header('location:createRoom.php');
        }
    }
   }

   if(isset($_POST['updateRoom'])){
    $room_id= mysqli_real_escape_string($conn, $_POST['room_id']);
    $room_name= mysqli_real_escape_string($conn, $_POST['room_name']);
    $hotel_id= mysqli_real_escape_string($conn, $_POST['hotel_id']);
    $price= mysqli_real_escape_string($conn, $_POST['price']);
    $image=$_FILES['room_image']['name'];
    $image_size=$_FILES['room_image']['size'];
    $tmp_name=$_FILES['room_image']['tmp_name'];
    $img_path='uploads/rooms/'.$image;
    if(!empty($image)){
        if($image_size > 2000000){
           $message[]='image file size is too large';
        }else{
            $updateRoom="UPDATE tbl_tourist_rooms SET room_name='$room_name', hotel_id='$hotel_id', price='$price', room_image='$img_path' WHERE room_id='$room_id'";
            mysqli_query($conn,$updateRoom);
            move_uploaded_file($tmp_name,$img_path);
            header('location:createRoom.php');
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
             <a href="" class="btn btn-info" data-toggle="modal" data-target="#addRoom">Add Rooms</a>
        </div>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">Room Name</th>
                    <th scope="col">Hotel Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $sql="SELECT * FROM tbl_tourist_rooms JOIN tbl_tourist_hotels ON tbl_tourist_hotels.hotel_id=tbl_tourist_rooms.hotel_id";
                $getRooms=mysqli_query($conn,$sql);
                if(mysqli_num_rows($getRooms)>0){
                    while($row=mysqli_fetch_assoc($getRooms)){
                        ?>
                         <tr>
                            <td style="width: 20%; font-size: 14px;"><?php echo $row['room_name'];?></td>
                            <td style="width: 20%; font-size: 14px;"><?php echo $row['hotel_name'];?></td>
                            <td style="width: 20%; font-size: 14px;"><?php echo $row['price'];?></td>
                            <td style="width: 20%; font-size: 14px;" class="image">
                            <img src=<?php echo $row['room_image'];?> style="width: 30%;" alt="room">
                            </td>
                            <td style="width: 25%;" class="actions">
                            <a href="" class="btn-sm btn-primary editRoom" data-val=<?php echo $row['room_id'];?> data-toggle="modal" data-target="#editRoom"><i class="fa fa-edit"></i>Edit</a>
                            <a href="" class="btn-sm btn-danger deleteRoom" data-val=<?php echo $row['room_id'];?> data-toggle="modal" data-target="#deleteRoom"><i class="fa fa-edit"></i>Delete</a>
                            </td>
                         </tr>
                        <?php
                    }

                }else{
                    ?>
                      <tr>
                        <td>No room added yet!</td>
                      </tr>
                    <?php
                }
                ?>
            </tbody>
        </table> 
        
        <!--modal to add room-->
        <div class="modal fade" id="addRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">Add Rooms</h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                       </button>
                    </div>
                    <form method="post" action="createRoom.php" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label> Enter Room name</label>
                                <input type="text" name="room_name" class="form-control" required="Room name">
                            </div>
                            <div class="form-group">
                                <label>Hotel</label>
                                <select name="hotel_id" class="form-control">
                                    <option>Select</option>
                                    <?php 
                                    $sql="SELECT * FROM tbl_tourist_hotels";
                                    $getHotels=mysqli_query($conn,$sql);
                                    if(mysqli_num_rows($getHotels)>0){
                                        while($fetch_rows=mysqli_fetch_assoc($getHotels)){
                                            ?>
                                            <option value=<?php echo $fetch_rows['hotel_id'];?>>
                                             <?php echo $fetch_rows['hotel_name'];?>
                                            </option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Enter Price</label>
                                <input type="text" name="price" class="form-control" required="" placeholder="price">
                            </div>
                            <div class="form-group">
                                <label>Upload Image</label>
                                <input type="file" name="room_image" accept="image/jpg, image/jpeg, image/png" required="" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" name="addRoom" value="Save Changes" class="btn btn-primary">
                         </div>
                    </form>
                </div>
            </div>
        </div>

        <!--update rooms-->

        <div class="modal fade" id="editRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Rooms</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="window.location.reload();">
                       <span aria-hidden="true">&times;</span>
                     </button>
                </div>
                <div class="modal-body">
                <form method="post" action="createRoom.php" enctype="multipart/form-data">
                   <div class="modal-body">
                    <input type="hidden" name="room_id" id="room_id">
                    <div class="form-group">
                            <label>Room Name</label>
                            <input type="text" name="room_name" id="room_name" value="" class="form-control" required="" placeholder="Room name">
                    </div>
                    <div class="form-group">
                            <label>Hotel Name</label>
                            <input type="hidden" name="hotel_id" id="hotel_id">
                            <select name="hotel_id" id="hotel_id" class="form-control">
                                <option>Select</option>
                                <?php
                                $sql="SELECT * FROM tbl_tourist_hotels";
                                $getHotels=mysqli_query($conn,$sql);
                                if(mysqli_num_rows($getHotels)>0){
                                    while($fetch_rows=mysqli_fetch_assoc($getHotels)){
                                        ?>
                                        <option value=<?php echo $fetch_rows['hotel_id']?>>
                                           <?php echo $fetch_rows['hotel_name'];?>
                                    </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                    </div>
                    <div class="form-group">
                            <label>Price</label>
                            <input type="text" name="price" id="price" class="form-control" required="" placeholder="Price">
                    </div>
                    <div class="form-group">
                            <div class="room_image"></div>
                            <label>Upload Image</label>
                            <input type="file" name="room_image" accept="image/jpg, image/jpeg, image/png"  required="" class="form-control">
                    </div>
                   </div>
                   <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload();">Close</button>
                        <input type="submit" name="updateRoom" value="Update Changes" class="btn btn-primary">
                   </div>
                </form>
                </div>
            </div>
        </div>
        </div>
        
        </div>
    </div>
<script>
    $('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : ''?>').addClass('active')
</script>
<?php include('inc/footer.php')?>;

<script type="text/javascript">
    $('.editRoom').click(function(){
        var id= $(this).attr('data-val');
        $.ajax({
            url: "updRooms.php",
            type: "POST",
            data: {
                type: 1,
                id: id,
            },
            cache: false,
            success: function(data){
                var jsonData= $.parseJSON(data);
                $('#room_id').val(jsonData.room_id);
                $('#hotel_id').val(jsonData.hotel_id);
                $('#room_name').val(jsonData.room_name);
                $('#price').val(jsonData.price);
                $('#room_image').append('<img src="'+jsonData.room_image+'">');

            }
        });
    })
    $('.deleteRoom').click(function(){
        var id= $(this).attr('data-val');
        $.ajax({
            url: "deleteRoom.php",
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