<?php

namespace App\Bundle\MainBundle\Services\Autocompleter;

use App\Bundle\MainBundle\Form\Model\Submission;
use App\Bundle\MainBundle\Services\Autocompleter\Exception\InvalidUrlException;
use App\Bundle\MainBundle\Services\Autocompleter\Handler\HandlerInterface;
use App\Component\Clock\Clock;

/**
 * An implementation of the AutocompleterInterface using a list of known
 * handlers, each testing the given URL to fetch data
 */
class BusAutocompleter implements AutocompleterInterface
{
    /**
     * The application's clock
     *
     * @var Clock
     */
    private $clock;

    /**
     * The list of known URL handlers
     *
     * @var HandlerInterface[]
     */
    private $handlers;

    /**
     * __construct
     *
     * @param Clock $clock
     */
    public function __construct(Clock $clock)
    {
        $this->clock    = $clock;
        $this->handlers = [];
    }

    /**
     * {@inheritdoc}
     */
    public function autocomplete($url)
    {
        $submission = new Submission();
        $submission
            ->setPlayerName('')
            ->setPlayerLink('')
            ->setGame('')
            ->setCategory('')
            ->setLink('')
            ->setPlatform('')
            ->setTime('')
            ->setDate($this->clock->now())
        ;

        foreach ($this->handlers as $handler) {
            try {
                $handler->fill($submission, $url);
                break;
            } catch (InvalidUrlException $exception) {
            }
        }

        return $submission;
    }

    /**
     * Register the given handler in the known list
     *
     * @param HandlerInterface $handler
     */
    public function register(HandlerInterface $handler)
    {
        $this->handlers[] = $handler;
    }
}
