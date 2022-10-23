<?php

include ("../init.php");
use Models\Student;

$id = $_GET['id']??null;

$student= new Student('', '', '', '', '', '');
$student->setConnection($connection);
$student->getById($id);
$student_name = $student->getFirstName() . ' ' . $student->getLastName();
$student_number = $student->getStudentNumber();
$student_classes = $student->getClasses();

$mustache = new Mustache_Engine([
	'loader' => new Mustache_Loader_FilesystemLoader('../templates/students')
]);

$template = $mustache->loadTemplate('classes');
echo $template->render(compact('student_name','student_number','student_classes'));