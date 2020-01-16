<?php

namespace SteveGrunwell\WPAnalysis;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Reports\Report as ReportInterface;
use SteveGrunwell\WPAnalysis\Sniffs\Sniff;

class Report implements ReportInterface
{
    /**
     * @var array
     */
    protected $violations = [];

    /**
     * @var array
     */
    protected $categoryHeadings = [
        'compatibility' => 'PHP Compatibility Issues',
        'security'      => 'Security Concerns',
        'performance'   => 'Performance Concerns',
        'misc'          => 'Additional Concerns',
    ];

    /**
     * Generate a partial report for a single processed file.
     *
     * Function should return TRUE if it printed or stored data about the file
     * and FALSE if it ignored the file. Returning TRUE indicates that the file and
     * its data should be counted in the grand totals.
     *
     * @param array                 $report      Prepared report data.
     * @param \PHP_CodeSniffer\File $phpcsFile   The file being reported on.
     * @param bool                  $showSources Show sources?
     * @param int                   $width       Maximum allowed line width.
     *
     * @return bool
     */
    public function generateFileReport($report, File $phpcsFile, $showSources = false, $width = 80): bool
    {
        foreach ($report['messages'] as $line => $lineErrors) {
            foreach ($lineErrors as $column => $colErrors) {
                foreach ($colErrors as $error) {
                    $this->addViolation($error['source'], $report['filename'], $line, $column);
                }
            }
        }

        return true;
    }


    /**
     * Generate the actual report.
     *
     * @param string $cachedData    Any partial report data that was returned from
     *                              generateFileReport during the run.
     * @param int    $totalFiles    Total number of files processed during the run.
     * @param int    $totalErrors   Total number of errors found during the run.
     * @param int    $totalWarnings Total number of warnings found during the run.
     * @param int    $totalFixable  Total number of problems that can be fixed.
     * @param bool   $showSources   Show sources?
     * @param int    $width         Maximum allowed line width.
     * @param bool   $interactive   Are we running in interactive mode?
     * @param bool   $toScreen      Is the report being printed to screen?
     *
     * @return void
     */
    public function generate(
        $cachedData,
        $totalFiles,
        $totalErrors,
        $totalWarnings,
        $totalFixable,
        $showSources = false,
        $width = 80,
        $interactive = false,
        $toScreen = true
    ): void {
        $sections = [];

        foreach ($this->violations as $name => $files) {
            $sniff = $this->getSniffInstance($name, $files);

            if (! isset($sections[$sniff->getCategory()])) {
                $sections[$sniff->getCategory()] = [];
            }

            if (isset($sections[$sniff->getCategory()][$sniff->getRule()])) {
                $sections[$sniff->getCategory()][$sniff->getRule()]->merge($sniff);
            } else {
                $sections[$sniff->getCategory()][$sniff->getRule()] = $sniff;
            }
        }

        // @todo Sort to match $this->categoryHeadings

        foreach ($sections as $category => $sniffs) {
            echo PHP_EOL . '## ' . $this->getCategoryHeading($category) . PHP_EOL;

            foreach ($sniffs as $sniff) {
                $sniff->print();
            }
        }
    }

    /**
     * Add an instance of a failed sniff.
     *
     * @param string $sniff The sniff name.
     * @param string $file  The filename that contains the violation
     * @param int    $line  The line number.
     * @param int    $col   The column number.
     */
    protected function addViolation(string $sniff, string $file, int $line, int $col)
    {
        if (! isset($this->violations[$sniff])) {
            $this->violations[$sniff] = [];
        }

        if (! isset($this->violations[$sniff][$file])) {
            $this->violations[$sniff][$file] = [];
        }

        $this->violations[$sniff][$file][] = [
            'line' => $line,
            'col'  => $col,
        ];
    }

    /**
     * Determine the appropriate Sniff type, then return an instance of the class.
     *
     * @param string $sniff The sniff name.
     */
    protected function getSniffInstance(string $sniff, array $instances): Sniff
    {
        $basename   = __NAMESPACE__ . '\\Sniffs\\';
        $components = explode('.', $sniff);

        while (! empty($components)) {
            $class = $basename . implode('\\', $components);

            if (class_exists($class)) {
                return (new $class($instances))
                    ->setRule(implode('.', $components));
            }

            array_pop($components);
        }

        return (new Sniff($instances))
            ->setName($sniff)
            ->setRule($sniff);
    }

    /**
     * Get the matching category heading.
     *
     * @param string $category The category slug.
     */
    public function getCategoryHeading(string $category): string
    {
        return isset($this->categoryHeadings[$category]) ? $this->categoryHeadings[$category]: $category;
    }
}