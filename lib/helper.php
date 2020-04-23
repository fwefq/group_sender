<?php

function strToLinks(string $links): array {
    $links = explode("\r\n", $links);
    return array_filter($links, function ($link) {
        return filter_var($link, FILTER_VALIDATE_URL);
    });
}

function savePhoto(array $photos): array {
    $filePhotos = [];

    foreach ($photos['name'] as $i => $name) {
        $destination = __DIR__ . '/images/' . time() . $name;
        move_uploaded_file($photos['tmp_name'][$i], $destination);
        $filePhotos[] = $destination;
    }

    return $filePhotos;
}
