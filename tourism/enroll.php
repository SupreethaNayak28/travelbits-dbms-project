<style>
/* Add this to your CSS file or in a style tag in the head of your HTML */
.select-spacing {
    margin-top: 15px;
    width: 100%;
}
</style>
<?php
include('config/db.php');
session_start();

$tourist_role_id = $_SESSION['tourist_role_id'];

if (!isset($tourist_role_id)) {
    header('location: Login.php');
} else {
    if (isset($_POST['enrollHotel'])) {
        $room_id = mysqli_real_escape_string($conn, $_POST['room_id']);

        // Check booking status before enrolling
        $checkBookingStatusQuery = "SELECT booking_status FROM tbl_tourist_rooms WHERE room_id = $room_id";
        $bookingStatusResult = mysqli_query($conn, $checkBookingStatusQuery);

        if ($bookingStatusResult) {
            $bookingStatus = mysqli_fetch_assoc($bookingStatusResult)['booking_status'];

            if ($bookingStatus == 1) {
                // Room is already booked, inform the user
                $message[] = 'Sorry, the room is already booked.Please choose another room';
                
            } else {
                // Proceed with enrollment since the room is available
                $tourist_name = mysqli_real_escape_string($conn, $_POST['tourist_name']);
                $user_id = $_SESSION['tourist_user_id'];
                $user_role_id = $_SESSION['tourist_role_id'];
                $hotel_name = mysqli_real_escape_string($conn, $_POST['hotel_name']);
                $room_name = mysqli_real_escape_string($conn, $_POST['room_name']);
                $hotel_id = $_POST['hotel_id'];
                $room_id = $_POST['room_id'];
                $price = $_POST['price'];
                $address = mysqli_real_escape_string($conn, $_POST['address']);
                $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);

                // Use a transaction to ensure data consistency
                mysqli_begin_transaction($conn);

                // Check the booking status again in case it changed before the transaction
                $checkBookingStatusQuery = "SELECT booking_status FROM tbl_tourist_rooms WHERE room_id = $room_id FOR UPDATE";
                $bookingStatusResult = mysqli_query($conn, $checkBookingStatusQuery);

                if ($bookingStatusResult) {
                    $bookingStatus = mysqli_fetch_assoc($bookingStatusResult)['booking_status'];

                    if ($bookingStatus == 1) {
                        // Room was booked by someone else during the transaction, rollback
                        mysqli_rollback($conn);
                        $message[] = 'Sorry, the room is already booked. Please choose another room.';
                    } else {
                        // Proceed with enrollment since the room is still available
                        $sql1 = "INSERT INTO tbl_enrollment(tourist_name, hotel_name, room_name, user_id, user_role_id, hotel_id, room_id, price, address, payment_method) VALUES ('$tourist_name', '$hotel_name', '$room_name', '$user_id', '$user_role_id', '$hotel_id', '$room_id', '$price', '$address', '$payment_method')";

                        $sql2 = "UPDATE tbl_tourist_rooms SET booking_status = 1 WHERE room_id = $room_id";

                        if (mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2)) {
                            // Both queries succeeded, commit the transaction
                            mysqli_commit($conn);
                            header('location: index.php');
                        } else {
                            // Something went wrong, rollback the transaction
                            mysqli_rollback($conn);
                            $message[] = 'Failed to enroll!';
                        }
                    }
                } else {
                    // Error checking booking status
                    $message[] = 'Error checking booking status.';
                }
            }
        } else {
            $message[] = 'Error checking booking status.';
        }
    }elseif (isset($_POST['cancelBooking'])) {
        $room_id_to_cancel = mysqli_real_escape_string($conn, $_POST['room_id_to_cancel']);
        // Check if the logged-in user is the one who enrolled for the room
        $user_id = $_SESSION['tourist_user_id'];
        $checkOwnershipQuery = "SELECT user_id FROM tbl_enrollment WHERE room_id = $room_id_to_cancel";
        $ownershipResult = mysqli_query($conn, $checkOwnershipQuery);
    
        if ($ownershipResult) {
            $enrolled_user_id = mysqli_fetch_assoc($ownershipResult)['user_id'];
    
            if ($user_id == $enrolled_user_id) {
                // Use a transaction to ensure data consistency
                mysqli_begin_transaction($conn);
    
                $cancelBookingQuery = "UPDATE tbl_tourist_rooms SET booking_status = 0 WHERE room_id = $room_id_to_cancel";
    
                if (mysqli_query($conn, $cancelBookingQuery)) {
                    // Booking canceled successfully, commit the transaction
                    mysqli_commit($conn);
                    header('location: index.php');
                    exit(); // Ensure script stops execution after redirect
                } else {
                    // Something went wrong, rollback the transaction
                    mysqli_rollback($conn);
                    $message[] = 'Failed to cancel booking!';
                }
            } else {
                // The logged-in user does not own this booking
                $message[] = 'You are not authorized to cancel this booking.';
            }
        } else {
            // Error checking ownership
            $message[] = 'Error checking ownership.';
        }
    }
    
}

    include('inc/header.php');
?>


    <div class="container">
        <div class="row">
            <h1 style="text-align:center;margin:30px;">BOOK WITH US</h1>
        </div>
        <div class="section">
            <div class="enrollBox">
                <form class="form-horizontal" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <?php
                            $username = $_SESSION['username'];
                            $user_id = $_SESSION['tourist_user_id'];
                            $user_role_id = $_SESSION['tourist_role_id'];
                            $hotel_id = $_GET['cat_id'];
                            $room_id = $_GET['did'];

                            $sql = "SELECT tbl_tourist_hotels.hotel_name, tbl_tourist_rooms.room_name, tbl_tourist_rooms.price
                                FROM tbl_tourist_hotels 
                                JOIN tbl_tourist_rooms ON tbl_tourist_rooms.hotel_id=tbl_tourist_hotels.hotel_id 
                                WHERE tbl_tourist_hotels.hotel_id=$hotel_id AND tbl_tourist_rooms.room_id=$room_id";

                            $getData = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($getData) > 0) {
                                while ($row = mysqli_fetch_assoc($getData)) {
                                    ?>
                                    <?php
// Check if there are any messages to display
if (!empty($message)) {
    echo '<div class="container mt-4">';
    echo '<div class="row justify-content-center">';
    echo '<div class="col-md-8">';
    foreach ($message as $msg) {
        echo '<div class="alert alert-danger" role="alert">' . $msg . '</div>';
    }
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
?>
                                    <label>Tourist Name</label>
                                    <input type="text" name="tourist_name" value="<?php echo $username; ?>" class="form-control">
                                    <label style="margin-top:20px;">Hotel Name</label>
                                    <input type="text" name="hotel_name" value="<?php echo $row['hotel_name']; ?>" class="form-control">
                                    <input type="hidden" name="hotel_id" value="<?php echo $hotel_id; ?>">
                                    <label style="margin-top:20px;">Room Name</label>
                                    <input type="text" name="room_name" value="<?php echo $row['room_name']; ?>" class="form-control">
                                    <input type="hidden" name="room_id" value="<?php echo $room_id; ?>">
                                    <label style="margin-top:20px;">Price</label>
                                    <input type="text" name="price" value="<?php echo $row['price']; ?>" class="form-control">
                                    <label style="margin-top:25px;">Address</label>
                                    <textarea type="text" name="address" class="form-control" rows="4" cols="30" placeholder="Address"></textarea>
                                <?php
                                }
                            }
                            ?>
                        </div>
                    

                        <label style="margin-top:30px;"></label>
                        <select name="payment_method" class="form-control select-spacing">
    <option>Payment Method</option>
    <option>Cash</option>
    <option>Credit Card</option>
    <option>Debit Card</option>
    <option>Internet Banking</option>
    </select>

                    </div>
                    <div class="row" style="margin:1% 0% 1% 0%;">
                        <input type="submit" name="enrollHotel" value="Enroll Now" class="btn btn-primary">
                    </div>
                </form>
                <form class="form-horizontal" method="post">
                <input type="hidden" name="room_id_to_cancel" value="<?php echo $room_id; ?>">
                <input type="submit" name="cancelBooking" value="Cancel Booking" class="btn btn-danger">
            </form>
            </div>
        </div>
    </div>

    <?php include('inc/footer.php'); ?>
<?php
?>
