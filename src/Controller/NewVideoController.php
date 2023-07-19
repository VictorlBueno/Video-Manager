<?php

declare(strict_types=1);

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;

class NewVideoController implements Controller
{
    public function __construct(private VideoRepository $videoRepository)
    {
    }

    public function processaRequisicao(): void
    {
        $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
        if ($url === false) {
            header('Location: /?sucesso=0');
            return;
        }
        $title = filter_input(INPUT_POST, 'title');
        if ($title === false) {
            header('Location: /?sucesso=0');
            return;
        }

        $video = new Video($url, $title);
        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // Evita ataques com nomes de arquivo do tipo /../../ e salva apenas o nome real da imagem
            // Adiciona um id único para que cada imagem tenha um nome diferente, mesmo se tiver o mesmo nome no upload
            $safeFileName = uniqid('upload_') . '_' . pathinfo($_FILES['image']['name'], PATHINFO_BASENAME);

            // Descobre o conteúdo para evitar ataques de imagens com texto
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->file($_FILES['image']['tmp_name']);
            // Se for uma imagem

            if(str_starts_with($mimeType, 'image/')) {
                move_uploaded_file(
                        $_FILES['image'] ['tmp_name'],
                        __DIR__ . '/../../public/img/uploads/' . $safeFileName
                );
                $video->setFilePath($safeFileName);
            }

        }

        $success = $this->videoRepository->add($video);
        if ($success === false) {
            header('Location: /?sucesso=0');
        } else {
            header('Location: /?sucesso=1');
        }
    }
}
