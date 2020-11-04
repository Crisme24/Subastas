<?php

namespace App\Form;

use App\Entity\Subasta;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class SubastaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'label' => 'Nombre'))
            ->add('description', TextareaType::class, array(
                'label' => 'Descripcion'))
            ->add('image', FileType::class, array(
                "label" => "Imagen",
                "required" => false,
                "attr" =>array("class" => "form-control"),
                "data_class" => null,
                'constraints' => [
                    new File([
                        'maxSize' => '4096k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/jpg',
                            'image/png'
                        ],
                        'mimeTypesMessage' => 'Por favor subir un formato válido png, jpg y jpeg',
                    ])
                ],)
                )
            ->add('minPrice', NumberType::class, array(
                'label' => 'Precio minimo'))
            ->add('maxPrice', NumberType::class, array(
                'label' => 'Precio Maximo'))
            ->add('startDate', DateType::class, array(
                'label' => 'Fecha Inicio'))
            ->add('endDate', DateType::class, array(
                'label' => 'Fecha Fin'))
            ->add('status', ChoiceType::class, array(
                'label' => 'Estado',
                'choices' => array(
                    'Activo' => 'activo',
                    'Inactivo' => 'inactivo'
                )
            ))
            ->add('Guardar', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Subasta::class,
        ]);
    }
}
