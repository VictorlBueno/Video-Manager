<?php

declare(strict_types=1);

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;

class VideoListController extends ControllerWithHtml implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processaRequisicao(): void
    {
        $videoList = $this->videoRepository->all();

        // direciona para o endereço da página view com um método
        echo $this->renderTemplate(
            // passa o nome da página
            'video-list',
            // diz que a lista pedida no parâmetro é a lista
            ['videoList' => $videoList]
        );
    }
}
