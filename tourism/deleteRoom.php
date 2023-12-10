<?php
$conn=mysqli_connect('localhost','root','','tours') or die('connection failure');
?>
<?php
  session_start();
  $room_id= $_POST['id'];
  $getUrl="SELECT room_image FROM tbl_tourist_rooms WHERE room_id='$room_id'";
  $result= mysqli_query($conn,$getUrl);
  if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)){
        $img= $row['room_image'];
    }
    $sql="DELETE FROM tbl_tourist_rooms WHERE room_id='$room_id'";
    unlink($img);
    if(mysqli_query($conn, $sql)){
        echo 'Category deleted successfully';
    }
  }
?>