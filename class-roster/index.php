<?php

include ("../init.php");
use Models\ClassRoster;

$class_roster = new ClassRoster('', '');
$class_roster->setConnection($connection);
$all_classes_rosters = $class_roster->getAllClassesRosters();

$mustache = new Mustache_Engine([
	'loader' => new Mustache_Loader_FilesystemLoader('../templates/class-roster')
]);

$template = $mustache->loadTemplate('index');
echo $template->render(compact('all_classes_rosters', 'success'));