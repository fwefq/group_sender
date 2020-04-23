<?php

require './vendor/autoload.php';

$token = '';
$groupId = -1;

$vkHelper = new \App\VkHelper($token);

$links = strToLinks($_POST['links']);
$idsGroups = array_map(function ($link) use ($vkHelper) {
    return $vkHelper->linkToId($link);
}, $links);

$photos = savePhoto($_FILES['photos']);
$attachments = [];
foreach ($photos as $path) {
    $item = $vkHelper->uploadPhoto($groupId, $path);
    $attachments[] = 'photo' . $item['owner_id'] . '_' . $item['id'];
}

$res = $vkHelper->sendPost($groupId, $_POST['message'], $attachments);
var_dump($res);
