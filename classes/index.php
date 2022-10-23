<?php

include ("../init.php");
use Models\TheClass;

$class = new TheClass('', '', '', '');
$class->setConnection($connection);
$all_classes = $class->getAllClasses();
#var_dump($all_classes);

$mustache = new Mustache_Engine([
	'loader' => new Mustache_Loader_FilesystemLoader('../templates/classes')
]);

$template = $mustache->loadTemplate('index');
echo $template->render(compact('all_classes', 'success'));