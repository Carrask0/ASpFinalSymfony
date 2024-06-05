<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Libro;
use Symfony\Component\HttpFoundation\Request;
use App\Form\LibroType;

class LibroController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    // List all libros
    #[Route('/libros', name: 'lista_libros')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {

        $nombre = $request->query->get('nombre', '');
        $queryBuilder = $entityManager->getRepository(Libro::class)->createQueryBuilder('l');
        if ($nombre) {
            $queryBuilder->andWhere('l.titulo LIKE :nombre')
                ->setParameter('nombre', '%' . $nombre . '%');
        }
        $libros = $queryBuilder->getQuery()->getResult();


        return $this->render('libro/lista_libros.html.twig', [
            'libros' => $libros,
            'nombre' => $nombre,
        ]);
    }

    // Show a libro detail
    #[Route('/libro/{id}', name: 'libro_detail')]
    public function detalleLibro($id): Response
    {
        $libro = $this->entityManager->getRepository(Libro::class)->find($id);

        return $this->render('libro/libro_detail.html.twig', [
            'libro' => $libro,
        ]);
    }

    // Create a new libro
    #[Route('form_create_libro', name: 'form_create_libro')]
    public function formCreateLibro(Request $request): Response
    {
        $form = $this->createForm(LibroType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $libro = $form->getData();
            $this->entityManager->persist($libro);
            $this->entityManager->flush();

            return $this->redirectToRoute('lista_libros');
        }

        return $this->render('libro/form_libro.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    // Delete a libro
    #[Route('/delete_libro', name: 'delete_libro')]
    public function deleteLibro(Request $request): Response
    {
        $id = $request->query->get('id');

        $libro = $this->entityManager->getRepository(Libro::class)->find($id);

        $this->entityManager->remove($libro);
        $this->entityManager->flush();

        return $this->redirectToRoute('lista_libros');
    }

    // Edit a libro
    #[Route('/form_edit_libro', name: 'form_edit_libro')]
    public function formEditLibro(Request $request): Response
    {
        $id = $request->query->get('id');

        $libro = $this->entityManager->getRepository(Libro::class)->find($id);

        $form = $this->createForm(LibroType::class, $libro);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $libro->setTitulo($data->getTitulo());
            $libro->setAutor($data->getAutor());
            $libro->setSinopsis($data->getSinopsis());
            $libro->setPublicacion($data->getPublicacion());
            $libro->setEditorial($data->getEditorial());
            $libro->setIsbn($data->getIsbn());
            $libro->setNumeroEjemplares($data->getNumeroEjemplares());
            $libro->setBiblioteca($data->getBiblioteca());

            $this->entityManager->persist($libro);
            $this->entityManager->flush();

            return $this->redirectToRoute('lista_libros');
        }

        return $this->render('libro/form_libro.html.twig', [
            'form' => $form->createView(),
            'libro' => $libro,
        ]);
    }
}
