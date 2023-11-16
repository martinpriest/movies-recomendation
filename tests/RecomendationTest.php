<?php

use PHPUnit\Framework\TestCase;
use Askspot\Movies\Algorithms\Recomendation;

class RecomendationTest extends TestCase {
    private Recomendation $moviesRecomendation;

    private array $testMovies = [
        "Pulp Fiction",
        "Incepcja",
        "Skazani na Shawshank",
        "Dwunastu gniewnych ludzi",
        "Ojciec chrzestny",
        "Django",
        "Matrix",
        "Leon zawodowiec",
        "Siedem",
        "Nietykalni",
        "Władca Pierścieni: Powrót króla",
        "Fight Club",
        "Forrest Gump",
        "Chłopaki nie płaczą",
        "Gladiator",
        "Człowiek z blizną",
        "Pianista",
        "Doktor Strange",
        "Szeregowiec Ryan",
        "Lot nad kukułczym gniazdem",
        "Wielki Gatsby",
        "Avengers: Wojna bez granic",
        "Życie jest piękne",
        "Pożegnanie z Afryką",
        "Szczęki",
        "Milczenie owiec",
        "Dzień świra",
        "Blade Runner",
        "Labirynt",
        "Król Lew",
        "La La Land",
        "Whiplash",
        "Wyspa tajemnic",
        "Django",
        "American Beauty",
        "Szósty zmysł",
        "Gwiezdne wojny: Nowa nadzieja",
        "Mroczny Rycerz",
        "Władca Pierścieni: Drużyna Pierścienia",
        "Harry Potter i Kamień Filozoficzny",
        "Green Mile",
        "Iniemamocni",
        "Shrek",
        "Mad Max: Na drodze gniewu",
        "Terminator 2: Dzień sądu",
        "Piraci z Karaibów: Klątwa Czarnej Perły",
        "Truman Show",
        "Skazany na bluesa",
        "Infiltracja",
        "Gran Torino",
        "Spotlight",
        "Mroczna wieża",
        "Rocky",
        "Casino Royale",
        "Drive",
        "Piękny umysł",
        "Władca Pierścieni: Dwie wieże",
        "Zielona mila",
        "Requiem dla snu",
        "Forest Gump",
        "Requiem dla snu",
        "Milczenie owiec",
        "Czarnobyl",
        "Breaking Bad",
        "Nędznicy",
        "Seksmisja",
        "Pachnidło",
        "Nagi instynkt",
        "Zjawa",
        "Igrzyska śmierci",
        "Kiler",
        "Siedem dusz",
        "Dzień świra",
        "Upadek",
        "Lśnienie",
        "Pan życia i śmierci",
        "Gladiator",
        "Granica",
        "Hobbit: Niezwykła podróż",
        "Pachnidło: Historia mordercy",
        "Wielki Gatsby",
        "Titanic",
        "Sin City",
        "Przeminęło z wiatrem",
        "Królowa śniegu",
    ];

    protected function setUp(): void
    {
        $this->moviesRecomendation = new Recomendation($this->testMovies);
    }

    // case 1: Zwracane są 3 losowe tytuły.
    public function testReturnedMoviesEqualCount()
    {
        $expectedCount = 3;
        $result = $this->moviesRecomendation
            ->getRandomMovies($expectedCount)
            ->getMovies();
        $this->assertCount($expectedCount, $result);
    }

    // case 2: Zwracane są wszystkie filmy na literę 'W' ale tylko jeśli mają parzystą liczbę znaków w tytule.
    public function testReturnedValuesStartWithCharacter()
    {
        $startWith = "W";
        $result = $this->moviesRecomendation
            ->filterByText($startWith)
            ->getMovies();
        foreach ($result as $movie) {
            $this->assertStringStartsWith('W', $movie);
        }
    }

    public function testReturnedValuesAlwaysEven()
    {
        $result = $this->moviesRecomendation
            ->filterParityNames(true)
            ->getMovies();
        foreach($result as $movie) {
            $this->assertEquals(0, strlen($movie) % 2);
        }
    }

    public function testReturnedValuesStartWithCharacterAndNameLengthEven()
    {
        $startWith = "W";
        $result = $this->moviesRecomendation
            ->filterByText($startWith)
            ->filterParityNames(true)
            ->getMovies();
        foreach ($result as $movie) {
            $this->assertStringStartsWith('W', $movie);
            $this->assertEquals(0, strlen($movie) % 2);
        }
    }

    // case 3: Zwracany są wszystkie tytuły, które składają się z więcej niż 1 słowa.
    public function testReturnedValuesWordCountMoreThanOne()
    {
        $result = $this->moviesRecomendation
            ->filterByMoreThanOneWord()
            ->getMovies();
        foreach($result as $movie) {
            $this->assertStringContainsString(' ', $movie);
        }
    }
}
