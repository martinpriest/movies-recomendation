<?php

namespace Askspot\Movies\Algorithms;

class MoviesRecomendation {
    private array $movies = [
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

    public function __construct() {
    }

    private function getRandomMovies(int $count): array
    {
        $keys = array_rand($this->movies, $count);
        return array_intersect_key($this->movies, array_flip($keys));
    }

    private function filterByText(string $text): array
    {
        return array_filter($this->movies, function ($movie) use ($text) {
            return stripos($movie, $text) === 0;
        });
    }

    private function filterParityNames(bool $parity): array
    {
        return array_filter($this->movies, function ($movie) use ($parity) {
            return (strlen($movie) % 2 === 0) === $parity;
        });
    }

    private function handle(string $method): array
    {
        $response = [];

        if($method === 'firstCase') {
            $response = $this->getRandomMovies(3);
        } else if ($method === 'secondCase') {
            $response = $this->filterByText("W");
        } else if( $method === 'thirdCase') {
            $response = [];
        } else {
            throw new \BadMethodCallException("The method $method does not exist.");
        }

        return $response;
    }

    public function getMovies(string $method = ''): array
    {
        if (empty($method)) {
            return $this->movies;
        }

        try {
            $response = [
                'status' => 200, 
                'data' => $this->handle($method)
            ];

            return $response;
        } catch (\Throwable $th) {
            return [
                'status' => 400,
                'message' => $th->getMessage()
            ];
        }
    }
}
