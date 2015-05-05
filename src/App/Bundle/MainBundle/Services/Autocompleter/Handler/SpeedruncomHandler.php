<?php

namespace App\Bundle\MainBundle\Services\Autocompleter\Handler;

use App\Bundle\MainBundle\Form\Model\Submission;
use App\Bundle\MainBundle\Services\Autocompleter\Exception\InvalidUrlException;
use Guzzle\Http\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

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
        if ($this->match($url)) {
            $request  = $this->client->get($url);
            $response = $request->send();

            if ($response->getStatusCode() === 200) {
                $this->process($submission, $response->getBody(true));
            }
        }

        throw new InvalidUrlException();
    }

    /**
     * Test that the URL has the proper pattern
     *
     * @param string $url
     *
     * @return bool
     */
    private function match($url)
    {
        return preg_match('/^(http?:\/\/)?www\.speedrun\.com\/(\w+)\/run\/(\d+)$/', $url);
    }

    /**
     * Process the HTML content of the page and update the given submission
     *
     * @param Submission $submission
     * @param string     $content
     */
    private function process(Submission $submission, $content)
    {
        $crawler = new Crawler($content);

        $title = $crawler->filter('main .sidemenu h2')->text();
        $category = $crawler->filter('main .maincontent h2')->eq(0)->text();
        $playerName = ucfirst($crawler->filter('main .maincontent h2')->eq(1)->filter('span')->eq(1)->text());

        $submission->setGame($title);
        $submission->setPlayerName($playerName);
    }
}
