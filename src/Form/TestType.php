<?php

namespace App\Form;

use App\Entity\ItemIntegerTypeAttribute;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class TestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $data = $options['data'];
        if ($data)
        {
            $builder
                ->add('value', IntegerType::class);
            // ->add('value', IntegerType::class, [
            //     'label' => false,
            //     'attr' => [
            //         'placeholder' => 'Attr value',
            //         'class' => 'bg-transparent block mt-10 mx-auto border-b-2 w-1/5 h-20 text-2xl outline-none',
            //     ],
            //     'constraints' => [
            //         new NotBlank([
            //             'message' => 'Please enter something',
            //         ]),
            //     ],
            // ])
            // ;
        }
    }

    // public function configureOptions(OptionsResolver $resolver): void
    // {
    //     $resolver->setDefaults([
    //         'data_class' => IntegerType::class,
    //     ]);
    // }
}
