<?php
namespace Bowling;

/**
 * Bowling description
 *
 * @author Benjamin Grandfond <benjamin.grandfond@gmail.com>
 */
class Bowling
{
    /**
     * Collection of balls.
     *
     * @var array
     */
    protected $balls = array();

    /**
     * The score of the game.
     *
     * @var int
     */
    protected $score;

    /**
     * Calculate the result of the game.
     *
     * @param $result
     *
     * @return int
     */
    public function calculate($result)
    {
        $this->parse($result);

        foreach ($this->balls as $ball) {
            $this->score += $ball->calculate();
        }

        return $this->score;
    }

    public function parse($result)
    {
        $values = str_split($result, 1);

        foreach ($values as $key => $value)
        {
            $ball = new Ball($value);

            if ($key > 0) {
                $ball->setPrevious($this->balls[$key - 1]);
            }

            $this->balls[$key] = $ball;
        }
    }

    /**
     * @return array
     */
    public function getBalls()
    {
        return $this->balls;
    }
}
