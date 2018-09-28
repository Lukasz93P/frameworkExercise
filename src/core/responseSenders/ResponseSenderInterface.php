<?php
declare(strict_types=1);

namespace Core\Responsesenders;

interface ResponseSenderInterface
{
    public function sendJson(object $data);

    public function errorResponse(int $code, string $message);
}