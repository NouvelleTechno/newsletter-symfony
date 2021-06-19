<?php
namespace App\Entity;

use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Stamp\TransportMessageIdStamp;

class FailedMessage
{
    private Envelope $envelope;

    public function __construct(Envelope $envelope)
    {
        $this->envelope = $envelope;
    }

    public function getId(): int
    {
        /** @var TransportMessageIdStamp[] $stamps */
        $stamps = $this->envelope->all(TransportMessageIdStamp::class);
        return end($stamps)->getId();
    }

    public function getTitle(): string
    {
        return get_class($this->envelope->getMessage());
    }

    public function getMessage(): object
    {
        return $this->envelope->getMessage();
    }
}