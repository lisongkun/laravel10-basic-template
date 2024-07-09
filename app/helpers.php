<?php


if (!function_exists('admin')) {
    function admin()
    {
        return auth('admin');
    }
}
