<?php
namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Valid;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Genders;
use App\Entity\Prefs;

class UsersType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', TextType::class, $options["username_options"])
            ->add('password', TextType::class, $options["password_options"])
            ->add('email', EmailType::class, $options["email_options"])
            ->add("gender", EntityType::class, $options["gender_options"])
            ->add("pref", EntityType::class, $options["pref_options"]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
            'attr' => [
                'novalidate' => true
            ],
            'username_options' => [
                "constraints" => [
                    new Valid\NotBlank(),
                    new Valid\Length([
                        'min' => 5,
                        'max' => 50
                    ])
                ]
            ],
            'password_options' => [
                "constraints" => [
                    new Valid\NotBlank(),
                    new Valid\Length([
                        'min' => 8,
                        'max' => 255
                    ])
                ]
            ],
            'email_options' => [
                "constraints" => [
                    new Valid\NotBlank(),
                    new Valid\Length([
                        'min' => 8,
                        'max' => 255
                    ]),
                    new Valid\Email()
                ]
            ],
            'gender_options' => [
                'expanded' => false,
                'multiple' => false,
                'class' => Genders::class,
                'choice_label' => 'name'
            ],
            'pref_options' => [
                'expanded' => false,
                'multiple' => false,
                'class' => Prefs::class,
                'choice_label' => 'name'
            ]
        ]);
    }
}
