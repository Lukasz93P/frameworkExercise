<?php
declare(strict_types=1);

namespace Core\ControllerLoaders;

use Core\Controller\CoreController;
use Core\ControllerLoaders\ControllerLoaderInterface;
use Core\Helpers\FileChecker;
use Core\Cacher\CoreCacher;
use Core\Helpers\FileCheckerInterface;
use Core\Responsesenders\CoreResponseSender;


class CoreControllerLoader implements ControllerLoaderInterface
{
    /**
     * @var string
     */
    protected $controllersPath = "Application" . DIRECTORY_SEPARATOR . "Controllers";

    /**
     * @var FileCheckerInterface
     */
    protected $fileChecker;

    public function __construct()
    {
        $this->setFileChecker();
    }

    /**
     * @param FileCheckerInterface|null $fileChecker
     * @return FileChecker
     */
    public function setFileChecker(FileCheckerInterface $fileChecker = null)
    {
        if (!$fileChecker) {
            return $this->fileChecker = new FileChecker();
        }
        $this->fileChecker = $fileChecker;
    }

    /**
     * @param array $url
     * @return CoreController
     * @throws \Exception
     */
    function produceController(array &$url): CoreController
    {
        $className = $this->fileChecker->searchForFile($url, $this->controllersPath, true);
        if (!empty($className)) {
            return new $className(new CoreCacher(), new CoreResponseSender());
        }
        throw new \Exception("Page not found");
    }

    /**
     * @return string
     */
    public function getControllersPath(): string
    {
        return $this->controllersPath;
    }
}