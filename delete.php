<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
$cus_id = $_SESSION["cus_id"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    class MyDB extends SQLite3 {
        function __construct() {
           $this->open('db/omakase.db');
        }
     }
    
     // 2. Open Database 
     $db = new MyDB();
    if (isset($_GET['delete_booking_id']) && isset($cus_id)) {

        $delete_booking_id = $_GET['delete_booking_id'];
        $sql = "SELECT seat_id FROM booking where booking_id = '$delete_booking_id'";
        $result = $db->query($sql);
        $seatid= $result->fetchArray(SQLITE3_ASSOC);;
        $seat = $seatid["seat_id"];
        $sql = "DELETE FROM booking WHERE booking_id = '$delete_booking_id'";
        echo $delete_booking_id;
        if ($db->query($sql)) {
            echo "<script>window.location.href = 'history.php'</script>";
        } else {
            echo "Error deleting";
        }
    }
    ?>

</body>

</html>