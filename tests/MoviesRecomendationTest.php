<?php

use PHPUnit\Framework\TestCase;
use Askspot\Movies\Algorithms\MoviesRecomendation;

class MoviesRecomendationTest extends TestCase {
    private MoviesRecomendation $moviesRecomendation;

    protected function setUp(): void
    {
        // Provide a path to a test file with an array of movies
        $this->moviesRecomendation = new MoviesRecomendation();
    }

    public function testGetRandomMovies()
    {
        $result = $this->moviesRecomendation->getMovies('firstCase');
        $this->assertEquals(200, $result['status']);
        $this->assertCount(3, $result['data']);
    }

    public function testFilterByText()
    {
        $result = $this->moviesRecomendation->getMovies('secondCase');
        $this->assertEquals(200, $result['status']);

        // Assert that all returned movies start with the letter 'W'
        foreach ($result['data'] as $movie) {
            $this->assertStringStartsWith('W', $movie);
        }
        $this->assertCount(7, $result['data']);
    }

    // You can also write tests to confirm that an exception is thrown for an undefined method
    public function testUndefinedMethod()
    {
        $result = $this->moviesRecomendation->getMovies('undefinedMethod');
        $this->assertEquals(400, $result['status']);
        $this->assertArrayHasKey('message', $result);
    }
}
