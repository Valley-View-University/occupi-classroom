<?php

namespace Core;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class Validator
{
    protected static array $errors = [];

    public static function string($value, $name, $min = 1, $max = INF, $optional = false)
    {
        if (($optional && ($value !== null)) || !$optional) {
            $value = trim($value);
            if (strlen($value) === 0) {
                Validator::$errors[] = "{$name} is required";
            } else if (strlen($value) < $min) {
                Validator::$errors[] = "{$name} cannot be less than {$min} characters";
            } else if (strlen($value) > $max) {
                Validator::$errors[] = "{$name} cannot be more than {$max} characters";
            }
        }


        if (count(Validator::$errors) !== 0) {

            print_(false, Validator::$errors[0]);
            abort(400);

        }
        return true;
    }

    public static function email($value, $name, $optional = false)
    {
        if (($optional && ($value !== null)) || !$optional) {
            $value = trim($value);

            if (strlen($value) === 0) {
                Validator::$errors[] = "{$name} is required";
            }
            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                Validator::$errors[] = "{$name} is not valid";
            }
        }
        if (count(Validator::$errors) !== 0) {

            print_(false, Validator::$errors[0]);
            abort(400);

        }
        return true;
    }

    public static function password($value, $name, $optional = false)
    {
        if (($optional && ($value !== null)) || !$optional) {
            if (strlen($value) === 0) {
                Validator::$errors[] = "{$name} is required";
            }
            if (strlen($value) <= '8') {
                Validator::$errors[] = "{$name} must contain at least 8 Characters";
            } elseif (!preg_match("#[0-9]+#", $value)) {
                Validator::$errors[] = "Your {$name} must contain at least 1 number";
            } elseif (!preg_match("#[A-Z]+#", $value)) {
                Validator::$errors[] = "Your {$name} must contain at least 1 capital letter";
            } elseif (!preg_match("#[a-z]+#", $value)) {
                Validator::$errors[] = "Your {$name} must contain at least 1 lowercase letter";
            }
        }
        if (count(Validator::$errors) !== 0) {

            print_(false, Validator::$errors[0]);
            abort(400);

        }
        return true;
    }

    public static function phoneNumber($value, $name, $optional = false)
    {
        if (($optional && ($value !== null)) || !$optional) {
            if (strlen($name) === 0) {
                Validator::$errors[] = "{$name} is required";

            }
            $last_digits = substr($value, 1);

            if (!preg_match('/^\+/', $value) || (!is_numeric($last_digits))) {
                Validator::$errors[] = "{$name} not valid";
            }
        }
        if (count(Validator::$errors) !== 0) {

            print_(false, Validator::$errors[0]);
            abort(400);

        }
        return true;
    }

    public static function entryExistsInDb($name, $query, $bindings, $break_if_true = true, $message = null)
    {
        $db = App::resolve(Database::class);

        // Get first item in the array to show boolean state
        if (reset($db->query($query, $bindings)->find())) {
            if ($message) {
                if ($message === 'default') {
                    print_(false, "Account already exists with the {$name}");
                } else {
                    print_($message['status'], $message['data']);
                }
            }
            if ($break_if_true) {
                abort();
            }
            return true;
        } else {
            return false;
        }

    }

    public static function passwordEqualsHash($password, $password_hash)
    {
        if (!password_verify($password, $password_hash)) {
            print_(false, "Email/password doesn't exist for a user");
            abort(400);
        }
        return true;
    }

    public static function validateToken($token, $key, $algorithm, $checker = null)
    {
        try {
            if (!$token) {
                print_(false, 'Bearer token missing');
                abort();
            }
            $result = JWT::decode($token, new Key($key, $algorithm));
            if ($checker && !($result->$checker)) {
                print_(false, 'Expired/Invalid token');
                abort(404);
            }
        } catch (Exception) {
            print_(false, 'Expired/Invalid token');
            abort();
        }

    }


}

