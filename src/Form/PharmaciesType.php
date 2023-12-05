<?php

namespace App\Form;

use App\Entity\Pharmacies;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PharmaciesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom')
        ->add('adresse')
        ->add('telephone')
        ->add('region',ChoiceType::class,[
            'choices'  => [
                'Dakar'=> 'Dakar',
                'Diourbel'=> 'Diourbel',
                'Fatick'=> 'Fatick',
                'Kaolack'=> 'Kaolack',
                'Kolda'=> 'Kolda',
                'Louga'=> 'Louga',
                'Matam'=> 'Matam',
                'Saint-Louis'=> 'Saint-Louis',
                'Tambacounda'=> 'Tambacounda',
                'Thiès'=> 'Thiès',
                'Ziguinchor'=> 'Ziguinchor',
                'Kaffrine'=> 'Kaffrine',
                'Kédougou'=> 'Kédougou',
                'Sédhiou'=> 'Sédhiou'
            ],])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pharmacies::class,
        ]);
    }
}
