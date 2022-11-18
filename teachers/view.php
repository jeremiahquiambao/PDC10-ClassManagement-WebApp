<?php
require(dirname(dirname(__FILE__)) . '/init.php');

use App\Teacher;

$id = $_GET['id'];
$listClasses = new Teacher('');
$listClasses->setConnection($connection);
$classes = $listClasses->viewClasses($id);

$teacherName = new Teacher('');
$teacherName->setConnection($connection);
$teacher = $teacherName->getById($id);

$template = $mustache->loadTemplate('view-teacher');
echo $template->render(compact('classes', 'teacher'))
?>

