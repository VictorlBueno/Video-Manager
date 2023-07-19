<?php

declare(strict_types=1);

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

class JsonVideoListController implements Controller
{
    private VideoRepository $videoRepository;
    
    public function __contrstuc() {
    }

    public function processaRequisicao(): void {
        $videoList = array_map(function (Video $video): array {
            return [
                'url' => $video->url,
                'title' => $video->title,
                'file_path' => '/img/uploads/' . $video->getFilePath()
            ];
        }, $this->videoRepository->all());
        echo json_encode($videoList);
    }
}