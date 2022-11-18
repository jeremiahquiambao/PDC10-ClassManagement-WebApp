<?php
require(dirname(dirname(__FILE__)) . '/init.php');

use App\ClassRoster;
use App\Course;
use App\Teacher;
use App\Student;

$classRoster = new ClassRoster('');
$classRoster->setConnection($connection);
$roster = $classRoster->getRoster();

$template = $mustache->loadTemplate('list-roster');
echo $template->render(compact('roster'))
?>