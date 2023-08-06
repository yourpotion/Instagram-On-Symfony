<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\PostUserLikes;
use App\Entity\User;
use App\Form\PostFormType;
use App\Form\UserFormType;

use App\Repository\PostRepository;
use App\Repository\PostsRepository;
use App\Repository\PostUserLikesRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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

    private $postUserLikesRepository;

    public $heartImageStatus;

    /**
     * @param PostsRepository $postsRepository
     * @param EntityManagerInterface $em
     */
    public function __construct(PostRepository $postsRepository, EntityManagerInterface $em, UserRepository $userRepository, PostUserLikesRepository $postUserLikesRepository)
    {
        $this->postsRepository = $postsRepository;
        $this->postUserLikesRepository = $postUserLikesRepository;
        $this->em = $em;
        $this->userRepository = $userRepository;
    }

    #[Route('/post/{postId}', methods: ['GET'], name: 'main_with_id')]
    public function addLikeToPost($postId): Response
    {
        $post = $this->postsRepository->find($postId);

        $currentUser = $this->getUser();

        // Make sure about like - does it is or not?
        $isLikedByCurrentUser = $post->getLikes()->filter(function ($like) use ($currentUser) {
            return $like->getUser() === $currentUser;
        })->count() > 0;

        if (!$isLikedByCurrentUser) {
            // make a new like if it is not being
            $like = new PostUserLikes();
            $like->setUser($currentUser);
            $like->setPost($post);

            $post->addLike($like);

            // Save changes
            $this->postUserLikesRepository->save($like);
            $heartImageStatus = true;
        } else {
            // Delete like if it is being
            $existingLike = $post->getLikes()->filter(function ($like) use ($currentUser) {
                return $like->getUser() === $currentUser;
            })->first();

            if ($existingLike) {
                $post->removeLike($existingLike);

                $this->postUserLikesRepository->remove($existingLike);
       
                $heartImageStatus = false;
            }
        }

        return $this->redirectToRoute('app_main_instagram_page', [
            'heartImageStatus' => $heartImageStatus
        ]);
    }

    

    #[Route('/', name: 'app_main_instagram_page')]
    /**
     * @return Response
     */
    public function index(Request $request): Response
    {
        $heartImageStatus = $request->get('heartImageStatus');
        if ($heartImageStatus) {
        } else {
            $heartImageStatus = false;
        }
        return $this->render('MainInstagramPage/index.html.twig', [
            'posts' => $this->postsRepository->findAll(),
            'heartImageStatus' => $heartImageStatus,
            'users' => $this->userRepository->findAll()
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
