<?php


if (! function_exists('is_authorized_to')) {
    function is_authorized_to($permission) {
        $userPermissions = session('userAttributes')['permissions'];
        if (in_array($permission, $userPermissions)) {
            return true;
        }
        return false;
    }
}

if (! function_exists('get_socmeds')) {
    function get_socmeds($excludes = []) {
        $arr = [
            1 => 'Facebook',
            2 => 'Twitter',
            4 => 'National',
            9 => 'International',
            3 => 'Blog',
            6 => 'Forum',
            5 => 'Youtube',
            7 => 'Instagram',
        ];
        if (count($excludes) > 0) {
            foreach ($excludes as $exclude) {
                array_pull($arr, $exclude);
            }
        }
        return $arr;
    }
}