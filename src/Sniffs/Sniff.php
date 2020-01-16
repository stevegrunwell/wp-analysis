<?php

namespace SteveGrunwell\WPAnalysis\Sniffs;

class Sniff
{
    /**
     * @var string A user-friendly name for the sniff.
     */
    protected $name;

    /**
     * @var string A description of why the sniff is important.
     */
    protected $description;

    /**
     * @var string The category for the sniff.
     */
    protected $category = 'misc';

    /**
     * @var array One or more URLs with relevant documentation.
     */
    protected $resources = [];

    /**
     * @var string The PHP_CodeSniffer rule this class represents.
     */
    private $rule;

    /**
     * @var array
     */
    protected $instances = [];

    /**
     * Create a new instance of the Sniff.
     *
     * @param array $instances An array of violations for this sniff. This should be in the format:
     *
     *     ['filename.php'] => [
     *         [
     *             'line' => 5,
     *             'col'  => 2,
     *         ],
     *     ]
     */
    public function __construct(array $instances)
    {
        $this->instances = $instances;
    }

    /**
     * Get the category for the sniff.
     */
    public function getCategory(): string
    {
        return (string) $this->category;
    }

    /**
     * Get the description for the sniff.
     */
    public function getDescription(): string
    {
        return (string) $this->description;
    }

    /**
     * Get violations for the current sniff.
     */
    public function getInstances(): array
    {
        return $this->instances;
    }

    /**
     * Get the name for the sniff.
     */
    public function getName(): string
    {
        return (string) $this->name;
    }

    /**
     * Get resources for the current sniff.
     */
    public function getResources(): array
    {
        return $this->resources;
    }

    /**
     * Get resources for the current sniff.
     */
    public function getRule(): string
    {
        return $this->rule;
    }

    /**
     * Set the name for the sniff.
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set the rule for the sniff.
     */
    public function setRule(string $rule): self
    {
        $this->rule = $rule;

        return $this;
    }

    /**
     * Print the sniff report.
     */
    public function print(): void
    {
        echo PHP_EOL . '### ' . $this->getName() . PHP_EOL . PHP_EOL;

        if ($this->getDescription()) {
            echo $this->getDescription() . PHP_EOL . PHP_EOL;
        }

        if (! empty($this->getResources())) {
            echo 'Further reading:' . PHP_EOL;
            foreach ($this->getResources() as $resource) {
                echo '* ' . $resource . PHP_EOL;
            }
            echo PHP_EOL;
        }

        echo '#### Occurrences' . PHP_EOL . PHP_EOL;

        foreach ($this->instances as $filename => $instance) {
            foreach ($instance as $line) {
                printf('- %1$s:%2$d,%3$d', $filename, $line['line'], $line['col']);
                echo PHP_EOL;
            }
        }
    }

    /**
     * Merge another instance of a sniff into this one.
     */
    public function merge(Sniff $sniff): self
    {
        $this->instances += $sniff->getInstances();

        return $this;
    }
}