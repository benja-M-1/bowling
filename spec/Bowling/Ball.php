<?php

namespace spec\Bowling;

use PHPSpec2\ObjectBehavior;

class Ball extends ObjectBehavior
{
    function it_should_have_a_value()
    {
        $this->beConstructedWith('5');
        $this->getValue()->shouldReturn('5');
    }

    function it_should_return_the_score_of_the_ball()
    {
        $this->beConstructedWith('5');
        $this->getScore()->shouldReturn(5);
    }

    function it_should_be_a_strike()
    {
        $this->beConstructedWith('X');
        $this->isStrike()->shouldBe(true);
    }

    function it_is_a_strike_and_it_should_return_a_score_of_10()
    {
        $this->beConstructedWith('X');
        $this->getScore()->shouldReturn(10);
    }

    function it_should_be_gutterball()
    {
        $this->beConstructedWith('-');
        $this->isGutterball()->shouldBe(true);
    }

    function it_is_a_gutterball_and_it_should_return_a_score_of_0()
    {
        $this->beConstructedWith('-');
        $this->getScore()->shouldReturn(0);
    }

    function it_should_be_a_spare()
    {
        $this->beConstructedWith('/');
        $this->isSpare()->shouldBe(true);
    }

    /**
     * @param \Bowling\Ball $ball
     */
    function it_is_a_spare_and_it_should_return_a_score_of_2($ball)
    {
        $ball->getTurn()->willReturn(1);
        $ball->getScore()->willReturn(8);
        $this->beConstructedWith('/', $ball);
        $this->getScore()->shouldReturn(2);
    }

    function it_should_be_the_first_ball_of_the_first_turn()
    {
        $this->beConstructedWith(1);
        $this->isFirst()->shouldBe(true);
        $this->getTurn()->shouldEqual(1);
    }

    /**
     * @param \Bowling\Ball $ball
     */
    function it_should_be_the_first_ball_of_the_second_turn($ball)
    {
        $ball->getTurn()->willReturn(1);
        $ball->isFirst()->willReturn(false);

        $this->beConstructedWith(1, $ball);
        $this->getTurn()->shouldEqual(2);
        $this->isFirst()->shouldBe(true);
    }

    /**
     * @param \Bowling\Ball $ball
     */
    function it_should_be_the_second_ball_of_the_eighth_turn($ball)
    {
        $ball->getTurn()->willReturn(8);
        $ball->isFirst()->willReturn(true);

        $this->beConstructedWith(1, $ball);
        $this->getTurn()->shouldEqual(8);
        $this->isFirst()->shouldBe(false);
    }

    /**
     * @param \Bowling\Ball $first
     * @param \Bowling\Ball $second
     */
    function it_should_return_a_score_of_30_with_the_result_XXX($first, $second)
    {
        $first->getScore()->willReturn(10);

        $second->getNext()->willReturn($first);
        $second->isStrike()->willReturn(true);
        $second->getScore()->willReturn(10);

        $this->BeConstructedWith('X');
        $this->setNext($second);

        $this->calculate()->shouldReturn(30);
    }

    /**
     * @param \Bowling\Ball $first
     * @param \Bowling\Ball $second
     */
    function it_should_return_a_score_of_13_with_the_result_X30($first, $second)
    {
        $first->getScore()->willReturn(0);

        $second->getNext()->willReturn($first);
        $second->isStrike()->willReturn(true);
        $second->getScore()->willReturn(3);

        $this->BeConstructedWith('X');
        $this->setNext($second);

        $this->calculate()->shouldReturn(13);
    }

    /**
     * @param \Bowling\Ball $ball
     */
    function it_should_be_bonus_turn($ball)
    {
        $ball->getTurn()->willReturn(9);
        $ball->isFirst()->willReturn(false);

        $this->beConstructedWith('1', $ball);
        $this->isBonus()->shouldBe(true);
    }
}
