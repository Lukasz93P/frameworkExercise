<?php
declare(strict_types=1);

namespace Core\Mailers;

interface MailerInterface
{
    /**
     * @param string $sender
     * @param array $recipients
     * @param string $subject
     * @param string $body
     * @param array|null $attachments
     * @param bool $isHTML
     * @param string|null $replyTo
     * @return mixed
     */
    public function sendMail(string $sender, array $recipients, string $subject, string $body, array $attachments = null, bool $isHTML = false, string $replyTo = null);
}