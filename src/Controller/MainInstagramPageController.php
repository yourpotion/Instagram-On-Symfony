<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use App\Form\PostFormType;
use App\Form\UserFormType;
use App\Repository\PostsRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainInstagramPageController extends AbstractController
{
    /**
     * @var \Doctrine\ORM\EntityManagerInterface $em
     */
    private $em;
    /**
     * @var \App\Repository\PostsRepository $postsRepository
     */
    private $postsRepository;

    /**
     * @var \App\Repository\UserRepository
     */
    private $userRepository;

    /**
     * @param PostsRepository $postsRepository
     * @param EntityManagerInterface $em
     */
    public function __construct(PostsRepository $postsRepository, EntityManagerInterface $em, UserRepository $userRepository)
    {
        $this->postsRepository = $postsRepository;
        $this->em = $em;
        $this->userRepository = $userRepository;
    }

    #[Route('/', name: 'app_main_instagram_page')]
    /**
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('MainInstagramPage/index.html.twig', [
            'posts' => $this->postsRepository->findAll()
        ]);
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

            $this->postsRepository->save($newPost);

            return $this->redirectToRoute('app_main_instagram_page');
        }

        return $this->render('MainInstagramPage/html/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/profile', name: 'instagram_profile')]
    /**
     * @param Request $request
     * 
     * @return Response
     */
    public function profile(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserFormType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $newUser = $form->getData();

            $email = $form->get('email')->getData();
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

                $newUser->setImagePath('/uploads/profile' . $newFileName);
            }
            $this->userRepository->save($newUser);

            return $this->redirectToRoute('app_main_instagram_page');
        }

        return $this->render('MainInstagramPage/html/profile.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
