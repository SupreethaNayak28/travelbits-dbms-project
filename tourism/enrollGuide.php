<?php
include('config/db.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>

    <!-- Include SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">

    <!-- Include jQuery (required for SweetAlert) -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Include SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>

<?php
$tourist_role_id = $_SESSION['tourist_role_id'];

if (!isset($tourist_role_id)) {
    header('location: Login.php');
    exit(); // Add exit after header to stop further execution
} else {
    if (isset($_POST['enrollGuide'])) {
        $guide_id = isset($_POST['guide_id']) ? (int)$_POST['guide_id'] : 0;

        if ($guide_id > 0) {
            $checkGuideStatusQuery = "SELECT guide_status FROM guide WHERE guide_id = ?";
            $stmt = mysqli_prepare($conn, $checkGuideStatusQuery);
            mysqli_stmt_bind_param($stmt, "i", $guide_id);
            mysqli_stmt_execute($stmt);
            $guideStatusResult = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);

            if ($guideStatusResult) {
                $guideStatus = mysqli_fetch_assoc($guideStatusResult)['guide_status'];

                if ($guideStatus == 1) {
                    // Display SweetAlert for already booked guide
                    echo '<script>
                            $(document).ready(function() {
                                Swal.fire({
                                    title: "Guide Already Booked!",
                                    text: "Sorry, the guide is already booked. Please choose another guide.",
                                    icon: "error",
                                    confirmButtonText: "OK",
                                });
                            });
                        </script>';
                } else {
                    $user_id = $_SESSION['tourist_user_id'];

                    mysqli_begin_transaction($conn);

                    $checkGuideStatusQuery = "SELECT guide_status FROM guide WHERE guide_id = ? FOR UPDATE";
                    $stmt = mysqli_prepare($conn, $checkGuideStatusQuery);
                    mysqli_stmt_bind_param($stmt, "i", $guide_id);
                    mysqli_stmt_execute($stmt);
                    $guideStatusResult = mysqli_stmt_get_result($stmt);
                    mysqli_stmt_close($stmt);

                    if ($guideStatusResult) {
                        $guideStatus = mysqli_fetch_assoc($guideStatusResult)['guide_status'];

                        if ($guideStatus == 1) {
                            mysqli_rollback($conn);
                            // Display SweetAlert for already booked guide
                            echo '<script>
                                    $(document).ready(function() {
                                        Swal.fire({
                                            title: "Guide Already Booked!",
                                            text: "Sorry, the guide is already booked. Please choose another guide.",
                                            icon: "error",
                                            confirmButtonText: "OK",
                                        });
                                    });
                                </script>';
                        } else {
                            $sql = "UPDATE guide SET guide_status = 1 WHERE guide_id = ?";
                            $stmt = mysqli_prepare($conn, $sql);
                            mysqli_stmt_bind_param($stmt, "i", $guide_id);
                            $updateGuideStatusResult = mysqli_stmt_execute($stmt);
                            mysqli_stmt_close($stmt);

                            $sql2 = "UPDATE tourist SET guide_id = ? WHERE user_id = ?";
                            $stmt2 = mysqli_prepare($conn, $sql2);
                            mysqli_stmt_bind_param($stmt2, "ii", $guide_id, $user_id);
                            $updateTouristResult = mysqli_stmt_execute($stmt2);
                            mysqli_stmt_close($stmt2);

                            if ($updateGuideStatusResult && $updateTouristResult) {
                                mysqli_commit($conn);
                                // Display SweetAlert for successful enrollment
                                echo '<script>
                                        $(document).ready(function() {
                                            Swal.fire({
                                                title: "Enrollment Successful!",
                                                text: "You have successfully enrolled with the guide.",
                                                icon: "success",
                                                confirmButtonText: "OK",
                                            }).then(function() {
                                                window.location.href = "index.php";
                                            });
                                        });
                                    </script>';
                                exit();
                            } else {
                                mysqli_rollback($conn);
                                // Display SweetAlert for enrollment failure
                                echo '<script>
                                        $(document).ready(function() {
                                            Swal.fire({
                                                title: "Enrollment Failed!",
                                                text: "Failed to enroll. Please try again.",
                                                icon: "error",
                                                confirmButtonText: "OK",
                                            });
                                        });
                                    </script>';
                            }
                        }
                    } else {
                        // Display SweetAlert for error checking guide status
                        echo '<script>
                                $(document).ready(function() {
                                    Swal.fire({
                                        title: "Error!",
                                        text: "Error checking guide status.",
                                        icon: "error",
                                        confirmButtonText: "OK",
                                    });
                                });
                            </script>';
                    }
                }
            } else {
                // Display SweetAlert for error checking guide status
                echo '<script>
                        $(document).ready(function() {
                            Swal.fire({
                                title: "Error!",
                                text: "Error checking guide status.",
                                icon: "error",
                                confirmButtonText: "OK",
                            });
                        });
                    </script>';
            }
        } else {
            // Display SweetAlert for invalid guide ID
            echo '<script>
                    $(document).ready(function() {
                        Swal.fire({
                            title: "Invalid Guide ID!",
                            text: "Invalid guide ID. Please try again.",
                            icon: "error",
                            confirmButtonText: "OK",
                        });
                    });
                </script>';
        }
    } elseif (isset($_POST['cancelBooking'])) {
        $guide_id_to_cancel = isset($_POST['guide_id_to_cancel']) ? (int)$_POST['guide_id_to_cancel'] : 0;

        if ($guide_id_to_cancel > 0) {
            $user_id = $_SESSION['tourist_user_id'];
            $checkOwnershipQuery = "SELECT user_id FROM tourist WHERE guide_id = ?";
            $stmt = mysqli_prepare($conn, $checkOwnershipQuery);
            mysqli_stmt_bind_param($stmt, "i", $guide_id_to_cancel);
            mysqli_stmt_execute($stmt);
            $ownershipResult = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);

            if ($ownershipResult) {
                $enrolled_user_id = mysqli_fetch_assoc($ownershipResult)['user_id'];

                if ($user_id == $enrolled_user_id) {
                    mysqli_begin_transaction($conn);

                    $cancelBookingQuery = "UPDATE guide SET guide_status = 0 WHERE guide_id = ?";
                    $stmt = mysqli_prepare($conn, $cancelBookingQuery);
                    mysqli_stmt_bind_param($stmt, "i", $guide_id_to_cancel);
                    $cancelBookingResult = mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);

                    if ($cancelBookingResult) {
                        mysqli_commit($conn);
                        // Display SweetAlert for successful cancellation
                        echo '<script>
                                $(document).ready(function() {
                                    Swal.fire({
                                        title: "Cancellation Successful!",
                                        text: "You have successfully canceled the guide booking.",
                                        icon: "success",
                                        confirmButtonText: "OK",
                                    }).then(function() {
                                        window.location.href = "index.php";
                                    });
                                });
                            </script>';
                        exit();
                    } else {
                        mysqli_rollback($conn);
                        // Display SweetAlert for cancellation failure
                        echo '<script>
                                $(document).ready(function() {
                                    Swal.fire({
                                        title: "Cancellation Failed!",
                                        text: "Failed to cancel guide booking. Please try again.",
                                        icon: "error",
                                        confirmButtonText: "OK",
                                    });
                                });
                            </script>';
                    }
                } else {
                    // Display SweetAlert for unauthorized cancellation
                    echo '<script>
                            $(document).ready(function() {
                                Swal.fire({
                                    title: "Unauthorized!",
                                    text: "You are not authorized to cancel this guide booking.",
                                    icon: "error",
                                    confirmButtonText: "OK",
                                });
                            });
                        </script>';
                }
            } else {
                // Display SweetAlert for error checking ownership
                echo '<script>
                        $(document).ready(function() {
                            Swal.fire({
                                title: "Error!",
                                text: "Error checking ownership.",
                                icon: "error",
                                confirmButtonText: "OK",
                            });
                        });
                    </script>';
            }
        } else {
            // Display SweetAlert for invalid guide ID to cancel
            echo '<script>
                    $(document).ready(function() {
                        Swal.fire({
                            title: "Invalid Guide ID!",
                            text: "Invalid guide ID to cancel. Please try again.",
                            icon: "error",
                            confirmButtonText: "OK",
                        });
                    });
                </script>';
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
                <?php
                // Check if guide_id is set in $_GET
                $guide_id = isset($_GET['guide_id']) ? (int)$_GET['guide_id'] : 0;

                if ($guide_id > 0) {
                    $sql = "SELECT guide.guide_id, guide.guide_name, guide.age, guide.experience, guide.address
                    FROM guide
                    WHERE guide.guide_id = ?";

                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "i", $guide_id);
                    mysqli_stmt_execute($stmt);
                    $getData = mysqli_stmt_get_result($stmt);
                    mysqli_stmt_close($stmt);

                    if ($getData) {
                        if ($row = mysqli_fetch_assoc($getData)) {
                            ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Guide Name</label>
                                    <input type="text" name="guide_name" value="<?php echo $row['guide_name']; ?>" class="form-control" readonly>
                                    <label style="margin-top:20px;">Age</label>
                                    <input type="text" name="age" value="<?php echo $row['age']; ?>" class="form-control" readonly>
                                    <label style="margin-top:20px;">Experience</label>
                                    <input type="text" name="experience" value="<?php echo $row['experience']; ?>" class="form-control" readonly>
                                    <label style="margin-top:20px;">Address</label>
                                    <input type="text" name="address" value="<?php echo $row['address']; ?>" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="row" style="margin:1% 0% 1% 0%;">
                                <input type="hidden" name="guide_id" value="<?php echo $guide_id; ?>">
                                <input type="submit" name="enrollGuide" value="Book Your Guide" class="btn btn-primary">
                            </div>
                    <?php
                    } else {
                        echo "No guide information available for this tourist.";
                    }
                } else {
                    echo "Error in SQL query: " . mysqli_error($conn);
                }
            } else {
                echo "Invalid guide ID.";
            }
            ?>

            <form class="form-horizontal" method="post">
                <input type="hidden" name="guide_id_to_cancel" value="<?php echo $guide_id; ?>">
                <input type="submit" name="cancelBooking" value="Cancel" class="btn btn-danger">
            </form>
        </div>
    </div>
</div>

<?php include('inc/footer.php'); ?>
</body>
</html>