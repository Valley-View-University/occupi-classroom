<?php

/**
 * @param ...$values
 * Die and dump single/multiple items
 * @return void
 */
function dd(...$values)
{
    foreach ($values as $value) {
        echo "<pre>" . PHP_EOL;
        var_dump($value);
        echo "</pre>" . PHP_EOL;
    }
    die();
}

/**
 * @param ...$values
 * Dump single/multiple items
 * @return void
 */
function dump(...$values): void
{
    foreach ($values as $value) {
        echo "<pre>" . PHP_EOL;
        var_dump($value);
        echo "</pre>" . PHP_EOL;
    }
}

/**
 * @param $code
 * Abort default 404 unless pass with a different error code
 * @return void
 */
function abort($code = 404)
{
    http_response_code($code);
    view("${code}.php");
    die();
}

/**
 * @param $path
 * @return string
 */
function base_path($path): string
{
    return BASE_PATH . $path;
}

/**
 * @param $status
 * @param $data
 * Prints response as json
 * @return void
 */
function print_($status, $data = null): void
{
    echo $data ? json_encode(['status' => $status, 'data' => $data]) : json_encode(['status' => $status]);
}

/**
 * @param $base_query
 * @param array $fields
 * Returns dynamic bindings for query params
 * @return array
 */
function getQueryStrAndBindings($base_query, array $fields = []): array
{
    $bindings = [];
    $parts = [];
    $query_part = "";
    foreach ($fields as $key => $value) {
        if ($value) {
            $parts[] = "{$key} = :{$key}";
            $bindings[$key] = $value;
        }
    }
    for ($i = 0; $i < count($parts); $i++) {
        if ($i === count($parts) - 1) {
            $query_part .= $parts[$i];
        } else {
            $query_part .= "{$parts[$i]}, ";
        }

    }
    return ['string' => $base_query . " " . $query_part, 'bindings' => $bindings];
}


function isSecure(): bool
{
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
        return true;
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO'])
        && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'
        || !empty($_SERVER['HTTP_X_FORWARDED_SSL'])
        && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
        return true;
    }
    return false;

}

function hasWWW(): bool
{
    return str_starts_with($_SERVER['HTTP_HOST'], 'www.');
}

function redirectToSecureOrWWW()
{
    if ($_ENV['APP_ENV'] !== 'local') {
        if (!isSecure()) {
            $http_host = hasWWW() ? $_SERVER['HTTP_HOST'] : 'www.' . $_SERVER['HTTP_HOST'];
            $redirect_url = 'https://' . $http_host . $_SERVER['REQUEST_URI'];
            header('Location: ' . $redirect_url, true, 301);
            die();
        } else if (!hasWWW()) {
            $http_host = 'www.' . $_SERVER['HTTP_HOST'];
            $redirect_url = 'https://' . $http_host . $_SERVER['REQUEST_URI'];
            header('Location: ' . $redirect_url, true, 301);
            die();
        }
    }
}

function view($path, $attributes = [])
{
    extract($attributes);

    require base_path('views/' . $path);
}

function assets($path)
{
    return '/assets/' . $path;
}

function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}

function isTimeInRange($classroom): bool
{
    $day = $classroom['day'];
    $timeStart = $classroom['time_start'];
    $timeEnd = $classroom['time_end'];
    $currentDay = date('D');

    $dayMappings = [
        'Sun' => 'S',
        'Mon' => 'M',
        'Tue' => 'T',
        'Wed' => 'W',
        'Thu' => 'TH',
        'Fri' => 'F',
    ];
    if ($dayMappings[$currentDay] !== $day) {
        return false;
    }

    $currentTime = date('h:ia');
    $currentTimeObject = DateTime::createFromFormat('h:ia', $currentTime);
    $timeStartObject = DateTime::createFromFormat('h:ia', $timeStart);
    $timeEndObject = DateTime::createFromFormat('h:ia', $timeEnd);

    if ($currentTimeObject >= $timeStartObject && $currentTimeObject <= $timeEndObject) {
        return true;
    }
    return false;
}

function getDay($day)
{
    $dayMappings = [
        'M' => 'Monday',
        'T' => 'Tuesday',
        'W' => 'Wednesday',
        'TH' => 'Thursday',
        'F' => 'Friday',
    ];
    return $dayMappings[$day];
}


function calculate_last_seen($classroom)
{

//    dump(calculate_day_difference($classroom['day']));
    $current_time = new DateTime();


    $time_start_diff = $current_time->diff(new DateTime($current_time->format('Y-m-d') .
        ' ' . $classroom['time_start']));
    $time_end_diff = $current_time->diff(new DateTime($current_time->format('Y-m-d') .
        ' ' . $classroom['time_end']));

    $days = timeline($classroom['day']);
    if ($days < 0) {
        $output = '';
        $minutes_left = $time_end_diff->days * 24 * 60 + $time_end_diff->h * 60 + $time_end_diff->i;
        if (abs($days) >= 2){
            $output .= abs($days) . " days";
        }
        elseif(abs($days) == 1){
            $output .= abs($days) . " day";
        }
        else if ($minutes_left > 60 &&  round($minutes_left / 60) > 1){
            $output .= round($minutes_left / 60) . ' hours';
        }
        else if ($minutes_left == 1 && round($minutes_left / 60) == 1){
            $output .= $minutes_left . ' hour';
        }
        else if ($minutes_left == 1){
            $output .= $minutes_left . ' minute';
        }
        else if ($minutes_left < 60){
            $output .= $minutes_left . ' minutes';
        }

        return "Last seen in $output";
    }
    else {
        $output = '';
        $minutes_since = $time_start_diff->days * 24 * 60 + $time_start_diff->h * 60 + $time_start_diff->i;
        if (abs($days) >= 2){
            $output .= abs($days) . " days";
        }
        elseif(abs($days) == 1){
            $output .= abs($days) . " day";
        }
        else if ($minutes_since > 60 &&  round($minutes_since / 60) > 1){
            $output .= round($minutes_since / 60) . ' hours';
        }
        else if ($minutes_since == 1 && round($minutes_since / 60) == 1){
            $output .= $minutes_since . ' hour';
        }
        else if ($minutes_since == 1){
            $output .= $minutes_since . ' minute';
        }
        else if ($minutes_since < 60){
            $output .= $minutes_since . ' minutes';
        }

        return "Upcoming in $output";
    }
}
function timeline($input_day)
{
    $dayMappings = [
        'M' => 'Mon',
        'T' => 'Tue',
        'W' => 'Wed',
        'TH' => 'Thu',
        'F' => 'Fri',
    ];
    $input_day = $dayMappings[$input_day];
    // Create an array of weekdays with numerical keys
    $weekdays = array('Mon' => 1, 'Tue' => 2, 'Wed' => 3, 'Thu' => 4, 'Fri' => 5, 'Sat' => 6, 'Sun' => 7);

    // Get the current day using the DateTime class
    $current_day = date('D');

    // Get the numerical representation of the current and input days
    $current_day_num = $weekdays[$current_day];
    $input_day_num = $weekdays[$input_day];

    // Calculate the difference and adjust for weekly cycle
    return $input_day_num - $current_day_num;
}




