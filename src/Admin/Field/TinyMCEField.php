<?php
namespace App\Admin\Field;

use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;
use EasyCorp\Bundle\EasyAdminBundle\Config\Asset;

use App\Form\TinyMCEType;

final class TinyMCEField implements FieldInterface
{
    use FieldTrait;

    public static function new(string $propertyName, $label = null): self
    {
        return (new self())
            ->setProperty($propertyName)
            ->setLabel($label)

            ->setTemplatePath('bundles/EasyAdminBundle/text_editor.html.twig')
            ->setFormType(TextareaType::class)

            ->addJsFiles('bundles-extra/tinymce/tinymce.min.js')
            ->addJsFiles('js/tinymce.js')
        ;
    }
}