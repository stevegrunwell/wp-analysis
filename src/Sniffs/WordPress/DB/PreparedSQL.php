<?php

namespace SteveGrunwell\WPAnalysis\Sniffs\WordPress\DB;

use SteveGrunwell\WPAnalysis\Sniffs\Sniff;

class PreparedSQL extends Sniff
{
    /**
     * @var string A user-friendly name for the sniff.
     */
    protected $name = 'Use prepared statements for database queries';

    /**
     * @var string A description of why the sniff is important.
     */
    protected $description = 'Direct database queries should use prepared statements, via `$wpdb->prepare()`.';

    /**
     * @var array One or more URLs with relevant documentation.
     */
    protected $resources = [
        'https://codex.wordpress.org/Class_Reference/wpdb#Protect_Queries_Against_SQL_Injection_Attacks',
    ];

    /**
     * @var string The category for the sniff.
     */
    protected $category = 'security';
}