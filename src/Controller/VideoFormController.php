<?php

declare(strict_types=1);

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

class VideoFormController extends ControllerWithHtml implements Controller
{
    public function __construct(private readonly VideoRepository $repository)
    {
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        /** @var ?Video $video */
        $video = null;
        if ($id !== false && $id !== null) {
            $video = $this->repository->find($id);
        }

        // exibe o conteúdo retornado pelo método
        echo $this->renderTemplate('video-form',[
            'video' => $video
        ]);
        require_once __DIR__ . '/../../views/video-form.php';
    }
}
