<?php
require(dirname(dirname(__FILE__)) . '/init.php');

use App\ClassRoster;
use App\Course;
use App\Student;

$id = $_GET['id'];
$rosters = new ClassRoster('');
$rosters->setConnection($connection);
$roster = $rosters->getById($id);

$courses = new Course('');
$courses->setConnection($connection);
$course = $courses->getAll();

$students = new Student('');
$students->setConnection($connection);
$student = $students->getAll();

$template = $mustache->loadTemplate('edit-roster');
echo $template->render(compact('roster', 'course', 'student'));
?>
