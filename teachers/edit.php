<?php
require(dirname(dirname(__FILE__)) . '/init.php');

use App\Teacher;

$id = $_GET['id'];
$teachers = new Teacher('');
$teachers->setConnection($connection);
$teacherDetails = $teachers->getById($id);

$template = $mustache->loadTemplate('edit-teacher');
echo $template->render(compact('teacherDetails'))
?>
