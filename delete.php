<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require 'function.php';
$id = $_GET['idberita'];

if (delete($id) > 0) {
    echo "<script>document.location.href = 'index.php';</script>";

} else {
    echo "<script>document.location.href = 'index.php';</script>";

}

?>