<?php
require_once 'Listie.php';
class Note implements JsonSerializable
{
    public string $header;
    public string $content;
    public function __construct(string $content, string $header = "") {
        $this->header = $header;
        $this->content = $content;
    }
    public function jsonSerialize():array
    {
        return [
            "header" => $this->header,
            "content" => $this->content
        ];
    }

}