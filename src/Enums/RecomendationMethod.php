<?php

namespace Askspot\Movies\Enums;

enum RecomendationMethod {
    case RANDOM;
    case STARTS_WITH_W_AND_EVEN;
    case MORE_THAN_ONE_WORD;
}
