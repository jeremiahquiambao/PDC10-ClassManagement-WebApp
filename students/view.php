<?php
require(dirname(dirname(__FILE__)) . '/init.php');

use App\Student;
use App\Course;

$id = $_GET['id'];
$getClasses = new Student('');
$getClasses->setConnection($connection);
$classes = $getClasses->viewClasses($id);

$studentName = new Student('');
$studentName->setConnection($connection);
$student = $studentName->getById($id);

$template = $mustache->loadTemplate('view-student');
echo $template->render(compact('student', 'classes'))
?>
