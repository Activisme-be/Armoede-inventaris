<?php

namespace App\Markdown;

/**
 * Interface Converter
 *
 * @package App\Markdown
 */
interface Converter
{
    /**
     * Method for converting the markdown string to HTML.
     *
     * @param  string $markdown The markdown string
     * @return string
     */
    public function toHtml(string $markdown): string;
}
