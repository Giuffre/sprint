<?php

declare(strict_types=1);

namespace Tests;

use Giuffre\Sprint\Sprint;
use PHPUnit\Framework\TestCase;

class Test extends TestCase
{
    public function testSprint()
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
}
