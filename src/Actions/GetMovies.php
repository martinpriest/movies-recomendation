<?php

namespace Askspot\Movies\Actions;

use Askspot\Movies\Algorithms\Recomendation;
use Askspot\Movies\Enums\RecomendationMethod;

class GetMovies {
    private Recomendation $recomendation;

    public function __construct(array $items) {
        $this->recomendation = new Recomendation($items);
    }

    private function handle(RecomendationMethod $method): array
    {
        switch ($method) {
            case RecomendationMethod::RANDOM:
                return $this->recomendation->getRandomItems(3)->getItems();
            
            case RecomendationMethod::STARTS_WITH_W_AND_EVEN:
                return $this->recomendation
                    ->filterByText('W')
                    ->filterParityNames(true)
                    ->getItems();
            
            case RecomendationMethod::MORE_THAN_ONE_WORD:
                return $this->recomendation->filterByMoreThanWordCount()->getItems();
        }
    }

    public function get(RecomendationMethod $method): array
    {
        return $this->handle($method);
    }
}
