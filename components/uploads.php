<?php

use stefangabos\Zebra_Image\Zebra_Image;

function upload_images($files, $size = ["width" => 100, "height" => 100])
{
    ini_set('memory_limit', '512M');

    if ($files == null || empty($files)) {
        return [];
    }

    $uploaded_images = [];

    foreach ($files as $file) {

        if (
            isset($file['name']) &&
            isset($file['full_path']) &&
            isset($file['tmp_name'])
            && isset($file['error']) &&
            isset($file["size"])
        ) {
            $ext = pathinfo($file["name"], PATHINFO_EXTENSION);
            $file_name = time() . "-" . rand(0, 10000000000) . '.' . $ext;
            $destination = 'uploads/etc/' . $file_name;
            $thumb_destination = 'uploads/etc/' . 'thumb-' . $file_name;

            $res = move_uploaded_file($file['tmp_name'], $destination);

            if (!$res) {
                // put in session
                $_SESSION['upload_error'] = "FAILED TO UPLOAD FILE/S";
                return $uploaded_images;
            }

            $thumb_destination = create_thumb($size, $destination, $thumb_destination);

            $img['src'] = $destination;
            $img['thumb'] = $thumb_destination;

            $uploaded_images[] = $img;
        }
    }

    return $uploaded_images;
}

function create_thumb($size, $source, $target)
{
    ini_set("memory_limit", "-1");

    $image = new Zebra_Image();

    $image->auto_handle_exif_orientation = true;
    $image->source_path = $source;
    $image->target_path = $target;
    $image->preserve_aspect_ratio = true;
    $image->enlarge_smaller_images = true;
    $image->preserve_time = true;

    $image->jpeg_quality = 100;

    if (!$image->resize($size['width'], $size['height'], ZEBRA_IMAGE_CROP_CENTER)) {
        return $image->source_path;
    } else {
        return $image->target_path;
    }
}


function get_photo($json)
{
    if (!isset($json)) {
        return "";
    }

    return json_decode($json)[0]->src;
}

function get_thumb($json)
{
    if (!isset($json)) {
        return "";
    }

    return json_decode($json)[0]->thumb;
}