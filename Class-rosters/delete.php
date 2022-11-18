<?php
require(dirname(dirname(__FILE__)) . '/init.php');

use App\ClassRoster;

$id = $_GET['id'];
$course = new ClassRoster('');
$course->setConnection($connection);
$course->getById($id);
$course->delete();
header("Location: index.php");
exit();

?>