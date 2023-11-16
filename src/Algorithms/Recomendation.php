<?php

namespace Askspot\Movies\Algorithms;

class Recomendation {
    private array $movies = [];

    public function __construct(array $movies) {
        $this->movies = $movies;
    }

    public function getRandomMovies(int $count): self
    {
        if ($count > count($this->movies)) {
            $count = count($this->movies);
        }

        $keys = array_rand($this->movies, $count);
        $this->movies = array_intersect_key($this->movies, array_flip($keys));
        return $this;
    }

    public function filterByText(string $text): self
    {
        $this->movies = array_filter($this->movies, function ($movie) use ($text) {
            return stripos($movie, $text) === 0;
        });
        return $this;
    }

    public function filterParityNames(bool $parity): self
    {
        $this->movies = array_filter($this->movies, function ($movie) use ($parity) {
            return (strlen($movie) % 2 === 0) === $parity;
        });
        return $this;
    }

    public function filterByMoreThanOneWord(): self
    {
        $this->movies = array_filter($this->movies, function ($movie) {
            return str_word_count($movie) > 1;
        });
        return $this;
    }

    public function getMovies(): array
    {
        return $this->movies;
    }
}
