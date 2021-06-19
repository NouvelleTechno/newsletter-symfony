<?php

namespace App\Controller;

use App\Repository\FailedMessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class FailedController extends AbstractController
{
    /**
     * @Route("/newsletters/failed", name="failed")
     */
    public function index(FailedMessageRepository $failedMessageRepository): Response
    {
        return $this->render('failed/index.html.twig', [
            'messages' => $failedMessageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/newsletters/failed/resend/{id}", name="newsletters_failed_resend")
     */
    public function resend(int $id, FailedMessageRepository $failedMessageRepository, MessageBusInterface $messageBus): Response
    {
        $message = $failedMessageRepository->find($id)->getMessage();

        $messageBus->dispatch($message);

        $failedMessageRepository->delete($id);

        // $this->addFlash()
        return $this->redirectToRoute('failed');
    }

    /**
     * @Route("/newsletters/failed/delete/{id}", name="newsletters_failed_delete")
     */
    public function delete(int $id, FailedMessageRepository $failedMessageRepository): Response
    {
        $failedMessageRepository->delete($id);

        // $this->addFlash()
        return $this->redirectToRoute('failed');
    }
}
