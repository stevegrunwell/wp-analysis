<?php

namespace SteveGrunwell\WPAnalysis\Sniffs\WordPress\PHP;

use SteveGrunwell\WPAnalysis\Sniffs\Sniff;

class StrictComparisons extends Sniff
{
    /**
     * @var string A user-friendly name for the sniff.
     */
    protected $name = 'Use strict comparisons';

    /**
     * @var string A description of why the sniff is important.
     */
    protected $description = 'Avoid ambiguity and possible type mis-matches by using strict comparisons whenever possible.';

    /**
     * @var array One or more URLs with relevant documentation.
     */
    protected $resources = [
        'https://wpvip.com/documentation/vip-go/code-review-blockers-warnings-notices/#using-instead-of',
        'https://www.php.net/manual/en/language.operators.comparison.php',
    ];

    /**
     * @var string The category for the sniff.
     */
    protected $category = 'security';
}