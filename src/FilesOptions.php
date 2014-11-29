<?php
namespace Acelaya;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\AbstractOptions;

/**
 * Class Options
 * @author Alejandro Celaya Alastrué
 * @link http://www.wonnova.com
 */
class FilesOptions extends AbstractOptions implements FactoryInterface
{
    protected $basePath = '';

    public function __construct(array $options = [])
    {
        $this->basePath = __DIR__ . '/../files';
        parent::__construct($options);
    }

    /**
     * @return string
     */
    public function getBasePath()
    {
        return $this->basePath;
    }

    /**
     * @param string $basePath
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setBasePath($basePath)
    {
        if (! is_dir($basePath)) {
            throw new \InvalidArgumentException('Provided base path is not a valid directory');
        }
        $this->basePath = realpath($basePath);
        return $this;
    }

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');
        return new self(isset($config['files']) ? $config['files'] : []);
    }
}
