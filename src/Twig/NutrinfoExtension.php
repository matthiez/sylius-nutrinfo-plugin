<?php
declare(strict_types=1);

namespace Ecolos\SyliusNutrinfoPlugin\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class NutrinfoExtension extends AbstractExtension
{
    private $localeCode;

    public function __construct(string $localeCode)
    {
        $this->localeCode = $localeCode;
    }

    public function getFilters()
    {
        return [
            new TwigFilter('toKcal', [$this, 'toKcal']),
            new TwigFilter('referenceIntakePct', [$this, 'referenceIntakePct']),
        ];
    }

    public function toKcal(float $kJ)
    {
        return $kJ / 4.184;
    }


    public function referenceIntakePct(float $kJ)
    {
        return 100 / 8400 * $kJ;
    }
}
