<?php
$file = $_FILES["file"];
$finfo = new finfo(FILEINFO_MIME_TYPE);
$type = $finfo -> file($file['tmp_name']);
if (!isset($file['error']) or !is_int($file['error'])) {
  throw new Exception("An error occured in file uploading.");
} else if (!preg_match("/^application\/pdf/", $type)) {
  throw new Exception("Only pdf file can be accepted.");
} else if ($file['size'] > 1000000) {
  throw new Exception("Uploaded file is too large.");
} else {
  if (move_uploaded_file($file["tmp_name"], ($file_path = "./files/" . bin2hex(openssl_random_pseudo_bytes(16)) . ".pdf"))) {
    chmod($file_path, 0644);
    $file_name = basename($file_path);
  } else {
    throw new Exception("An error occured in saving file.");
  }
}
