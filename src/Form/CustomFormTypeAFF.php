<?php


namespace App\Form;

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
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CustomFormTypeAFF extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $customForms = $options['custom_forms'];

        foreach ($customForms as $customForm) {
            $fieldType = $customForm->getFieldType();
            $fieldOptions = [
                'label' => $customForm->getFieldLabel(),
                'required' => false,
            ];

            switch ($fieldType) {
                case 'text':
                case 'email':
                case 'number':
                case 'date':
                case 'time':
                case 'datetime':
                case 'url':
                case 'tel':
                    $builder->add($customForm->getFieldLabel(), TextType::class, $fieldOptions);
                    break;
                case 'range':
                    $builder->add($customForm->getFieldLabel(), RangeType::class, $fieldOptions);
                    break;
                case 'color':
                    $builder->add($customForm->getFieldLabel(), ColorType::class, $fieldOptions);
                    break;
                case 'checkbox':
                    $builder->add($customForm->getFieldLabel(), CheckboxType::class, $fieldOptions);
                    break;
                case 'radio':
                    $builder->add($customForm->getFieldLabel(), RadioType::class, $fieldOptions);
                    break;
                case 'file':
                    $builder->add($customForm->getFieldLabel(), FileType::class, $fieldOptions);
                    break;
                case 'textarea':
                    $builder->add($customForm->getFieldLabel(), TextareaType::class, $fieldOptions);
                    break;
                case 'select':
                    $builder->add($customForm->getFieldLabel(), SelectType::class, array_merge($fieldOptions, [
                        'choices' => $customForm->getChoices(), // Assuming you have a method to get choices
                        'placeholder' => 'Select an option',
                    ]));
                    break;
                case 'hidden':
                    $builder->add($customForm->getFieldLabel(), HiddenType::class, $fieldOptions);
                    break;
                case 'button':
                    $builder->add($customForm->getFieldLabel(), ButtonType::class, $fieldOptions);
                    break;
                case 'submit':
                    $builder->add($customForm->getFieldLabel(), SubmitType::class, $fieldOptions);
                    break;
                default:
                    $builder->add($customForm->getFieldLabel(), TextType::class, $fieldOptions); // Default type
            }
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
            'custom_forms' => [],
        ]);
    }
}
