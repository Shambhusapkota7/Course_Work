<?php
session_start();      // Start session
session_destroy();    // Logout user
header("Location: login.php");
exit;
