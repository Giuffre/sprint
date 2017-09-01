<?php
declare(strict_types=1);

use Giuffre\Sprint\Sprint;

if (!function_exists('sprint')) {
    /**
     * @author Angelo Giuffredi <agiuffredi@gmail.com>
     *
     * @param string $template
     * @param mixed[]|array ...$values
     * @return string
     */
    function sprint(string $template, ...$values): string
    {
        return Sprint::sprint($template, ...$values);
    }
}
