<?php

namespace SteveGrunwell\WPAnalysis\Sniffs\WordPress\Security;

use SteveGrunwell\WPAnalysis\Sniffs\Sniff;

class EscapeOutput extends Sniff
{
    /**
     * @var string A user-friendly name for the sniff.
     */
    protected $name = 'Escape all output';

    /**
     * @var string A description of why the sniff is important.
     */
    protected $description = 'All output should be late-escaped to prevent cross-site scripting.';

    /**
     * @var array One or more URLs with relevant documentation.
     */
    protected $resources = [
        'https://wpvip.com/documentation/vip-go/validating-sanitizing-and-escaping/#escaping-securing-output',
    ];

    /**
     * @var string The category for the sniff.
     */
    protected $category = 'security';
}