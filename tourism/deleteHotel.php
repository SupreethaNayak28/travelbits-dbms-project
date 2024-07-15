<?php
include('config/db.php');?>
<?php
  session_start();
  $hotel_id= $_POST['id'];
  $getUrl="SELECT hotel_image FROM tbl_tourist_hotels WHERE hotel_id='$hotel_id'";
  $result= mysqli_query($conn,$getUrl);
  if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)){
        $img= $row['hotel_image'];
    }
    $sql="DELETE FROM tbl_tourist_hotels WHERE hotel_id='$hotel_id'";
    unlink($img);
    if(mysqli_query($conn, $sql)){
        echo 'Category deleted successfully';
    }
  }
?>