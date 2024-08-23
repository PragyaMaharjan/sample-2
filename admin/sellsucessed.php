<?php
define('TITLE', 'Sell Product');
define('PAGE', 'assets');
include('./includes/header.php');
include('../requester/dbconnection.php');
session_start();

if (!isset($_SESSION['is_adminlogin'])) {
    // If session is not set or user is not logged in, redirect to login page
    header('Location: login.php');
    exit(); // Make sure to call exit() after a header redirect
}

$sql = "SELECT * FROM customer_tb WHERE custid = {$_SESSION['myid']}";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    echo "<div class='ml-5 mt-5'>
    <h3 class='text-center'>Customer Bill</h3>
    <table class='table'>
    <tbody>
    <tr>
        <th>Customer ID</th>
        <td>{$row['custid']}</td>
    </tr>
    <tr>
        <th>Customer Name</th>
        <td>{$row['custname']}</td>
    </tr>
    <tr>
        <th>Product Name</th>
        <td>{$row['cpname']}</td>
    </tr>
    <tr>
        <th>Quantity</th>
        <td>{$row['cpquantity']}</td>
    </tr>
    <tr>
        <th>Price Each</th>
        <td>{$row['cpeach']}</td>
    </tr>
    <tr>
        <th>Total Cost</th>
        <td>{$row['cptotal']}</td>
    </tr>
    <tr>
        <th>Date</th>
        <td>{$row['cpdate']}</td>
    </tr>
    <tr>
        <td colspan='2' class='text-center d-print-none'>
            <button class='btn btn-danger' onclick='window.print()'>Print</button>
            <a href='assets.php' class='btn btn-secondary'>Close</a>
        </td>
    </tr>
    </tbody>
    </table>
    </div>";
} else {
    echo "Failed to retrieve data.";
}

include('./includes/footer.php');
?>
