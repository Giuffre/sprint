<?php
declare(strict_types=1);

namespace Giuffre\Sprint\Error;

class MalformedType extends AbstractMalformedFragment
{
    public static function fromMatch(string $match): self
    {
        return static::fromTypeAndMatch('type', $match);
    }
}
