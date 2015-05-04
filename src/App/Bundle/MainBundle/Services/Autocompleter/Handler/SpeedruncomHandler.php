<?php

namespace App\Bundle\MainBundle\Services\Autocompleter\Handler;

use App\Bundle\MainBundle\Form\Model\Submission;
use App\Bundle\MainBundle\Services\Autocompleter\Exception\InvalidUrlException;
use Guzzle\Http\ClientInterface;

/**
 * Fetch data from a Speedrun.com run page
 */
class SpeedruncomHandler implements HandlerInterface
{
    /**
     * The web client used to fetch the URL content
     *
     * @var ClientInterface
     */
    private $client;

    /**
     * __construct
     *
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * {@inheritdoc}
     */
    public function fill(Submission $submission, $url)
    {
        throw new InvalidUrlException();
    }
}
