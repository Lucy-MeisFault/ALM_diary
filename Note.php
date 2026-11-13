<?php

class Note implements JsonSerializable //to be in the stupid arrays
{
    public int $position;
    public string $header; //maybe they'll want a headline on it lol
    public string $content;


    public function __construct(Day $day,  string $content, string $header = "") {
        $this->position = $day->getNoteCount();
        $this->header = $header;
        $this->content = $content;
    }
    public function jsonSerialize():array
    {
        return [
            "position" => $this->position,
            "header" => $this->header,
            "content" => $this->content
        ];
    }

}