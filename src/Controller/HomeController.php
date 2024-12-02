<?php

namespace App\Controller;


use App\Entity\Game;
use App\Entity\Post;
use App\Service\UploadFileService;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route(path: '/home', name: 'app_home')]
   #[IsGranted("ROLE_USER")]
    public function home(Request $request,EntityManagerInterface $entityManager, UploadFileService  $uploadFileService): Response
    {

        $post = new Post();
        $formBuilder=$this->createFormBuilder($post)
            ->add('context',TextareaType::class)
            ->add('postVideo', FileType::class, [
                'mapped' => false,
                'required' => false,
            ]);
        ;
        $form=$formBuilder->getForm();
        $form->handleRequest($request);

        $gamer=$this->getUser();
        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $postVideo = $form->get('postVideo')->getData();
            $postVideoName = $uploadFileService->upload($postVideo,UploadFileService::VideoType,);
            $post->setVideo($postVideoName);
            $post->setGamer($gamer);
            $entityManager->persist($post);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_home');
        }
        $posts=$this->getDoctrine()->getManager()->getRepository(Post::class)->findAll();
        return $this->render('home.html.twig',['posts'=> $posts,'postForm'=>$form->createView()]);
    }













    #[Route(path: '/adminhome', name: 'app_admin_home')]
    #[IsGranted("ROLE_ADMIN")]
    public function adminHome(Request $request, EntityManagerInterface $entityManager,UploadFileService  $uploadFileService): Response
    {


        $game = new Game();
        $formBuilder=$this->createFormBuilder($game)
            ->add('name')
            ->add('image',FileType::class)
        ;
        $form=$formBuilder->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $image = $form->get('image')->getData();
            $imageName = $uploadFileService->upload($image,UploadFileService::ImageType);
            $game->setImage($imageName);

            $entityManager->persist($game);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_admin_home');
        }
        $games=$this->getDoctrine()->getManager()->getRepository(Game::class)->findAll();
        return $this->render('adminhome.html.twig',['gameForm' => $form->createView(),'games'=> $games]);
    }






    #[Route(path: '/poste/{id}', name: 'app_poste')]
    #[IsGranted("ROLE_USER")]
    public function post($id): Response
    {

        $post=$this->getDoctrine()->getManager()->getRepository(Post::class)->find($id);
        return $this->render('post.html.twig',['post'=> $post]);
    }


    #[Route('/addGame', name: 'app_add_game')]
    #[IsGranted("ROLE_ADMIN")]
    public function addgame(Request $request,  EntityManagerInterface $entityManager, UploadFileService  $uploadFileService): Response
    {
        $game = new Game();
        $formBuilder=$this->createFormBuilder($game)
            ->add('name')
            ->add('image',FileType::class)
        ;
        $form=$formBuilder->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $image = $form->get('image')->getData();
            $imageName = $uploadFileService->upload($image,UploadFileService::ImageType);
            $game->setLogo($imageName);

            $entityManager->persist($game);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_login');
        }

        return $this->render('addEquipe.html.twig', [
            'gameForm' => $form->createView(),
        ]);
    }



    #[Route('/delete/{id}', name: 'app_delete',methods: "GET")]
    #[IsGranted("ROLE_ADMIN")]
    public function deleteGame($id): Response
    {
        $c = $this->getDoctrine()
            ->getRepository(Game::class)
            ->find($id);
        if (!$c) {
            throw $this->createNotFoundException('No job found for id' . $id);
        }
        foreach ($c->getGamers() as $gamer) {
            $c->removeGamer($gamer);
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($c);
        $entityManager->flush();
        return $this->redirectToRoute('app_admin_home');




    }

}