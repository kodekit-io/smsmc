<?php


if (! function_exists('authorized_to')) {
    function authorized_to($permissions) {
        $userPermissions = session('userAttributes')['permissions'];
        if (is_array($permissions)) {

        } else {
            if ($userPermissions->{$permissions}) {
                return true;
            }
        }
        return false;
    }
}