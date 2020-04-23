<?php

namespace App;

use VK\Client\VKApiClient;

class VkHelper
{
    /** @var VKApiClient */
    protected $vk;

    /** @var string */
    protected $token;

    public function __construct(string $token)
    {
        $this->vk = new VKApiClient();
        $this->token = $token;
    }

    public function sendPost(int $groupId, string $message, array $attachments = []): int
    {
        $response = $this->vk->wall()->post($this->token, [
            'owner_id' => $groupId,
            'message' => $message,
            'attachments' => implode(',', $attachments),
        ]);

        return $response['post_id'];
    }

    public function uploadPhoto(int $groupId, string $path): array
    {
        $response = $this->vk->photos()->getWallUploadServer($this->token, ['group_id' => abs($groupId)]);
        $response = $this->vk->getRequest()->upload($response['upload_url'], 'photo', $path);

        $response = $this->vk->photos()->saveWallPhoto($this->token, [
            'group_id' => abs($groupId),
            'server' => $response['server'],
            'photo'  => $response['photo'],
            'hash'   => $response['hash'],
        ]);

        return $response[0] ?? $response;
    }

    public function linkToId(string $url)
    {
        $screenName = substr(parse_url($url)['path'], 1);
        $res = $this->vk->utils()->resolveScreenName($this->token, [
            'screen_name' => $screenName,
        ]);

        return $res['object_id'] * -1;
    }
}
