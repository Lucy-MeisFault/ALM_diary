<?php

class DayList
{
    public ?Day $first = null;
    public ?Day $last = null;
    public ?Day $currentDay = null;
    public int $count = 0;


    public function __construct(?Day $first = null, ?Day $last = null, ?Day $current = null)
    {
        $this->first = $first;
        $this->last = $last;
        $this->currentDay = $current;
        $this->count = 0;
    }
    public function add(Day $day): void
    {
        if ($this->last === null) {
            $this->first = $day;
            $this->currentDay = $day;
        }
        else {
            $this->last->nextDay = $day;
            $day->previousDay = $this->last;
        }
        $this->last = $day;
        $this->count += 1;
    }
    public function insertByDate(Day $day): Day
    {
        $node = $this->first;
        while ($node !== null && $node->date < $day->date) {
            $node = $node->nextDay;
        }

        if ($node !== null && $node->date == $day->date) {
            $this->currentDay = $node;
            return $node;
        }
        if ($node === null) {
            $this->add($day);
            $this->currentDay = $day;
            return $day;
        }
        $previous = $node->previousDay;
        $day->previousDay = $previous;
        $day->nextDay = $node;
        $node->previousDay = $day;
        if ($previous === null) {
            $this->first = $day;
        } else {
            $previous->nextDay = $day;}
        $this->count += 1;
        $this->currentDay = $day;
        return $day;
    }
    public function goToNext(): void
    {
        if ($this->currentDay !== null && $this->currentDay->nextDay !== null)
        $this->currentDay = $this->currentDay->nextDay;
    }
    public function goToPrevious(): void
    {

        if ($this->currentDay !== null && $this->currentDay->previousDay !== null)
    $this->currentDay = $this->currentDay->previousDay;
    }
    public function goToFirst(): void
    {
        if ($this->first !== null)
    $this->currentDay = $this->first;
    }
    public function goToLast(): void
    {
        if ($this->last !== null)
    $this->currentDay = $this->last;
    }
    public function removeCurrentDay(): void
    {
        $temp = $this->currentDay;
        if ($temp->previousDay !== null) {
            $temp->previousDay->nextDay = $temp->nextDay;
            $this->currentDay = $temp->previousDay;
        }
        if ($temp->nextDay !== null) {
            $temp->nextDay->previousDay = $temp->previousDay;
            $this->currentDay = $temp->nextDay;
        }

        if ($temp === $this->last) {
            $this->last = $this->currentDay;
        }
        if ($temp === $this->first) {
            $this->first = $this->currentDay;
        }
        $this->count -= 1;

        if ($temp === $this->last && $temp === $this->first) {
            $this->currentDay = null;
            $this->last = null;
            $this->first = null;
        }
    }

}
