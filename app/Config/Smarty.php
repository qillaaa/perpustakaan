<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Smarty extends BaseConfig
{
    /**
     * Smarty debugging.
     * TRUE to enable, FALSE to disable.
     * @var bool
     */
    public bool $smarty_debug = false;

    /**
     * Smarty caching enabled by default for the instance.
     * Set to TRUE to enable caching, FALSE to disable.
     * This can be overridden per `parse()` call.
     * Caching is typically disabled in 'development' environment regadmardless of this setting.
     * @var bool
     */
    public bool $cache_status = false;

    /**
     * Cache lifetime in seconds.
     * Default Smarty value is 3600 (1 hour).
     * -1: Cache files never expire (until explicitly cleared or source template changes).
     *  0: Cache files always re-checked for recompilation.
     * @var int
     */
    public int $cache_lifetime = -1; // Cache indefinitely when caching is active

    /**
     * Directory where compiled Smarty templates are stored.
     * Ensure this directory is writable by the web server.
     * @var string
     */
    public string $compile_directory = WRITEPATH . 'smarty/compile/';

    /**
     * Directory where cached Smarty templates are stored.
     * Ensure this directory is writable by the web server.
     * @var string
     */
    public string $cache_directory = WRITEPATH . 'smarty/cache/';

    /**
     * Directory where Smarty configuration files are located.
     * Set to null if not using Smarty's separate config files.
     * @var string|null
     */
    public ?string $config_directory = null; // Example: APPPATH . "third_party/Smarty/configs/";

    /**
     * Array of paths to search for template files.
     * Paths are searched in the order they are defined.
     * Use string keys as namespaces (e.g., 'Admin' => '/path/to/admin/templates/').
     * @var array<string, string>|array<int, string>
     */
    public array $template_directory = [
        'Auth'     => APPPATH . 'Views/auth/',
        'Admin'     => APPPATH . 'Views/admin/',
        APPPATH . 'Views/', // Default/fallback location
    ];

    /**
     * Default extension for template files if not explicitly supplied.
     * @var string
     */
    public string $template_ext = 'tpl';

    /**
     * Error reporting level for Smarty template processing.
     * Example: E_ALL & ~E_NOTICE
     * @var int|null
     */
    public ?int $template_error_reporting = E_ALL & ~E_NOTICE;

    /**
     * Custom Smarty modifiers.
     * Associative array: 'modifier_name' => 'php_callback_function'
     * or 'modifier_name' => ['ClassName', 'staticMethodName']
     * or 'modifier_name' => [$objectInstance, 'methodName']
     * @var array<string, callable>
     */
    public array $smarty_modifiers = [
        'strtotime'     => 'strtotime',
        'base_url' => 'base_url'

    ];

    /**
     * Custom Smarty functions.
     * Associative array: 'function_name' => 'php_callback_function'
     * or 'function_name' => ['ClassName', 'staticMethodName']
     * or 'function_name' => [$objectInstance, 'methodName']
     * @var array<string, callable>
     */
    public array $smarty_functions = [
        // Example: 'base_url' => 'base_url', // If you want to register CI's base_url
    ];
}
