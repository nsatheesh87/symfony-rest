<?php
namespace ImageProcessorBundle\Form\DataTransformer;

use ImageProcessorBundle\Entity\Image;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class Base64ToFileTransformer implements DataTransformerInterface
{
    private $entityManager;

    /**
     * Transforms an object (issue) to a string (number).
     *
     * @param  Issue|null $issue
     * @return string
     */
    public function transform($image)
    {
        dump($image); exit;
    }

    /**
     * Transforms a string (number) to an object (issue).
     *
     * @param  string $issueNumber
     * @return Issue|null
     * @throws TransformationFailedException if object (issue) is not found.
     */
    public function reverseTransform($issueNumber)
    {


    }
}