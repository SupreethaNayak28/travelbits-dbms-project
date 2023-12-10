<?php
include('config/db.php');
session_start();

$tourist_user_id = $_SESSION['tourist_user_id'];

if (!isset($tourist_user_id)) {
    header('location: Login.php');
} else {
    if (isset($_POST['cancelBooking'])) {
        $room_id_to_cancel = mysqli_real_escape_string($conn, $_POST['room_id_to_cancel']);

        // Update the booking_status for the tourist to 0 (canceled)
        $updateBookingStatusQuery = "UPDATE tourist SET booking_status = 0 WHERE user_id = $tourist_user_id";
        mysqli_query($conn, $updateBookingStatusQuery);

        // Update the booking status for the room to 0 (available)
        $cancelBookingQuery = "UPDATE tbl_tourist_rooms SET booking_status = 0 WHERE room_id = $room_id_to_cancel";
        mysqli_query($conn, $cancelBookingQuery);

        header('location: tourist_dashboard.php');
        exit(); // Ensure script stops execution after redirect
    }
}
?>
