<?php

if (!function_exists('limitWords')) {
    function limitWords($text, $limit = 50)
    {
        // Strip HTML tags
        $text = strip_tags(html_entity_decode($text));

        // Split text into words
        $words = explode(' ', $text);

        // Limit the words
        if (count($words) > $limit) {
            $text = implode(' ', array_slice($words, 0, $limit)) . '...';
        }

        return $text;
    }
}
