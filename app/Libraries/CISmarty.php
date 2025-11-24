<?php

namespace App\Libraries;

use Config\Smarty as SmartyConfig; // Import a specific config class
use Smarty\Smarty;
use Smarty\Exception; // Import Exception for better error handling in fetchString
use RuntimeException; // For parse method errors

/**
 * CI Smarty
 *
 * Smarty templating for CodeIgniter 4.
 * Integrates Smarty with CodeIgniter's file location and configuration.
 *
 * @package   App\Libraries
 * @author    Dwayne Charrington (Original Concept), AKM Pedia Contributor (Modifications)
 * @copyright 2017 Dwayne Charrington and Github contributors, 2025 AKM Pedia
 * @license   MIT
 */
class CISmarty extends Smarty
{
    protected string $templateExt;
    protected array $templateLocations = [];
    protected SmartyConfig $config;

    /**
     * Constructor.
     * Initializes Smarty with configurations from SmartyConfig.
     *
     * @param SmartyConfig|null $config Optional configuration object.
     */
    public function __construct(?SmartyConfig $config = null)
    {
        parent::__construct();

        $this->config = $config ?? new SmartyConfig();

        // Set Smarty core properties from config
        $this->debugging = $this->config->smarty_debug ?? $this->config->debug ?? false; // Akomodasi nama properti yang berbeda
        $this->error_reporting = $this->config->template_error_reporting ?? $this->config->error_reporting ?? (E_ALL & ~E_NOTICE);

        // Set Smarty directories
        $this->setCompileDir($this->config->compile_directory);
        $this->setCacheDir($this->config->cache_directory);
        if (!empty($this->config->config_directory)) {
            $this->setConfigDir($this->config->config_directory);
        }

        // Default template extension
        $this->templateExt = $this->config->template_ext ?? 'tpl';

        // Global Caching settings from config (default for the instance)
        $currentEnvironment = defined('ENVIRONMENT') ? ENVIRONMENT : ($this->config->environment ?? 'production');

        if (($this->config->cache_status ?? false) === true && $currentEnvironment !== 'development') {
            $this->setCaching(Smarty::CACHING_LIFETIME_CURRENT);
            if (isset($this->config->cache_lifetime)) {
                $this->setCacheLifetime($this->config->cache_lifetime);
            }
        } else {
            $this->setCaching(Smarty::CACHING_OFF);
        }

        // Assign global constants/variables if necessary.
        // Example: Assign ADMIN_AREA if defined globally.
        // Consider if such globals are better passed via $data in parse() for context control.
        if (defined('ADMIN_AREA')) {
            $this->assign('ADMIN_AREA', ADMIN_AREA);
        }

        $this->setTemplateLocation(); // Initialize template paths from config
        $this->registerCustomPlugins(); // Register custom plugins/modifiers
    }

    /**
     * Parses a template using Smarty engine.
     *
     * @param string      $template         Template name, optionally namespaced (e.g., "Admin::dashboard" or "main_page").
     * @param array       $data             Data to pass to the template.
     * @param bool        $return           Whether to return the parsed content (TRUE) or display it (FALSE).
     * @param bool        $enableCallCaching Enable/disable caching specifically for this call.
     * @param string|null $cacheId          Optional Cache ID for this template.
     * @return string|null The rendered template as a string if $return is TRUE, otherwise null.
     * @throws RuntimeException If the template cannot be found or resolved.
     * @throws Exception For Smarty related errors during fetch/display.
     */
    public function parse(string $template, array $data = [], bool $return = false, bool $enableCallCaching = false, ?string $cacheId = null): ?string
    {
        // Backup and set per-call caching state
        $originalInstanceCachingType = $this->caching; // Access public property
        $originalInstanceCacheLifetime = $this->cache_lifetime; // Access public property

        $currentEnvironment = defined('ENVIRONMENT') ? ENVIRONMENT : ($this->config->environment ?? 'production');

        if ($enableCallCaching && $currentEnvironment !== 'development') {
            $this->setCaching(Smarty::CACHING_LIFETIME_CURRENT);
            // If you want per-call cache lifetime, it needs to be passed or configured
        } else {
            $this->setCaching(Smarty::CACHING_OFF);
        }

        $callFindView = true;
        $originalTemplateName = $template; // Keep original for error messages

        // Determine if findView should be called or if it's a Smarty resource string
        if (strpos($template, ':') !== false) {
            if (strpos($template, '::') !== false) { // Our Namespace::view syntax
                $callFindView = true;
            } else { // Smarty resource (e.g., "string:", "file:", "db:")
                $callFindView = false;
            }
        }

        if ($callFindView) {
            $resolvedPath = $this->findView($template);
            if ($resolvedPath === null) {
                // Restore caching state before throwing exception
                $this->setCaching($originalInstanceCachingType);
                $this->setCacheLifetime($originalInstanceCacheLifetime);
                throw new RuntimeException("Smarty template not found or could not be resolved: " . $originalTemplateName);
            }
            $template = $resolvedPath;
        }

        // Assign data to Smarty
        if (!empty($data)) {
            foreach ($data as $key => $val) {
                $this->assign((string)$key, $val);
            }
        }

        $output = null;
        try {
            if ($return === false) {
                $this->display($template, $cacheId);
                // $output remains null as display outputs directly
            } else {
                $output = $this->fetch($template, $cacheId);
            }
        } finally {
            // Restore instance's original caching state
            $this->setCaching($originalInstanceCachingType);
            $this->setCacheLifetime($originalInstanceCacheLifetime);
        }

        return $output;
    }

    /**
     * Finds the full path to a view file, handling namespaces.
     *
     * @param string $file The template file name, possibly namespaced (e.g., "Admin::dashboard").
     * @return string|null The full path to the file, or null if not found.
     */
    public function findView(string $file): ?string
    {
        $namespace = null;
        $viewFilePart = $file;

        if (strpos($file, '::') !== false) {
            [$namespace, $viewFilePart] = explode('::', $file, 2);
        }

        if (empty($viewFilePart)) return null; // Cannot be an empty file part

        // Append default template extension if not present
        if (strpos($viewFilePart, '.') === false) {
            $viewFilePart .= "." . $this->templateExt;
        }

        if ($namespace !== null) {
            if (isset($this->templateLocations[$namespace])) {
                $location = rtrim($this->templateLocations[$namespace], '/\\') . DIRECTORY_SEPARATOR;
                if (file_exists($location . $viewFilePart)) {
                    return $location . $viewFilePart;
                }
            }
        } else {
            foreach ($this->templateLocations as $locationPath) {
                if (is_string($locationPath)) {
                    $path = rtrim($locationPath, '/\\') . DIRECTORY_SEPARATOR;
                    if (file_exists($path . $viewFilePart)) {
                        return $path . $viewFilePart;
                    }
                }
            }
        }
        return null;
    }

    /**
     * Sets the template locations from configuration and optionally merges additional locations.
     *
     * @param array|null $additionalLocations Additional locations to merge.
     * @return void
     */
    public function setTemplateLocation(?array $additionalLocations = null): void
    {
        $this->templateLocations = $this->config->template_directory ?? [];

        if (is_array($additionalLocations)) {
            // array_replace preserves keys from the first array if they exist in the second,
            // and adds keys from the second if not in the first.
            // For simple override and addition, array_merge is also common.
            $this->templateLocations = array_merge($this->templateLocations, $additionalLocations);
        }
        $this->addPathsToSmarty();
    }

    /**
     * Adds the configured template paths to the Smarty instance.
     * Handles namespaced paths by registering them with their keys.
     *
     * @return void
     */
    protected function addPathsToSmarty(): void
    {
        $this->setTemplateDir([]); // Clear existing Smarty template directories

        foreach ($this->templateLocations as $key => $location) {
            if (is_string($location) && is_dir($location)) {
                if (is_string($key) && !is_numeric($key)) { // Namespaced path
                    $this->addTemplateDir($location, $key);
                } else { // Non-namespaced path
                    $this->addTemplateDir($location);
                }
            }
        }
    }

    /**
     * Parses a template string and returns the output.
     *
     * @param string      $templateString The template content as a string.
     * @param array       $data           Associative array of data to assign to the template.
     * @param string|null $cacheId        Optional cache ID for this specific string template.
     * @return string The parsed template content.
     * @throws Exception
     */
    public function fetchString(string $templateString, array $data = [], ?string $cacheId = null): string
    {
        if (!empty($data)) {
            foreach ($data as $key => $val) {
                $this->assign((string)$key, $val);
            }
        }
        // Untuk Smarty, resource string biasanya diawali dengan "string:"
        if (strpos($templateString, 'string:') !== 0) {
            $templateString = 'string:' . $templateString;
        }
        return $this->fetch($templateString, $cacheId);
    }

    /**
     * Registers custom Smarty plugins (e.g., modifiers) from the configuration.
     *
     * @return void
     */
    protected function registerCustomPlugins(): void
    {
        // Example for modifiers; extend for other plugin types if needed
        $modifiers = $this->config->smarty_modifiers ?? [];
        if (is_array($modifiers)) {
            foreach ($modifiers as $modifierName => $callback) {
                // Assuming config is ['modifier_name' => 'php_callback_function']
                // or ['modifier_name' => ['ClassName', 'methodName']]
                if (is_string($modifierName) && (is_string($callback) || is_array($callback)) && is_callable($callback)) {
                     $this->registerPlugin('modifier', $modifierName, $callback);
                }
            }
        }

        // Example for functions
        $functions = $this->config->smarty_functions ?? [];
        if (is_array($functions)) {
            foreach ($functions as $functionName => $callback) {
                if (is_string($functionName) && (is_string($callback) || is_array($callback)) && is_callable($callback)) {
                     $this->registerPlugin('function', $functionName, $callback);
                }
            }
        }
    }

    /**
     * Returns the default template extension.
     *
     * @return string
     */
    public function getTemplateExt(): string
    {
        return $this->templateExt;
    }

    /**
     * Returns the current Smarty version.
     *
     * @return string
     */
    public function version(): string
    {
        return defined('Smarty::SMARTY_VERSION') ? Smarty::SMARTY_VERSION : 'Unknown (ensure Smarty class is loaded)';
    }

    /**
     * Enables Smarty caching with the instance's default lifetime.
     * This is a convenience method to change the instance's caching state.
     *
     * @return void
     */
    public function enableInstanceCaching(): void
    {
        $this->setCaching(Smarty::CACHING_LIFETIME_CURRENT);
    }

    /**
     * Disables Smarty caching for the instance.
     * This is a convenience method to change the instance's caching state.
     *
     * @return void
     */
    public function disableInstanceCaching(): void
    {
        $this->setCaching(Smarty::CACHING_OFF);
    }
}