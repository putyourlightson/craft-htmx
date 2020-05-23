<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\htmx\variables;

class HtmxVariable
{
    /**
     * Returns the active element ID
     *
     * @return string
     */
    public function getId(string $default = ''): string
    {
        return '';
    }

    /**
     * Returns the active element name
     *
     * @return string
     */
    public function getName(string $default = ''): string
    {
        return '';
    }

    /**
     * Returns the active element value
     *
     * @return string
     */
    public function getValue(string $default = ''): string
    {
        return '';
    }
}
