<?php

namespace WeStacks\TeleBot\Methods\Stickers;

use WeStacks\TeleBot\Helpers\TypeCaster;
use WeStacks\TeleBot\Interfaces\TelegramMethod;
use WeStacks\TeleBot\Objects\InputFile;
use WeStacks\TeleBot\Objects\Stickers\MaskPosition;

class AddStickerToSetMethod extends TelegramMethod
{
    protected function request()
    {
        return [
            'type'      => 'POST',
            'url'       => "https://api.telegram.org/bot{$this->token}/addStickerToSet",
            'send'      => $this->send(),
            'expect'    => 'boolean'
        ];
    }

    private function send()
    {
        $parameters = [
            'user_id'                   => 'integer',
            'name'                      => 'string',
            'png_sticker'               => InputFile::class,
            'tgs_sticker'               => InputFile::class,
            'emojis'                    => 'string',
            'mask_position'             => MaskPosition::class
        ];

        $object = TypeCaster::castValues($this->arguments[0] ?? [], $parameters);
        return [ 'multipart' => TypeCaster::flatten($object) ];
    }
}
