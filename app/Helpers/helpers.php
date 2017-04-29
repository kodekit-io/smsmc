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