<?php

namespace Askspot\Movies\Algorithms;

class Recomendation {
    private array $items = [];

    public function __construct(array $items) {
        $this->items = $items;
    }

    public function getRandomItems(int $count): self
    {
        if ($count > count($this->items)) {
            $count = count($this->items);
        }

        $keys = array_rand($this->items, $count);
        $this->items = array_intersect_key($this->items, array_flip($keys));
        return $this;
    }

    public function filterByText(string $text): self
    {
        $this->items = array_filter($this->items, function ($item) use ($text) {
            return stripos($item, $text) === 0;
        });
        return $this;
    }

    public function filterParityNames(bool $parity): self
    {
        $this->items = array_filter($this->items, function ($movie) use ($parity) {
            return (strlen($movie) % 2 === 0) === $parity;
        });
        return $this;
    }

    public function filterByMoreThanOneWord(): self
    {
        $this->items = array_filter($this->items, function ($item) {
            $wordCount = str_word_count($item);
            return $wordCount > 1 && str_contains($item, ' ');
        });
        return $this;
    }

    public function getItems(): array
    {
        return $this->items;
    }
}
