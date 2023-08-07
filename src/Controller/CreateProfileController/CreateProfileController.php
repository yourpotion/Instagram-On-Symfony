<?php

declare(strict_types=1);

namespace App\Controller\CreateProfileController;

use App\Entity\Post;
use App\Form\PostFormType;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateProfileController extends AbstractController
{
    /**
     * @var \App\Repository\PostRepository $postRepository
     */
    private PostRepository $postRepository;

    /**
     * @var bool
     */
    public bool $heartImageStatus;

    /**
     * @param PostRepository $postRepository
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    #[Route('/create', name: 'create_post')]
    /**
     * @param Request $request
     * 
     * @return Response
     */
    public function create(Request $request): Response
    {
        $post = new Post();
        $form = $this->createForm(PostFormType::class, $post);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $newPost = $form->getData();

            $imagePath = $form->get('imagePath')->getData();
            if ($imagePath) {
                $newFileName = uniqid() . '.' . $imagePath->guessExtension();

                try {
                    $imagePath->move(
                        $this->getParameter('kernel.project_dir') . '/public/uploads',
                        $newFileName
                    );
                } catch (FileException $e) {
                    return new Response($e->getMessage());
                }

                $newPost->setImagePath('/uploads/' . $newFileName);
            }

            $this->postRepository->save($newPost);

            return $this->redirectToRoute('app_main_instagram_page');
        }

        return $this->render('MainInstagramPage/html/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
