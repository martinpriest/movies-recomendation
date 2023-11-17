<?php

use PHPUnit\Framework\TestCase;
use Askspot\Movies\Actions\GetMovies;
use Askspot\Movies\Enums\RecomendationMethod;

class GetMoviesTest extends TestCase {
    private GetMovies $moviesAction;

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
        $this->moviesAction = new GetMovies($this->testMovies);
    }

    // case 1: Zwracane są 3 losowe tytuły.
    public function testFirstMethodReturnThreeRandomValues()
    {
        $method = RecomendationMethod::RANDOM;
        $result = $this->moviesAction->get($method);
        $this->assertCount(3, array_unique($result));
    }

    // case 2: Zwracane są wszystkie filmy na literę 'W' ale tylko jeśli mają parzystą liczbę znaków w tytule.
    public function testSecondMethodStartsWithWAndEven()
    {
        $startWith = "W";
        $method = RecomendationMethod::STARTS_WITH_W_AND_EVEN;
        $result = $this->moviesAction->get($method);
        foreach ($result as $movie) {
            $this->assertStringStartsWith($startWith, $movie);
            $this->assertEquals(0, strlen($movie) % 2);
        }
    }

    // case 3: Zwracany są wszystkie tytuły, które składają się z więcej niż 1 słowa.
    public function testReturnedValuesWordCountMoreThanOne()
    {
        $method = RecomendationMethod::MORE_THAN_ONE_WORD;
        $result = $this->moviesAction->get($method);
        foreach($result as $movie) {
            $this->assertStringContainsString(' ', $movie);
        }
    }
}