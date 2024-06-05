<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Biblioteca;
use App\Entity\Libro;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // BIBLIOTECAS
        $biblioteca1 = new Biblioteca();
        $biblioteca1->setNombre('Biblioteca Central');
        $biblioteca1->setDireccion('Calle Mayor, 1');
        $biblioteca1->setCiudad('Madrid');
        $biblioteca1->setHorarioApertura(new \DateTime('08:00:00'));
        $biblioteca1->setHorarioCierre(new \DateTime('20:00:00'));
        $biblioteca1->setFechaFundacion(new \DateTime('01-01-1900'));
        $manager->persist($biblioteca1);

        $biblioteca2 = new Biblioteca();
        $biblioteca2->setNombre('Biblioteca de la Universidad');
        $biblioteca2->setDireccion('Avenida Complutense, 1');
        $biblioteca2->setCiudad('Madrid');
        $biblioteca2->setHorarioApertura(new \DateTime('09:00:00'));
        $biblioteca2->setHorarioCierre(new \DateTime('21:00:00'));
        $biblioteca2->setFechaFundacion(new \DateTime('01-01-1950'));
        $manager->persist($biblioteca2);

        $biblioteca3 = new Biblioteca();
        $biblioteca3->setNombre('Biblioteca Pública');
        $biblioteca3->setDireccion('Calle Ancha, 15');
        $biblioteca3->setCiudad('Sevilla');
        $biblioteca3->setHorarioApertura(new \DateTime('10:00:00'));
        $biblioteca3->setHorarioCierre(new \DateTime('22:00:00'));
        $biblioteca3->setFechaFundacion(new \DateTime('01-01-2000'));
        $manager->persist($biblioteca3);

        // LIBROS
        $libro = new Libro();
        $libro->setTitulo('El Quijote');
        $libro->setAutor('Miguel de Cervantes');
        $libro->setSinopsis('Historia de un hidalgo manchego que enloquece leyendo libros de caballerías y sale al mundo a vivir sus propias aventuras');
        $libro->setEditorial('Espasa Calpe');
        $libro->setIsbn('978-84-670-1356-1');
        $libro->setNumeroEjemplares(10);
        $libro->setPublicacion(new \DateTime('01-01-1605'));
        $libro->setBiblioteca($biblioteca1);
        $manager->persist($libro);

        $libro = new Libro();
        $libro->setTitulo('La Odisea');
        $libro->setAutor('Homero');
        $libro->setSinopsis('Historia de Ulises, rey de Ítaca, que tras la Guerra de Troya emprende un largo viaje de regreso a casa');
        $libro->setEditorial('Gredos');
        $libro->setIsbn('978-84-249-3567-2');
        $libro->setNumeroEjemplares(5);
        $libro->setPublicacion(new \DateTime('0800-01-01'));
        $libro->setBiblioteca($biblioteca1);
        $manager->persist($libro);

        $libro = new Libro();
        $libro->setTitulo('Divina Comedia');
        $libro->setAutor('Dante Alighieri');
        $libro->setSinopsis('Poema épico en el que el autor describe un viaje por el Infierno, el Purgatorio y el Paraíso');
        $libro->setEditorial('Cátedra');
        $libro->setIsbn('978-84-376-0494-7');
        $libro->setNumeroEjemplares(7);
        $libro->setPublicacion(new \DateTime('01-01-1320'));
        $libro->setBiblioteca($biblioteca1);
        $manager->persist($libro);

        $libro = new Libro();
        $libro->setTitulo('Cien años de soledad');
        $libro->setAutor('Gabriel García Márquez');
        $libro->setSinopsis('Historia de la familia Buendía en el pueblo de Macondo, desde su fundación hasta su desaparición');
        $libro->setEditorial('Sudamericana');
        $libro->setIsbn('978-84-376-0494-7');
        $libro->setNumeroEjemplares(3);
        $libro->setPublicacion(new \DateTime('01-01-1967'));
        $libro->setBiblioteca($biblioteca2);
        $manager->persist($libro);

        $libro = new Libro();
        $libro->setTitulo('El amor en los tiempos del cólera');
        $libro->setAutor('Gabriel García Márquez');
        $libro->setSinopsis('Historia de amor entre Fermina Daza y Florentino Ariza, que se conocen en su juventud y se reencuentran en la vejez');
        $libro->setEditorial('Sudamericana');
        $libro->setIsbn('978-84-376-0494-7');
        $libro->setNumeroEjemplares(2);
        $libro->setPublicacion(new \DateTime('01-01-1985'));
        $libro->setBiblioteca($biblioteca2);
        $manager->persist($libro);

        $libro = new Libro();
        $libro->setTitulo('La Regenta');
        $libro->setAutor('Leopoldo Alas Clarín');
        $libro->setSinopsis('Historia de Ana Ozores, esposa del Regente de Vetusta, y sus relaciones con otros personajes de la ciudad');
        $libro->setEditorial('Cátedra');
        $libro->setIsbn('978-84-376-0494-7');
        $libro->setNumeroEjemplares(4);
        $libro->setPublicacion(new \DateTime('01-01-1884'));
        $libro->setBiblioteca($biblioteca3);
        $manager->persist($libro);

        $libro = new Libro();
        $libro->setTitulo('Fortunata y Jacinta');
        $libro->setAutor('Benito Pérez Galdós');
        $libro->setSinopsis('Historia de Fortunata y Jacinta, dos mujeres de clases sociales diferentes que comparten un mismo hombre');
        $libro->setEditorial('Cátedra');
        $libro->setIsbn('978-84-376-0494-7');
        $libro->setNumeroEjemplares(6);
        $libro->setPublicacion(new \DateTime('01-01-1887'));
        $libro->setBiblioteca($biblioteca3);
        $manager->persist($libro);





        $manager->flush();
    }
}
