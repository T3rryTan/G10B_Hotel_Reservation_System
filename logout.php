<?php
session_start();
session_unset();
session_destroy();

header("location:mainhotel0.php");
exit();
?>
