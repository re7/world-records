<?php

namespace App\Bundle\MainBundle\Services\Run\Thumbnailer;

use App\Component\Run\Thumbnailer\ThumbnailerInterface;
use Guzzle\Http\ClientInterface;
use Guzzle\Http\Exception\ClientErrorResponseException;

/**
 * Find thumbnails from youtube video links
 */
class YoutubeThumbnailer implements ThumbnailerInterface
{
    /**
     * The web client used to fetch the URL content
     *
     * @var ClientInterface
     */
    private $client;

    /**
     * The Youtube API key
     *
     * @var string
     */
    private $apiKey;

    /**
     * __construct
     *
     * @param ClientInterface $client
     * @param string          $apiKey
     */
    public function __construct(ClientInterface $client, $apiKey)
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
    }

    /**
     * {@inheritdoc}
     */
    public function find($url)
    {
        $identifier = $this->retrieveIdentifier($url);
        if ($identifier !== null) {
            $request  = $this->client->get(
                'https://www.googleapis.com/youtube/v3/videos',
                [],
                [
                    'query' => [
                        'part' => 'snippet',
                        'key'  => $this->apiKey,
                        'id'   => $identifier,
                    ],
                ]
            );
            try {
                $response = $request->send();

                if ($response->isSuccessful()) {
                    $data      = $response->json();
                    $thumbnail = $data['items'][0]['snippet']['thumbnails']['default']['url'];

                    return $thumbnail;
                }
            } catch (ClientErrorResponseException $exception) {
            }
        }

        return null;
    }

    /**
     * Retrieve the youtube video identifier for the given URL
     *
     * @param string $url
     *
     * @return string|null
     */
    private function retrieveIdentifier($url)
    {
        $pattern = '/^(?:http(s)?:\/\/)?(?:www\.)?youtube\.com\/watch\?v=(?P<identifier>[\w-]+)$/';
        $matches = [];
        preg_match($pattern, $url, $matches);

        if (isset($matches['identifier'])) {
            return $matches['identifier'];
        }

        return null;
    }
}
