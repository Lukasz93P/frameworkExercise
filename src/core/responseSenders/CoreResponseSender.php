<?php
declare(strict_types=1);

namespace Core\Responsesenders;

use Core\Responsesenders\ResponseSenderInterface;

class CoreResponseSender implements ResponseSenderInterface
{
    public function sendJson(object $data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function errorResponse(int $code, string $message)
    {
        http_response_code($code);
        header("Status: $code $message");
    }

    /**
     * @param string $view
     * @param array|null $data
     * @return mixed
     * @throws \Exception
     */
    public function sendView(string $view, array $data = null)
    {
        $requerstedViewPath = BASE_PATCH . 'application' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $view . '.php';
        if (file_exists($requerstedViewPath)) {
            return require_once $requerstedViewPath;
        }
        throw new \Exception('View ' . $view . ' not found');
    }
}