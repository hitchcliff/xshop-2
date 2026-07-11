<?php

include('./components/header.php');
include('./components/is_admin.php'); // check admin


$id = $_REQUEST['id'];
$url = ADMIN_URL . 'product-photo-gallery.php?id=' . $id;

$sql = "DELETE FROM product_gallery WHERE id='$id'";
$query = $pdo->query($sql);

if ($query->rowCount() > 0) {

    $success_message = "Deleted successfully";
    $_SESSION['success_message'] = $success_message;

} else {
    $error_message = 'Error deleting product id: ' . $id;
    $_SESSION['error_message'] = $error_message;
}

header("Location: $url");
exit;
