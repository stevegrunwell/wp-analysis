<?php

namespace SteveGrunwell\WPAnalysis\Sniffs\PHPCompatibility\ParameterValues;

use SteveGrunwell\WPAnalysis\Sniffs\Sniff;

class RemovedPCREModifiers extends Sniff
{
    /**
     * @var string A user-friendly name for the sniff.
     */
    protected $name = 'Illegal RegEx modifier';

    /**
     * @var string A description of why the sniff is important.
     */
    protected $description = 'The `/e` modifier was deprecated in PHP 5.5 and removed in PHP 7.0.';

    /**
     * @var array One or more URLs with relevant documentation.
     */
    protected $resources = [
        'https://www.php.net/manual/en/reference.pcre.pattern.modifiers.php',
    ];

    /**
     * @var string The category for the sniff.
     */
    protected $category = 'compatibility';
}