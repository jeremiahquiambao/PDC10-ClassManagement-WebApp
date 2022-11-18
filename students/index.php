<?php
require(dirname(dirname(__FILE__)) . '/init.php');

use App\Student;

$student = new Student('');
$student->setConnection($connection);
$students = $student->getAll();

$template = $mustache->loadTemplate('list-student');
echo $template->render(compact('students'));
?>