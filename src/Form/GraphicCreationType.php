<?php

namespace App\Form;

use App\Entity\GraphicCreation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class GraphicCreationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('client')
            ->add('categorie', ChoiceType::class, [
                'choices'=> [
                    'Logo' => 'logo',
                    'Identité graphique' => 'identité graphique',
                    'Autre' => 'autre'
                ]
            ])
            ->add('miniature')
            ->add('description')
            ->add('url')
            ->add('created_at')
            ->add('save', SubmitType::class,[
                "label"=>'Envoyer',
                "attr"=>[
                    'class'=>'button'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GraphicCreation::class,
        ]);
    }
}
