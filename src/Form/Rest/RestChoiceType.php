<?php

namespace Evrinoma\UtilsBundle\Form\Rest;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class RestChoiceType
 *
 * @package Evrinoma\UtilsBundle\Rest\Form
 */
class RestChoiceType extends AbstractType
{
//region SECTION: Fields
    public const REST_DESCRIPTION    = 'rest_description';
    public const REST_CHOICES        = 'rest_choices';
    public const REST_COMPONENT_NAME = 'rest_component_name';
    public const REST_DEFAULT        = 'rest_default';
//endregion Fields

//region SECTION: Public
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            $options[self::REST_COMPONENT_NAME],
            ChoiceType::class,
            [
                'documentation' => [
                    'description' => $options[self::REST_DESCRIPTION],
                    'default'     => $options[self::REST_DEFAULT],
                  ///  'format'      => self::REST_CHOICES,
                ],
                'choices'       => $options[self::REST_CHOICES],
            ]
        )->addViewTransformer(
            new CallbackTransformer(
                function ($value) {
                    // transform the array to a string
                    return $value === '' ? null : $value;
                },
                function ($value) {
                    // transform the string back to an array
                    return $value ?? '';
                }
            )
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired([self::REST_COMPONENT_NAME, self::REST_CHOICES, self::REST_DESCRIPTION]);
        $resolver->setDefault(self::REST_DEFAULT, '--');
        $resolver->setDefault('compound', true);
    }
//endregion Public

//region SECTION: Getters/Setters
    public function getParent()
    {
        return ChoiceType::class;
    }
//endregion Getters/Setters
}