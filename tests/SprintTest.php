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
