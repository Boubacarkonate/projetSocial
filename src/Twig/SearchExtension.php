<?php

namespace App\Twig;

use App\Repository\CvRepository;
use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;



class SearchExtension extends AbstractExtension
{
    private $cvRepository;

    public function __construct(CvRepository $cvRepository)
    {
        $this->cvRepository = $cvRepository;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('search', [$this, 'getCv'])
        ];
    }

    public function getCategorie()
    {
        return $this->cvRepository->findAll();
    }
}