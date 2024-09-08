<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class TestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $attributeType = $options['attribute_type'];

        switch ($attributeType) {
            case 'Integer':
                $builder->add('value', IntegerType::class, [
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Enter an integer',
                        'class' => 'bg-transparent block mt-10 mx-auto border-b-2 w-1/5 h-20 text-2xl outline-none',
                    ],
                    'constraints' => [
                        new NotBlank(['message' => 'Please enter a value']),
                    ],
                ]);
                break;
            
            case 'String':
                $builder->add('value', TextType::class, [
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Enter a string',
                        'class' => 'bg-transparent block mt-10 mx-auto border-b-2 w-1/5 h-20 text-2xl outline-none',
                    ],
                    'constraints' => [
                        new NotBlank(['message' => 'Please enter a value']),
                    ],
                ]);
                break;
            
            case 'Date':
                $builder->add('value', DateType::class, [
                    'label' => false,
                    'widget' => 'single_text',
                    'attr' => [
                        'placeholder' => 'Select a date',
                        'class' => 'bg-transparent block mt-10 mx-auto border-b-2 w-1/5 h-20 text-2xl outline-none',
                    ],
                    'constraints' => [
                        new NotBlank(['message' => 'Please select a date']),
                    ],
                ]);
                break;
            
            case 'Boolean':
                $builder->add('value', CheckboxType::class, [
                    'label' => 'Select Option',
                    'required' => false,
                    'attr' => [
                        'class' => 'form-check-input',
                    ],
                    'constraints' => [
                        new NotBlank(['message' => 'Please select an option']),
                    ],
                ]);
                break;
            
            case 'Text':
                $builder->add('value', TextareaType::class, [
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Enter detailed text',
                        'class' => 'bg-transparent block mt-10 mx-auto border-b-2 w-1/5 h-20 text-2xl outline-none',
                    ],
                    'constraints' => [
                        new NotBlank(['message' => 'Please enter text']),
                    ],
                ]);
                break;
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'attribute_type' => null,
        ]);
    }
}
