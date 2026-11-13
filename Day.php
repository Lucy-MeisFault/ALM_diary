<?php

class Day implements JsonSerializable //todo put these mfs in a fucking list istg date('l jS\; F Y');
{
    public string $date; //day month; year


    public ?Day $previousDay;

    public ?Day $nextDay;
    public SplFixedArray $listOfNotes;

    public function __construct(string $date, ?Day $previous = null, ?Day $next = null, ?SplFixedArray $listOfNotes = null) {
        $this->date = $date;
        $this->previousDay = $previous;
        $this->nextDay = $next;
        $this->listOfNotes = $listOfNotes ?? new SplFixedArray(4);
    }
    public function getNoteCount(): int
    {
        $i = 0;
        foreach ($this->listOfNotes as $note) {
            if ($note != null)
            {

                $i++;
            }
        }
    return $i;
    }
    public function jsonSerialize(): array
    {
        return [
            'date' => $this->date,
            'previousDay' => $this->previousDay?->date,
            'nextDay' => $this->nextDay?->date,
            'listOfNotes' => $this->listOfNotes->jsonSerialize(),
               ];
    }
}