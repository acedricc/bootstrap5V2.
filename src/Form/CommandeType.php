<?php

namespace App\Form;

use App\Entity\Commande;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType as TypeDateTimeType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('montant', MoneyType::class)
        ->add('date_enregistrement', TypeDateTimeType::class, [
            "widget" => "single_text"
        ])
        ->add('etat', ChoiceType::class, [
            "choices" => [
                "En attente" => "attente",
                "En cours de livraison" => "en cours",
                "Livrée"    => "livrée",
                "Payée"     => "payée",
                "Annulée"   => "annulée"
            ],
            "expanded"  => true
        ])
        ->add('user', EntityType::class, [
            "class"         => User::class,
            "choice_label"  => "pseudo",
            "placeholder"   => ""
        ])
    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
