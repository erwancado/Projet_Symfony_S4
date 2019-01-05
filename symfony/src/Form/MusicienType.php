<?php

namespace App\Form;

use App\Entity\Musicien;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MusicienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomMusicien')
            ->add('prenomMusicien')
            ->add('anneeNaissance')
            ->add('anneeMort')
            ->add('photo')
            ->add('codePays')
            ->add('codeGenre')
            ->add('codeInstrument')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Musicien::class,
        ]);
    }
}
