<?php

namespace Bowling;

/**
 * @author Benjamin Grandfond <benjamin.grandfond@gmail.com>
 */
class Ball
{
    const STRIKE = 'X';
    const SPARE  = '/';
    const GUTTERBALL = '-';

    const MAX_TURN = 10;

    /**
     * @var string The Value of the ball
     */
    protected $value;

    /**
     * The previous played ball.
     *
     * @var Ball
     */
    protected $previous;

    /**
     * The nex played ball.
     *
     * @var Ball
     */
    protected $next;

    /**
     * Whether the ball is the first or the second of the turn.
     *
     * @var bool
     */
    protected $isFirst;

    /**
     * The number of the turn.
     *
     * @var int
     */
    protected $turn;

    /**
     * @param mixed $value    The value of the ball (X, -, 1)
     * @param Ball  $previous
     */
    public function __construct($value, Ball $previous = null)
    {
        $this->value = $value;
        $this->turn  = 1;
        $this->isFirst = true;

        if (null !== $previous) {
            $this->setPrevious($previous);
        }
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param \Bowling\Ball $previous
     */
    public function setPrevious(Ball $previous)
    {
        $this->previous = $previous;

        if ($this->isStrike()) {
            $this->isFirst = true;
        } else {
            $this->isFirst = !$this->getPrevious()->isFirst();
        }

        $this->turn = $this->getPrevious()->getTurn() + (int) $this->isFirst();

        $previous->setNext($this);
    }

    /**
     * @return \Bowling\Ball
     */
    public function getPrevious()
    {
        return $this->previous;
    }

    /**
     * @param \Bowling\Ball $next
     */
    public function setNext($next)
    {
        $this->next = $next;
    }

    /**
     * @return \Bowling\Ball
     */
    public function getNext()
    {
        return $this->next;
    }

    /**
     * @return boolean
     */
    public function isFirst()
    {
        return $this->isFirst;
    }

    /**
     * @return int
     */
    public function getTurn()
    {
        return $this->turn;
    }

    /**
     * Return the ball score not the calculated one (use calculate instead).
     *
     * @return int
     */
    public function getScore()
    {
        if ($this->isStrike()) {
            return 10;
        }

        if ($this->isGutterball()) {
            return 0;
        }

        if ($this->isSpare() && $previous = $this->getPrevious()) {
            return 10 - $previous->getScore();
        }

        return (int) $this->getValue();
    }

    /**
     * @return bool
     */
    public function isStrike()
    {
        return $this->getValue() == self::STRIKE;
    }

    /**
     * @return bool
     */
    public function isGutterball()
    {
        return $this->getValue() == self::GUTTERBALL;
    }

    /**
     * @return bool
     */
    public function isSpare()
    {
        return $this->getValue() == self::SPARE;
    }

    /**
     * @return bool
     */
    public function isBonus()
    {
        return $this->getTurn() == self::MAX_TURN;
    }

    /**
     * Calculate the total of the ball.
     *
     * @return int
     */
    public function calculate()
    {
        $score = $this->getScore();

        /**
         * If it is a strike it adds the score of the two next balls.
         * If it is the last turn (the 10th), the player has two more
         * balls and the points are added to the 10th ball.
         */
        if ($this->isStrike()) {
            if ($this->turn <= self::MAX_TURN
                && ($firstAfter = $this->getNext()) instanceof Ball
                && ($secondAfter = $firstAfter->getNext()) instanceof Ball
            ) {
                $score += $firstAfter->getScore() + $secondAfter->getScore();
            } else {
                // Don't add the 11th and the 12nd balls.
                $score = 0;
            }
        }

        return $score;
    }
}
