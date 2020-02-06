<?php

declare(strict_types = 1);

namespace AvtoDev\FakerProviders\Providers\User;

use AvtoDev\FakerProviders\Providers\AbstractFakerProvider;

/**
 * @property-read string $userAvatarUri
 */
class AvatarUriProvider extends AbstractFakerProvider
{
    /**
     * Generate link to random user avatar (can be salted).
     *
     * @param string|null|mixed $unique_salt Like username, email, or anything else
     * @param int               $width
     * @param int               $height
     *
     * @return string
     */
    public function userAvatarUri($unique_salt = null, $width = 200, $height = 200): string
    {
        $width     = (int) \abs($width);
        $height    = (int) \abs($height);
        $base_size = \max($width, $height);

        $unique_salt = $unique_salt === null
            ? self::bothify('??????#???')
            : \md5(\serialize($unique_salt));

        return "https://images.weserv.nl/?url=i.pravatar.cc/{$base_size}?u={$unique_salt}&w={$width}&h={$height}&t=square";
    }
}
