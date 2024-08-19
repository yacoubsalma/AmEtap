<?php
namespace App\Form;

use App\Entity\CustomForm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SelectType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType; // Add this line

class CustomFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fieldLabel', TextType::class, [
                'label' => 'Label du champ',
            ])
            ->add('fieldType', ChoiceType::class, [
                'label' => 'Type de champ',
                'choices' => [
                    'Texte' => 'text',
                    'Email' => 'email',
                    'Nombre' => 'number',
                    'Date' => 'date',
                    'Heure' => 'time',
                    'Date et Heure' => 'datetime',
                    'URL' => 'url',
                    'Téléphone' => 'tel',
                    'Plage' => 'range',
                    'Couleur' => 'color',
                    'Case à cocher' => 'checkbox',
                    'Bouton radio' => 'radio',
                    'Fichier' => 'file',
                    'Zone de texte' => 'textarea',
                    'Liste déroulante' => 'select',
                    'Caché' => 'hidden',
                    'Bouton' => 'button',
                    'Soumettre' => 'submit',
                ],
                'placeholder' => 'Choisissez un type de champ',
            ])
            ->add('save', SubmitType::class, [ // Use SubmitType directly
                'label' => 'Créer le formulaire',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CustomForm::class,
        ]);
    }
}
