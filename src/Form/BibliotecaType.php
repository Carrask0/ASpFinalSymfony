<?php

namespace App\Form;

use App\Entity\Biblioteca;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BibliotecaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('direccion')
            ->add('ciudad')
            ->add('horario_apertura', null, [
                'widget' => 'single_text',
            ])
            ->add('horario_cierre', null, [
                'widget' => 'single_text',
            ])
            ->add('fecha_fundacion', null, [
                'widget' => 'single_text',
            ])
            ->add('normas')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Biblioteca::class,
        ]);
    }
}
