<?php
$conn=mysqli_connect('localhost','root','','tours') or die('connection failure');
?>
<?php
    session_start();
    $room_id= $_POST['id'];
    $sql= "SELECT * FROM tbl_tourist_rooms JOIN tbl_tourist_hotels ON tbl_tourist_hotels.hotel_id= tbl_tourist_rooms.hotel_id WHERE room_id='$room_id'";
    $updateRoom= mysqli_query($conn,$sql);
    if(mysqli_num_rows($updateRoom) > 0){
        while($row = mysqli_fetch_assoc($updateRoom)){
           $data = array(
            'room_id' => $row['room_id'],
            'hotel_id' => $row['hotel_id'],
            'room_name' => $row['room_name'],
            'hotel_name'=> $row['hotel_name'],
            'price' => $row['price'],
            'room_image'=>$row['room_image'],
           );
        }
    echo json_encode($data);
    }
    ?>