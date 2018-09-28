<?php
namespace App\FormType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class PlainTextType extends AbstractType
{

    /**
     *
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            // hidden fields cannot have a required attribute
            'required' => false,
            // Pass errors to the parent
            'error_bubbling' => true,
            'compound' => false,
            'widget' => 'single_text',
            'html5' => false,
            'attr' => [
                'readonly' => true
            ]
        ));
    }

    /**
     *
     * {@inheritdoc}
     */
    public function getParent()
    {
        return DateTimeType::class;
    }

    /**
     *
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'plain_text';
    }
}
