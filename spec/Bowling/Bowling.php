<?php

namespace spec\Bowling;

use PHPSpec2\ObjectBehavior;

class Bowling extends ObjectBehavior
{
    function it_should_calculate_the_score_of_a_perfect_party()
    {
        $this->calculate('XXXXXXXXXXXX')->shouldReturn(300);
    }

    function it_should_calculate_the_score_of_a_party_with_spare_and_strike()
    {
        $this->calculate('5/X9-9-9-9-9-9-9-9-')->shouldReturn(101);
    }

    function it_should_calculate_the_score_of_a_party()
    {
        $this->calculate('9-9-9-9-9-9-9-9-9-9-')->shouldReturn(90);
    }

    function it_should_return_20_balls()
    {
        $this->parse('9-9-9-9-9-9-9-9-9-9-');
        $this->getBalls()->shouldHaveCount(20);
    }
}
