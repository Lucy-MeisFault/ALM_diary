<?php

class Listie implements JsonSerializable, ArrayAccess, IteratorAggregate
{
    public SplFixedArray $items;
    public int $count = 0;
    public function __construct()
    {
        $this->items = new SplFixedArray($this->count);
    }

    public function add(mixed $item): void
    {
        $newCount = $this->count + 1;
        $newItems = new SplFixedArray($newCount);

        for ($i = 0; $i < $this->count; $i++) {
            $newItems[$i] = $this->items[$i];
        }

        $newItems[$this->count] = $item;

        $this->items = $newItems;
        $this->count = $newCount;
    }
    public function remove(int $index): void
    {
        $newCount = $this->count - 1;
        $newItems = new SplFixedArray($newCount);
        $j = 0;
        for ($i = 0; $i < $this->count; $i++) {
            if ($i !== $index)
            {
                $newItems[$j] = $this->items[$i];
                $j++;
            }
        }
        $this->items = $newItems;
        $this->count = $newCount;
    }
    public function jsonSerialize(): array
    {

        $temp = [];

        for ($i = 0; $i < $this->count; $i++) {
            $temp[] = $this->items[$i]->jsonSerialize();
        }
        return $temp;
    }

    public function getIterator(): Iterator {
        for ($i = 0; $i < $this->count; $i++) yield $this->items[$i];
    }
    public function offsetExists(mixed $offset): bool
    {
        // TODO: Implement offsetExists() method.
        return false;
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->items[$offset];
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        // TODO: Implement offsetSet() method.
    }

    public function offsetUnset(mixed $offset): void
    {
        // TODO: Implement offsetUnset() method.
    }
}