<?php

declare(strict_types=1);

namespace Tests;

use Giuffre\Sprint\Sprint;
use PHPUnit\Framework\TestCase;

class SprintTest extends TestCase
{
    public function testSprintWithNamedParameters()
    {
        $result = Sprint::sprint(
            'Le mele sono %s[come] e di colore %s[colore]',
            ['colore' => 'verde'],
            ['come' => 'buone']
        );

        $this->assertEquals(
            'Le mele sono buone e di colore verde',
            $result
        );
    }

    public function testSprintWithNamedParametersArray()
    {
        $result = Sprint::sprint(
            'Le mele sono %s[come] e di colore %s[colore]',
            ['colore' => 'verde', 'come' => 'buone']
        );

        $this->assertEquals(
            'Le mele sono buone e di colore verde',
            $result
        );
    }

    public function testSprintWithRepeatedNamedParameters()
    {
        $result = Sprint::sprint(
            '%s[disciplina] è grande, %s[disciplina] è forte',
            ['disciplina' => 'Shaolin Kung Fu']
        );

        $this->assertEquals(
            'Shaolin Kung Fu è grande, Shaolin Kung Fu è forte',
            $result
        );
    }

    public function testSprintWithRepeatedTypedNamedParameters()
    {
        $result = Sprint::sprint(
            'Zero can be rendered as an integer (%d[number]) as well as a string ("%s[number]")',
            ['number' => 0]
        );

        $this->assertEquals(
            'Zero can be rendered as an integer (0) as well as a string ("0")',
            $result
        );
    }

    public function testSprintWithOverriddenNamedValues()
    {
        $result = Sprint::sprint(
            'Le mele sono %s[come] e di colore %s[colore]',
            ['colore' => 'verde'],
            ['come' => 'buone'],
            ['colore' => 'rosso']
        );

        $this->assertEquals(
            'Le mele sono buone e di colore rosso',
            $result
        );
    }

    public function testSprintWithOverriddenNamedValuesArray()
    {
        $result = Sprint::sprint(
            'Le mele sono %s[come] e di colore %s[colore]',
            ['colore' => 'verde', 'come' => 'buone', 'colore' => 'rosso']
        );

        $this->assertEquals(
            'Le mele sono buone e di colore rosso',
            $result
        );
    }
}
