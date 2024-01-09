<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$uri = explode('/', rtrim($uri, '/'));

$department_id = $uri[2];

$timetable = fopen(base_path('timetable.json'), 'r');
$timetable = json_decode(fread($timetable, filesize(base_path('timetable.json'))), true);

$departments = fopen(base_path('departments.json'), 'r');
$departments = json_decode(fread($departments, filesize(base_path('departments.json'))), true);

$available_classrooms = [];


foreach ($timetable as $record){
    foreach($departments as $department){
        if($department['short_hand'] == $department_id){
            foreach($department['classrooms'] as $classroom){
                if ($classroom['name'] === $record['classroom']){
                    $available_classrooms[] = $record;
                }
            }
        }
    }
}

$customOrder = array('M', 'T', 'W', 'TH', 'F');

usort($available_classrooms, function ($a, $b) use ($customOrder) {
    return array_search($a['day'], $customOrder) - array_search($b['day'], $customOrder);
});

view("classrooms/index.view.php", [
    'heading' => 'Classrooms',
    'available_classrooms' => $available_classrooms
]);