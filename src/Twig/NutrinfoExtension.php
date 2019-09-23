<?php
declare(strict_types=1);

namespace Ecolos\SyliusNutrinfoPlugin\Twig;

use Ecolos\SyliusNutrinfoPlugin\Entity\Nutrinfo;
use Ecolos\SyliusNutrinfoPlugin\Entity\NutrinfoActive;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class NutrinfoExtension extends AbstractExtension
{
    /** @var string $localeCode */
    private $localeCode;

    /** @var RepositoryInterface $nutrinfoActiveRepository */
    private $nutrinfoActiveRepository;

    public function __construct(string $localeCode, RepositoryInterface $nutrinfoActiveRepository)
    {
        $this->localeCode = $localeCode;
        $this->nutrinfoActiveRepository = $nutrinfoActiveRepository;
    }

    public const RECOMMENDED_VALUES = [
        "fats" => 70,
        "saturated" => 20,
        "carbs" => 260,
        "sugar" => 90,
        "protein" => 50,
        "salt" => 6,
        "kj" => 8374,
        "kcal" => 2000,
    ];

    public function getFilters()
    {
        return [
            new TwigFilter('toKcal', [$this, 'toKcal']),
            new TwigFilter('referenceIntakePct', [$this, 'referenceIntakePct']),
            new TwigFilter('transformBase', [$this, 'transformBase']),
            new TwigFilter('transformBaseUnit', [$this, 'transformBaseUnit']),
            new TwigFilter('toPortion', [$this, 'toPortion']),
            new TwigFilter('toReferenceIntake', [$this, 'toReferenceIntake']),
            new TwigFilter('getActives', [$this, 'getActives']),
        ];
    }

    public function toKcal(float $kJ): float
    {
        return $kJ / 4.184;
    }


    public function referenceIntakePct(float $kJ): float
    {
        return 100 / 8400 * $kJ;
    }

    public function transformBase(Nutrinfo $nutrinfo): float
    {
        $base = $nutrinfo->getBase();
        $baseUnit = $nutrinfo->getBaseUnit();

        $convert = [
            'mg' => function () use ($base) {
                return $base / 1000;
            }
        ];

        return isset($convert[$baseUnit]) ? $convert[$baseUnit]() : $base;
    }

    public function transformBaseUnit(Nutrinfo $nutrinfo): string
    {
        $baseUnit = $nutrinfo->getBaseUnit();

        $convert = [
            'mg' => 'g'
        ];

        return isset($convert[$baseUnit]) ? $convert[$baseUnit] : $baseUnit;
    }

    public function toPortion($servingSize, $value): float
    {
        return (float)number_format($value / (100 / $servingSize), 1);
    }

    public function toReferenceIntake(string $key, $value): float
    {
        $value = (float)$value;

        if (isset(self::RECOMMENDED_VALUES[$key])) {
            $value = number_format((100 / self::RECOMMENDED_VALUES[$key] * $value), 1);

        }

        return (float)$value;
    }

    public function getActives($ids): array
    {
        if (!is_array($ids)) {
            $ids = [(int)$ids];
        }

        $activeIngredients = [];

        $idCount = count($ids);

        if (1 === $idCount) {
            /** @var NutrinfoActive|null $activeIngredient */
            $activeIngredient = $this->nutrinfoActiveRepository->find($ids[0]);
            if (null !== $activeIngredient) {
                $activeIngredients[] = $activeIngredient;
            }
        } elseif (1 < $idCount) {
            $activeIngredients = $this->nutrinfoActiveRepository->findBy(['id' => $ids]);
        }

        return $activeIngredients;
    }
}
