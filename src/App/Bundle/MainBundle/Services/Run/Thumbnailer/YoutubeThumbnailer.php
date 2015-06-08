<?php

namespace App\Bundle\MainBundle\Services\Run\Thumbnailer;

use App\Component\Run\Thumbnailer\ThumbnailerInterface;

/**
 * Find thumbnails from youtube video links
 */
class YoutubeThumbnailer implements ThumbnailerInterface
{
    /**
     * {@inheritdoc}
     */
    public function find($link)
    {
        // @TODO Call the Youtube API to retrieve the thumbnail
        return null;
    }
}
