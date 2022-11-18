<?php
require (dirname(dirname(__FILE__)) . '/init.php');
use App\Student;

$id = $_GET['id'];
$student = new Student('');
$student->setConnection($connection);
$student->getById($id);
$student->delete();
header("Location: index.php");
exit();

?>