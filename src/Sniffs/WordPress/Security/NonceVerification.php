<?php

namespace SteveGrunwell\WPAnalysis\Sniffs\WordPress\Security;

use SteveGrunwell\WPAnalysis\Sniffs\Sniff;

class NonceVerification extends Sniff
{
    /**
     * @var string A user-friendly name for the sniff.
     */
    protected $name = 'Use nonces for all forms';

    /**
     * @var string A description of why the sniff is important.
     */
    protected $description = 'Forms should use nonces to prevent replay attacks.';

    /**
     * @var array One or more URLs with relevant documentation.
     */
    protected $resources = [
        'https://developer.wordpress.org/plugins/security/nonces/',
    ];

    /**
     * @var string The category for the sniff.
     */
    protected $category = 'security';
}