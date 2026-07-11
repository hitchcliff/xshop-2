<?php

include('./components/header.php');
include('./components/is_admin.php'); // check admin


$photo_id = $_REQUEST['photo_id'];
$product_id = $_REQUEST['product_id'];

$url = ADMIN_URL . 'product-photo-gallery.php?id=' . $product_id;

$sql = "DELETE FROM product_gallery WHERE id='$photo_id'";
$query = $pdo->query($sql);

if ($query->rowCount() > 0) {

    $success_message = "Deleted successfully";
    $_SESSION['success_message'] = $success_message;

} else {
    $error_message = 'Error deleting photo id: ' . $photo_id;
    $_SESSION['error_message'] = $error_message;
}

header("Location: $url");
exit;
