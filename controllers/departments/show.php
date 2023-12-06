<?php

use Core\App;

$uri_param = $uri_param ?? [];

view("departments/show.view.php", [
    'heading' => 'Department']);