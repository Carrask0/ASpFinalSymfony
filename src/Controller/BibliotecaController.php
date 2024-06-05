<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Biblioteca;
use Symfony\Component\HttpFoundation\Request;
use App\Form\BibliotecaType;
use App\Entity\Libro;



class BibliotecaController extends AbstractController
{
    // #[Route('/biblioteca', name: 'app_biblioteca')]
    // public function index(): Response
    // {
    //     return $this->render('biblioteca/index.html.twig', [
    //         'controller_name' => 'BibliotecaController',
    //     ]);
    // }

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    // List all bibliotecas
    #[Route('/bibliotecas', name: 'lista_bibliotecas')]
    public function listaBibliotecas(Request $request, EntityManagerInterface $entityManager): Response
    {
        $nombre = $request->query->get('nombre', '');
        $ciudad = $request->query->get('ciudad', '');

        $queryBuilder = $entityManager->getRepository(Biblioteca::class)->createQueryBuilder('b');

        if ($nombre) {
            $queryBuilder->andWhere('b.nombre LIKE :nombre')
                ->setParameter('nombre', '%' . $nombre . '%');
        }

        if ($ciudad) {
            $queryBuilder->andWhere('b.ciudad LIKE :ciudad')
                ->setParameter('ciudad', '%' . $ciudad . '%');
        }

        $bibliotecas = $queryBuilder->getQuery()->getResult();

        return $this->render('biblioteca/lista_bibliotecas.html.twig', [
            'bibliotecas' => $bibliotecas,
            'nombre' => $nombre,
            'ciudad' => $ciudad,
        ]);
    }

    // Show a biblioteca detail
    #[Route('/biblioteca/{id}', name: 'biblioteca_detail')]
    public function bibliotecaDetail(Request $request, EntityManagerInterface $entityManager, $id): Response
    {
        $titulo = $request->query->get('titulo', '');
        $autor = $request->query->get('autor', '');
        $editorial = $request->query->get('editorial', '');

        //Print titulo on console
        echo "<script>console.log('Titulo: " . addslashes($titulo) . "');</script>";



        // Find the specific biblioteca by ID
        $biblioteca = $entityManager->getRepository(Biblioteca::class)->find($id);

        // Create a query builder for the Libro entity
        $queryBuilder = $entityManager->getRepository(Libro::class)->createQueryBuilder('l')
            ->where('l.biblioteca = :biblioteca')
            ->setParameter('biblioteca', $biblioteca);

        if ($titulo) {
            $queryBuilder->andWhere('l.titulo LIKE :titulo')
                ->setParameter('titulo', '%' . $titulo . '%');
        }
        if ($autor) {
            $queryBuilder->andWhere('l.autor LIKE :autor')
                ->setParameter('autor', '%' . $autor . '%');
        }
        if ($editorial) {
            $queryBuilder->andWhere('l.editorial LIKE :editorial')
                ->setParameter('editorial', '%' . $editorial . '%');
        }

        // Get the results of the query
        $libros = $queryBuilder->getQuery()->getResult();

        return $this->render('biblioteca/biblioteca_detail.html.twig', [
            'biblioteca' => $biblioteca,
            'libros' => $libros,
            'titulo' => $titulo,
            'autor' => $autor,
            'editorial' => $editorial,
        ]);
    }

    // Create a new biblioteca
    #[Route('form_create_biblioteca', name: 'form_create_biblioteca')]
    public function formCreateBiblioteca(Request $request): Response
    {
        $form = $this->createForm(BibliotecaType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Handle the data
            $biblioteca = $form->getData();
            $this->entityManager->persist($biblioteca);
            $this->entityManager->flush();

            // Redirect to a success page or show a success message
            return $this->redirectToRoute('lista_bibliotecas');
        }

        return $this->render('biblioteca/form_biblioteca.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // Delete a biblioteca
    #[Route('/delete_biblioteca', name: 'delete_biblioteca')]
    public function deleteBiblioteca(Request $request): Response
    {
        $id = $request->query->get('id');

        $biblioteca = $this->entityManager->getRepository(Biblioteca::class)->find($id);

        $this->entityManager->remove($biblioteca);
        $this->entityManager->flush();

        return $this->redirectToRoute('lista_bibliotecas');
    }

    // Edit a biblioteca
    #[Route('/form_edit_biblioteca', name: 'form_edit_biblioteca')]
    public function editBiblioteca(Request $request): Response
    {
        $id = $request->query->get('id');

        $biblioteca = $this->entityManager->getRepository(Biblioteca::class)->find($id);

        $form = $this->createForm(BibliotecaType::class, $biblioteca);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Handle the data
            $data = $form->getData();

            // Persist the data to the database
            $biblioteca->setNombre($data->getNombre());
            $biblioteca->setDireccion($data->getDireccion());
            $biblioteca->setCiudad($data->getCiudad());
            $biblioteca->setHorarioApertura($data->getHorarioApertura());
            $biblioteca->setHorarioCierre($data->getHorarioCierre());
            $biblioteca->setFechaFundacion($data->getFechaFundacion());
            $biblioteca->setNormas($data->getNormas());

            $this->entityManager->persist($biblioteca);
            $this->entityManager->flush();

            // Redirect to a success page or show a success message
            return $this->redirectToRoute('lista_bibliotecas');
        }

        return $this->render('biblioteca/form_biblioteca.html.twig', [
            'form' => $form->createView(),
            'biblioteca' => $biblioteca,
        ]);
    }
}
