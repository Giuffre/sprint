<?php
declare(strict_types=1);

namespace Giuffre\Sprint\Error;

class MissingValues extends \Error
{
    public static function forParameters(string ...$names): self
    {
        $plural = count($names) === 1 ? '' : 's';
        $parameters = count($names) > 0
            ? sprintf(' "%s"', implode('", "', $names))
            : '';

        return new static(
            sprintf(
                'Missing value%s for parameter%s%s',
                $plural,
                $plural,
                $parameters
            )
        );
    }
}
