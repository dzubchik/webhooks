<?php
declare(strict_types=1);


namespace Webhook\Domain\Infrastructure\Strategy;

/**
 * Class LinearStrategy.
 */
final class LinearStrategy extends AbstractStrategy implements SetOptionsInterface
{
    /** @var int */
    protected $interval;

    /** @var int */
    protected $multiplier;

    /**
     * @param int $interval
     * @param int $multiplier
     */
    public function __construct(int $interval = 5, int $multiplier = 1)
    {
        $this->setInterval($interval);
        $this->setMultiplier($multiplier);
    }

    /**
     * @param int $interval
     */
    public function setInterval($interval)
    {
        if (!is_int($interval) || (int) $interval < 0) {
            throw new \InvalidArgumentException('Interval should be positive integer');
        }

        $this->interval = (int) $interval;
    }

    /**
     * @param int $multiplier
     */
    public function setMultiplier($multiplier)
    {
        if (!is_int($multiplier) || $multiplier < 1) {
            throw new \InvalidArgumentException('Multiplier should be positive integer');
        }

        $this->multiplier = $multiplier;
    }

    /**
     *
     * @param int $attempt
     *
     * @return int
     */
    public function process(int $attempt): int
    {
        return $this->interval * $this->multiplier * $attempt;
    }
}