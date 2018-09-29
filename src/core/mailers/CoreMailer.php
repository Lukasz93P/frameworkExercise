<?php
declare(strict_types=1);

namespace Core\Mailers;

use Core\Mailers\MailerInterface;
use Core\Mailers\MailerAdapterInterface;

class CoreMailer implements MailerInterface
{
    /**
     * @var \Core\Mailers\MailerAdapterInterface
     */
    protected $mailerAdapter;

    public function __construct(MailerAdapterInterface $mailerAdapter)
    {
        $this->mailerAdapter = $mailerAdapter;
    }

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
    public function sendMail(string $sender, array $recipients, string $subject, string $body, array $attachments = null, bool $isHTML = false, string $replyTo = null)
    {
        return $this->mailerAdapter->sendMail($sender, $recipients, $subject, $body, $attachments, $isHTML, $replyTo);
    }
}