<?php

namespace Sugarcrm\Sugarcrm\custom\wsystems\wReportsDashlet;

class LinkFixManager
{
    /**
     * Gets the cell from reports, and if the cell is string, looks up for the bwc link pattern, gets the module and
     * replaces the bwc link with a sidecar link
     *
     * @param string $cell is the value of the column in the table
     *
     * @return string
     */
    public function fixBwcLink(string $cell): string
    {
        if ($this->hasBwcLink($cell) === true) {
            $module = $this->getModule($cell);

            if (empty($module) === true) {
                return $cell; // if the module is not found in the cell, the the fix cannot be done
            }

            $bwcHref   = "index.php?action=DetailView&module={$module}&record=";
            $fixedHref = "#{$module}/";

            return str_replace(
                $bwcHref,
                $fixedHref,
                $cell
            );
        }

        return $cell;
    }

    /**
     * true - when the bwc pattern is found
     * false - when the bwc pattern is not found
     *
     * @param mixed $cell
     * @return bool
     */
    public function hasBwcLink($cell): bool
    {
        $bwcPattern = 'href="index.php?action=DetailView&module=';

        if (strpos($cell, $bwcPattern) !== false) {
            return true;
        }

        return false;
    }

    /**
     * if the bwc pattern is found, extracts and returns the module of the record from the string
     *
     * @param mixed $cell
     * @return string
     */
    private function getModule($cell): string
    {
        $start = "&module=";
        $end   = "&record";

        $string = ' ' . $cell;
        $ini    = strpos($string, $start);
        if ($ini == 0) {
            return '';
        }

        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;

        return substr($string, $ini, $len);
    }
}
