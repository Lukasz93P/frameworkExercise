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
        header($_SERVER["SERVER_PROTOCOL"] . $message, true, $code);
    }
}