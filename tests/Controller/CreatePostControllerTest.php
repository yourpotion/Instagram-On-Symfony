<?php

declare (strict_types=1);

namespace App\Tests\Controller;


use App\Controller\CreatePost\CreatePostController;
use App\Entity\Post;
use App\Form\PostFormType;
use App\Repository\PostRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CreatePostControllerTest extends TestCase
{
    public function testCreate()
    {
        // Создаем имитацию репозитория
        $postRepositoryMock = $this->createMock(PostRepository::class);

        // Создаем имитацию контейнера
        $containerMock = $this->createMock(ContainerInterface::class);


        // Создаем реальный объект формы
        $formBuilderMock = $this->createMock(FormBuilderInterface::class);
        $formBuilderMock->expects($this->once())
            ->method('get')
            ->with('imagePath')
            ->willReturn($formBuilderMock);
        


        $formMock = $this->createMock(FormInterface::class);
        $formMock->method('handleRequest');
        $formMock->method('isSubmitted')->willReturn(true);
        $formMock->method('isValid')->willReturn(true);
        $formMock->method('getData')->willReturn(new Post());

    }
}
