<?php
namespace Acelaya\Files;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\AbstractOptions;

/**
 * Class Options
 * @author Alejandro Celaya Alastrué
 * @link http://www.wonnova.com
 */
class FilesOptions extends AbstractOptions
{
    /**
     * @var string
     */
    protected $basePath = '';
    /**
     * @var string
     */
    protected $maxSize = '1536MB';

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
     * @return string
     */
    public function getMaxSize()
    {
        return $this->maxSize;
    }

    /**
     * @param string $maxSize
     * @return $this
     */
    public function setMaxSize($maxSize)
    {
        $this->maxSize = $maxSize;
        return $this;
    }
}
