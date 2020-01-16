<?php

namespace SteveGrunwell\WPAnalysis\Sniffs\WordPress\PHP\DiscouragedPHPFunctions;

use SteveGrunwell\WPAnalysis\Sniffs\Sniff;

class serialize_serialize extends Sniff
{
    /**
     * @var string A user-friendly name for the sniff.
     */
    protected $name = 'Avoid PHP serialization';

    /**
     * @var string A description of why the sniff is important.
     */
    protected $description = 'Serialized data has known vulnerability problems with Object Injection. JSON is generally a better approach for serializing data.';

    /**
     * @var array One or more URLs with relevant documentation.
     */
    protected $resources = [
        'https://www.owasp.org/index.php/PHP_Object_Injection',
    ];

    /**
     * @var string The category for the sniff.
     */
    protected $category = 'security';
}