<?php

if (! function_exists('getAppInitials')) {
    function getAppInitials() {
        $appName = config('app.name');
        $words = explode(' ', $appName);
        $initials = '';

        foreach ($words as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }

        return $initials;
    }
}
