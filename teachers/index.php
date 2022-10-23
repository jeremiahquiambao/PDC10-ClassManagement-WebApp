<?php

include ("../init.php");
use Models\Teacher;

$teacher = new Teacher('', '', '', '', '');
$teacher->setConnection($connection);
$all_teachers = $teacher->getAllTeachers();
#var_dump($all_teachers);

$mustache = new Mustache_Engine([
	'loader' => new Mustache_Loader_FilesystemLoader('../templates/teachers')
]);

$template = $mustache->loadTemplate('index');
echo $template->render(compact('all_teachers', 'success'));