<?php
namespace Acelaya;

use Zend\ModuleManager\Feature\ConfigProviderInterface;

/**
 * Class Module
 * @author Alejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
class Module implements ConfigProviderInterface
{
    /**
     * Returns configuration to merge with application configuration
     *
     * @return array|\Traversable
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/config.php';
    }
}
