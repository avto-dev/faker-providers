<?php

namespace AvtoDev\FakerProviders\Providers\User;
use AvtoDev\FakerProviders\Providers\AbstractFakerProvider;

/**
 * @property-read string userAvatarUri
 */
class AvatarUriProvider extends AbstractFakerProvider
{

    /**
     * Api url placebeard.it.
     *
     * @link https://placebeard.it
     *
     * @var string
     */
    public static $avatar_url = 'https://placebeard.it';


    /**
     * Get link to user avatar.
     *
     * @param int $size
     *
     * @return string
     */
    public function userAvatarUri($size = 150)
    {
        return static::$avatar_url . '/' . $size;
    }

}

