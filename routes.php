<?php

$router->get('/', 'controllers/index.php');
$router->get('/departments', 'controllers/departments/index.php');
$router->get('/departments/:id/classrooms', 'controllers/departments/classrooms/index.php');
$router->get('/departments/:id/classrooms/:id', 'controllers/departments/classrooms/show.php');


