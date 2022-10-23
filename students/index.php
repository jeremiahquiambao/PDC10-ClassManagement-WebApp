<?php

include ("../init.php");
use Models\Student;

$student= new Student('', '', '', '', '', '');
$student->setConnection($connection);
$all_students = $student->getAllStudents();
#var_dump($all_students);

$mustache = new Mustache_Engine([
	'loader' => new Mustache_Loader_FilesystemLoader('../templates/students')
]);

$template = $mustache->loadTemplate('index');
echo $template->render(compact('all_students', 'success'));