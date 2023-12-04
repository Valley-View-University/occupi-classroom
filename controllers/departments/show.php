<?php

use Core\Database;
use Core\App;

$db = App::resolve(Database::class);
$currentUserId = 1;
$notes = $db->query('select * from notes where user_id = :id', ['id' => $currentUserId])->get();

view("notes/index.view.php", [
    'heading' => 'My Notes',
    'notes' => $notes
]);