<?php

namespace App\Repository;

use App\Entity\FailedMessage;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Transport\Receiver\ListableReceiverInterface;

class FailedMessageRepository
{
    private ListableReceiverInterface $receiver;

    public function __construct(ListableReceiverInterface $receiver)
    {
        $this->receiver = $receiver;
    }

    public function findAll()
    {
        // return $this->receiver->all();
        return array_map(fn (Envelope $envelope) => new FailedMessage($envelope), 
            iterator_to_array($this->receiver->all())
        );
    }

    public function find(int $id): FailedMessage
    {
        return new FailedMessage($this->receiver->find($id));
    }

    public function delete(int $id):void
    {
        $this->receiver->reject($this->receiver->find($id));
    }
}