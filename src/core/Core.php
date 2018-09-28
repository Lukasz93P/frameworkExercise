<?php
declare(strict_types=1);

namespace Core;

use Core\Controller\CoreController;
use Core\ControllerLoaders\ControllerLoaderInterface;
use Core\Helpers\FileChecker;
use Core\ControllerLoaders\CoreControllerLoader;
use Core\Mailers\PhpMailerAdapter;

class Core
{
    /**
     * @var ControllerLoaderInterface
     */
    protected $controllerLoader;

    /**
     * @var CoreController
     */
    protected $controller;

    /**
     * @var array
     */
    protected $explodedUrl;

    /**
     * Core constructor.
     * @param ControllerLoaderInterface $controllerLoader
     */
    public function __construct(ControllerLoaderInterface $controllerLoader)
    {
        $t = MAILGUN_PASSWORD;
        $sender = 'smoku@smoku.pl';
        $mailer = new PhpMailerAdapter();
        $recipients = ['lukasz9.3@interia.pl', 'joanna9307@interia.pl'];
        $body = "<h1> Smoku </h1> <h3>Bardzo Kocha Was:)</h3><br>I Frejcie";
        $attachments = [BASE_PATCH. 'uploads/heart.jpg|serceOdSmoka'];
        $s = BASE_PATCH. 'uploads/heart.jpg';
        try {
            $mailer->sendMail($sender, $recipients, 'Test mail from Smoku :)', $body, $attachments, true, 'lukasz9.3@interia.pl');
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
        $this->controllerLoader = $controllerLoader;
        if (isset($_GET['url'])) {
            $url = filter_var($_GET['url'], FILTER_SANITIZE_URL);
            $this->explodedUrl = explode('/', $url);
            $this->getController($this->explodedUrl);
            if (!empty($this->explodedUrl)) {
                $this->callController($this->explodedUrl);
            }
        }
    }

    /**
     * @param array $url
     */
    protected function getController(array $url)
    {
        $this->controller = $this->controllerLoader->produceController($this->explodedUrl);
    }

    /**
     * @param array $url
     * @return mixed
     */
    protected function callController(array &$url)
    {
        $methodName = $url[0];
        if (method_exists($this->controller, $methodName)) {
            array_shift($url);
            return call_user_func_array([$this->controller, $methodName], $url);
        }
        $this->controller->errorResponse(404, 'Requested page not found');
    }
}