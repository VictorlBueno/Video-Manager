<?php

declare(strict_types=1);

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

class NewJsonVideoController implements Controller {
    public function __construct(private VideoRepository $videoRepository) {  
    }
    public function processaRequisicao(): void {
        // Traz os dados da requisição que está em json
        $request = file_get_contents('php://input');
        // Transforma o json em dados php - true de array associativo
        $videoData = json_decode($request, true);
        $video = new Video($videoData['url'], $videoData['title']);
        $this->videoRepository->add($video);

        // Reposta http de algo criado
        http_response_code(201);
    }
}