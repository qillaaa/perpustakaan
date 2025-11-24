<?php

namespace App\Traits;

// Import CISmarty untuk type hinting pada metode abstrak
use App\Libraries\CISmarty;

trait Viewable {

    /**
     * Abstract method to be implemented by the class using this trait.
     * It should return an instance of the Smarty engine (CISmarty).
     *
     * @return CISmarty
     */
    abstract protected function getSmartyEngine(): CISmarty;

    /**
     * Parses a template using the Smarty engine.
     *
     * @param string      $template         Template name, optionally namespaced (e.g., "Admin::dashboard").
     * @param array       $data             Data to pass to the template.
     * @param bool        $return           Whether to return the parsed content (TRUE) or display it (FALSE).
     * @param bool        $enableCallCaching Enable/disable caching specifically for this call.
     * @param string|null $cacheId          Optional Cache ID for this template.
     * @return string|null The rendered template as a string if $return is TRUE, otherwise null.
     */
    protected function parse(string $template, array $data = [], bool $return = false, bool $enableCallCaching = false, ?string $cacheId = null): ?string
    {
        $parser = $this->getSmartyEngine();
        return $parser->parse($template, $data, $return, $enableCallCaching, $cacheId);
    }

    /**
     * Checks if a specific template is cached.
     *
     * @param string      $template The template name (e.g., "main_page" or "Admin::dashboard").
     * @param string|null $cacheId  The cache ID.
     * @return bool True if cached, false otherwise.
     */
    protected function isCached(string $template, ?string $cacheId = null): bool
    {
        $parser = $this->getSmartyEngine();

        $templateResourceName = $template;

        $hasExtension = strpos($templateResourceName, '.') !== false;
        $isSmartyResource = strpos($templateResourceName, ':') !== false;

        if (!$hasExtension && !$isSmartyResource) {
            if (strpos($templateResourceName, '::') !== false) {
                [$namespace, $viewFilePart] = explode('::', $templateResourceName, 2);
                if (strpos($viewFilePart, '.') === false) {
                    $viewFilePart .= '.' . $parser->getTemplateExt();
                }
                $templateResourceName = $namespace . '::' . $viewFilePart;
            } else {
                $templateResourceName .= '.' . $parser->getTemplateExt();
            }
        }

        return $parser->isCached($templateResourceName, $cacheId);
    }
}
