<?php
$conn=mysqli_connect('localhost','root','','tours') or die('connection failure');
?>
<?php
    session_start();
    $hotel_id= $_POST['id'];
    $sql= "SELECT * FROM tbl_tourist_hotels WHERE hotel_id='$hotel_id'";
    $getCategories= mysqli_query($conn,$sql);
    if(mysqli_num_rows($getCategories) > 0){
        while($row = mysqli_fetch_assoc($getCategories)){
           $data = array(
            'hotel_id' => $row['hotel_id'],
            'hotel_name' => $row['hotel_name'],
            'tag_name' => $row['tag_name'],
            'hotel_image'=> $row['hotel_image']
           );
        }
    echo json_encode($data);
    }
?>