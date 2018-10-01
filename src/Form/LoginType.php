<?php
namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class LoginType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', TextType::class, $options["username_options"])
            ->add('password', PasswordType::class, $options["password_options"])
            ->add("login", SubmitType::class, $options["login_options"]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
            'username_options' => [],
            'password_options' => [],
            'login_options' => [
                "attr" => [
                    "class" => "btn btn-primary"
                ]
            ],
            'attr' => [
                'novalidate' => true
            ]
        ]);
    }
}
