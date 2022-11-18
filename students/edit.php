<?php
require(dirname(dirname(__FILE__)) . '/init.php');

use App\Student;

$id = $_GET['id'];
$student = new Student('');
$student->setConnection($connection);
$studentDetails = $student->getById($id);

$template = $mustache->loadTemplate('edit-student');
echo $template->render(compact('studentDetails'));