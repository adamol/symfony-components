<?php

namespace Calendar\Model;

class LeapYear
{
    private $year;

    public function __construct($year)
    {
        $this->year = $year;
    }

    public function isLeapYear() {
        if (null === $this->year) {
            $this->year = date('Y');
        }

        return 0 === $this->year % 400 || (0 === $this->year % 4 && 0 !== $this->year % 100);
    }
}
