<?php
include('config/db.php');
?>
<?php session_start(); ?>
<?php
$admin_user_id = $_SESSION['admin_user_id'];
if (!isset($admin_user_id)) {
    header('location:Login.php');
} else {
    ?>
    <?php include('inc/header.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php include('sidebar/adminsidebar.php'); ?>
            </div>
            <div class="col-md-9">
                <div class="container">
                    <div class="row">
                        <h1 style="text-align:center;margin:30px;">Enrolled Tourists</h1>
                    </div>
                </div>
                <div class="section">
                    <?php
                    // Fetch all enrollments
                    $sqlEnrolledTourists = "SELECT tbl_enrollment.*, tbl_tourist_hotels.hotel_id FROM tbl_enrollment
                                           JOIN tourist ON tbl_enrollment.user_id = tourist.user_id
                                           JOIN tbl_tourist_hotels ON tbl_enrollment.hotel_id = tbl_tourist_hotels.hotel_id";

                    $resultEnrolledTourists = mysqli_query($conn, $sqlEnrolledTourists);

                    if (mysqli_num_rows($resultEnrolledTourists) > 0) {
                        ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    <th>Hotel Name</th>
                                    <th>Room Name</th>
                                    <th>Price</th>
                                    <th>Booked At</th>
                                    <!-- Add more columns as needed -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($resultEnrolledTourists)) {
                                    // Check for conditions that indicate a successful enrollment
                                    if (!empty($row['user_id']) && !empty($row['hotel_id'])) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['user_id']; ?></td>
                                            <td><?php echo $row['tourist_name']; ?></td>
                                            <td><?php echo $row['hotel_name']; ?></td>
                                            <td><?php echo $row['room_name']; ?></td>
                                            <td><?php echo $row['price']; ?></td>
                                            <td><?php echo $row['checkin']; ?></td>
                                            <!-- Add more cells as needed -->
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php
                    } else {
                        echo "No enrolled tourists found.";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php include('inc/footer.php'); ?>
<?php
}
?>
