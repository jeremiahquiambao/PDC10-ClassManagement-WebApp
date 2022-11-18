<?php
require(dirname(dirname(__FILE__)) . '/init.php');

use App\Student;

$template = $mustache->loadTemplate('add-student');
echo $template->render();
