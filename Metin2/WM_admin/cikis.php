<?php
ob_start();
session_start();
ob_end_flush();
session_destroy();
header('Location: giris.php');
?>