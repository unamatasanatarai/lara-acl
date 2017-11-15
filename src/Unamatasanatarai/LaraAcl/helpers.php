<?php
if ( ! function_exists('permitted_if')) {
    function permitted_if($permissions) {
        if (\Auth::user() && \Auth::user()->hasPermission($permissions))
        {
            return true;
        }
        abort(404);
    }
}