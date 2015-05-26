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
        return preg_match('/^(http?:\/\/)?www\.speedrun\.com\/run\/(\d+)$/', $url);
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

        list($playerName, $playerLink) = $this->getPlayerData($crawler);
        $title = $crawler->filter('#titleheader')->text();
        $description = $crawler->filter('main .maincontent h2')->eq(0)->text();
        list($category, $time) = $this->parseDescription($description);
        $note = $crawler->filter('main .maincontent .note')->text();
        list($platform, $date) = $this->parseNote($note);
        $link = $this->getVideoLink($crawler);

        $submission->setPlayerName($playerName);
        $submission->setPlayerLink($playerLink);
        $submission->setGame($title);
        $submission->setCategory($category);
        $submission->setLink($link);
        $submission->setTime($time);
        $submission->setPlatform($platform);
        if ($date !== null) {
            $submission->setDate($date);
        }
    }

    /**
     * Retrieve the player's name and profile URL
     *
     * @param Crawler $crawler
     *
     * @return array
     */
    private function getPlayerData(Crawler $crawler)
    {
        $linkNode = $crawler->filter('main .maincontent h2')->eq(1)->filter('a')->first()->getNode(0);
        if ($linkNode) {
            $username  = $crawler->filter('main .maincontent h2')->eq(1)->filter('span')->eq(1)->text();
            $link      = sprintf('http://www.speedrun.com/user/%s', $username);
            $twitchUrl = $this->retrieveProfile($link);

            return [
                ucfirst($username),
                ($twitchUrl ?: $link),
            ];
        }

        return [
            ucfirst($crawler->filter('main .maincontent h2')->eq(1)->text()),
            '',
        ];
    }

    /**
     * Retrieve the URL of the twitch video used as proof if there is one
     *
     * @param Crawler $crawler
     *
     * @return string
     */
    private function getVideoLink(Crawler $crawler)
    {
        $twitchNode = $crawler->filter('main .maincontent object.twitch param[name=flashvars]')->first()->getNode(0);
        if ($twitchNode) {
            $info = $twitchNode->getAttribute('value');
            $pattern = '/^channel=(?P<channel>\w+)(?:&\w+=\w+)+&(?:(?:videoId=v(?P<video>\d+))|(?:chapter_id=(?P<chapter>\d+)))$/';
            $matches = [];
            preg_match($pattern, $info, $matches);

            $channel = $matches['channel'];
            $url = ($matches['video'] !== '' ? 'v/'.$matches['video'] : 'c/'.$matches['chapter']);

            return sprintf('http://www.twitch.tv/%s/%s', $channel, $url);
        }

        return '';
    }

    /**
     * Parse the description string to retrieve the category and the time
     *
     * @param string $description
     *
     * @return array
     */
    private function parseDescription($description)
    {
        $pattern = '/^(?P<category>.*)\s+in\s+(?:(?P<hour>\d+)h\s+)?(?:(?P<minute>\d+)m\s+)?(?:(?P<second>\d+)s\s+)(?:(?P<milli>\d+)ms\s+)?(?:\*\s+)?by:$/';
        $matches = [];
        preg_match($pattern, $description, $matches);

        $category = $matches['category'];
        $hour = isset($matches['hour']) ? $matches['hour'] : 0;
        $minute = isset($matches['minute']) ? $matches['minute'] : 0;
        $second = $matches['second'];
        $milli = isset($matches['milli']) ? $matches['milli'] : null;

        $time = sprintf('%02d:%02d:%02d', $hour, $minute, $second);
        if ($milli !== null) {
            $time = sprintf('%s.%03d', $time, $milli);
        }

        return [$category, $time];
    }

    /**
     * Parse the note string to retrieve the platform and date
     *
     * @param string $note
     *
     * @return array
     */
    private function parseNote($note)
    {
        $pattern = '/^ Played on (?P<platform>[\w ]*)(?: \[\w+\] )?(?:on (?P<date>\d{4}-\d{2}-\d{2}))?\./';
        $matches = [];
        preg_match($pattern, $note, $matches);

        $platform = $matches['platform'];
        $date     = (isset($matches['date']) ? new \DateTime($matches['date']) : null);

        return [$platform, $date];
    }

    /**
     * Send a request to the user page to retrieve its most important social
     * profile URL (often it should be Twitch)
     *
     * @param string $url
     *
     * @return string|null
     */
    private function retrieveProfile($url)
    {
        $request  = $this->client->get($url);
        $response = $request->send();

        if ($response->getStatusCode() === 200) {
            $crawler = new Crawler($response->getBody(true));
            $firstProfile = $crawler->filter('main .sidemenu>div a')->eq(1);
            if ($firstProfile->getNode(0)) {
                return $firstProfile->attr('href');
            }
        }

        return null;
    }
}
