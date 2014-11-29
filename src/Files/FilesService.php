<?php
namespace Acelaya\Files;

/**
 * Class FilesService
 * @author Alejandro Celaya Alastrué
 * @link http://www.alejandrocelaya.com
 */
class FilesService implements FilesServiceInterface
{
    /**
     * @var FilesOptions
     */
    protected $options;

    public function __construct(FilesOptions $options)
    {
        $this->options = $options;
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
            move_uploaded_file($file['tmp_name'], $this->options->getBasePath() . '/' . $file['name']);
        }
        return self::CODE_SUCCESS;
    }
}
