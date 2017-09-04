<?php
declare(strict_types=1);

namespace Giuffre\Sprint\Error;

abstract class AbstractMalformedFragment extends \Exception
{
    protected static function fromTypeAndMatch(string $fragmentType, string $match)
    {
        return new static(
            sprintf(
                'Cannot extract parameter %s from match: %s',
                $fragmentType,
                $match
            )
        );
    }
}
