<?php

namespace App\Form;

use App\Entity\Biblioteca;
use App\Entity\Libro;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LibroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titulo')
            ->add('autor')
            ->add('sinopsis')
            ->add('publicacion')
            ->add('editorial')
            ->add('isbn')
            ->add('numero_ejemplares')
            ->add('biblioteca', EntityType::class, [
                'class' => Biblioteca::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Libro::class,
        ]);
    }
}
