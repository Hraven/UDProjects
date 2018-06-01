<?php
require_once("../FileDownload.php");
use Apfelbox\FileDownload\FileDownload;
$name = $_POST['name'];
$token = $_POST['token'];
$file = $_POST['toDownload'];
$fileDownload = FileDownload::createFromFilePath($file);
$fileDownload->sendDownload($name);
// header("location: ../?t=$token");
