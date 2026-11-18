<?php
require_once 'Listie.php';
class Day implements JsonSerializable //todo put these mfs in a fucking list istg echo date('d.m.Y');
{
    public DateTime $date; //d.m.Y year
    public ?Day $previousDay;
    public ?Day $nextDay;
    public Listie $listOfNotes;

    public function __construct(DateTime $date, ?Day $previous = null, ?Day $next = null, ?Listie $listOfNotes = null)

    {
        $this->date = $date;
        $this->previousDay = $previous;
        $this->nextDay = $next;
        $this->listOfNotes = $listOfNotes ?? new Listie();
    }
    public function jsonSerialize(): array
    {
        return [
            'date' => $this->date->format('d.m.Y'),
            'previousDay' => $this->previousDay?->date,
            'nextDay' => $this->nextDay?->date,
            'listOfNotes' => $this->listOfNotes->jsonSerialize(),
               ];
    }

    public function dateText(): string
    {
        return $this->date->format('d.m.Y');
    }
}