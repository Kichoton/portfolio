<?php

namespace App\Form;

use App\Entity\GraphicCreation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

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
            ->add('miniature', FileType::class, [
                'label' => 'Miniature (Jpg/Jpeg file)',
                'mapped' => false,
                "required" => false,
                "constraints" => [
                    new File([
                        'maxSize' => '1G',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Please send Jpeg or PNG file',
                    ])
                ],
            ])
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
