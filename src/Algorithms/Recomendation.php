<?php

namespace Askspot\Movies\Algorithms;

class Recomendation {
    private array $originalItems = [];
    private array $modifiedItems = [];

    public function __construct(array $items) {
        $this->originalItems = $items;
        $this->modifiedItems = array_unique($items);
    }

    public function getRandomItems(int $count): self
    {
        if ($count > count($this->modifiedItems)) {
            $count = count($this->modifiedItems);
        }

        $keys = array_rand($this->modifiedItems, $count);
        $this->modifiedItems = array_intersect_key($this->modifiedItems, array_flip($keys));
        return $this;
    }

    public function filterByText(string $text): self
    {
        $this->modifiedItems = array_filter($this->modifiedItems, function ($item) use ($text) {
            return stripos($item, $text) === 0;
        });
        return $this;
    }

    public function filterParityNames(bool $parity = true): self
    {
        $this->modifiedItems = array_filter($this->modifiedItems, function ($item) use ($parity) {
            return (strlen($item) % 2 === 0) === $parity;
        });
        return $this;
    }

    public function filterByMoreThanWordCount(int $count = 1): self
    {
        if($count < 1) $count = 1;
        $this->modifiedItems = array_filter(
            $this->modifiedItems,
            fn ($item) => str_word_count($item) > $count && str_contains($item, ' ')
        );
        return $this;
    }
    
    public function getInitalItems(): array
    {
        return $this->originalItems;
    }

    public function getItems(): array
    {
        return $this->modifiedItems;
    }
}
