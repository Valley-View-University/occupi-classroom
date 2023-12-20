<?php

$departments = fopen(base_path('departments.json'), 'r');
$departments = json_decode(fread($departments, filesize(base_path('departments.json'))), true);

view("departments/index.view.php", [
    'heading' => 'Departments',
    'departments' => $departments
]);