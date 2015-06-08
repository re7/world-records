<?php

namespace App\Component\Run\Thumbnailer;

/**
 * Find thumbnails URL for run links
 */
interface ThumbnailerInterface
{
    /**
     * Find a thumbnail URL for the given link
     *
     * @param string $link
     *
     * @return string|null
     */
    public function find($link);
}
