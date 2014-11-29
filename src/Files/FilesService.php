<?php
namespace Acelaya\Files;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Filter\Exception\InvalidArgumentException;

/**
 * Class FilesService
 * @author Alejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
class FilesService implements FilesServiceInterface, InputFilterAwareInterface
{
    /**
     * @var FilesOptions
     */
    protected $options;
    /**
     * @var InputFilter
     */
    protected $inputFilter;

    public function __construct(FilesOptions $options, InputFilter $inputFilter = null)
    {
        $this->options = $options;
        $this->inputFilter = $inputFilter;
    }

    /**
     * @return \SplFileInfo[]
     */
    public function getFiles()
    {
        $iterator = new \DirectoryIterator($this->options->getBasePath());
        $files = [];
        /** @var \SplFileInfo $file */
        foreach ($iterator as $file) {
            $file = $file->getFileInfo();
            if ($file->isDir() || $this->isFileHidden($file)) {
                continue;
            }

            $files[] = $file;
        }
        return $files;
    }

    /**
     * @param \SplFileInfo $file
     * @return bool
     */
    public function isFileHidden(\SplFileInfo $file)
    {
        $basename = $file->getBasename();
        return strpos($basename, '.') === 0;
    }

    /**
     * @param array $files
     * @return string
     */
    public function persistFiles(array $files)
    {
        foreach ($files as $file) {
            $filter = clone $this->getInputFilter();
            $filter->setData([FilesInputFilter::FILE => $file]);
            try {
                if (! $filter->isValid()) {
                    return self::CODE_ERROR;
                }
                $data = $filter->getValues();
            } catch (InvalidArgumentException $e) {
                return self::CODE_ERROR;
            }
        }
        return self::CODE_SUCCESS;
    }

    /**
     * Set input filter
     *
     * @param  InputFilterInterface $inputFilter
     * @return InputFilterAwareInterface
     */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        $this->inputFilter = $inputFilter;
        return $this;
    }

    /**
     * Retrieve input filter
     *
     * @return InputFilterInterface
     */
    public function getInputFilter()
    {
        if (! isset($this->inputFilter)) {
            $this->setInputFilter(new FilesInputFilter($this->options));
        }

        return $this->inputFilter;
    }
}
