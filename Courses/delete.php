<?php
require(dirname(dirname(__FILE__)) . '/init.php');

use App\Course;

$id = $_GET['id'];
$course = new Course('');
$course->setConnection($connection);
$course->getById($id);
$course->delete();
header("Location: index.php");
exit();
