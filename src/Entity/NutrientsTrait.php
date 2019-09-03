<?php
declare(strict_types=1);

namespace Ecolos\SyliusNutrinfoPlugin\Entity;

use Doctrine\ORM\Mapping\Column;


trait NutrientsTrait
{
    /**
     * @Column(type="float")
     * @var float|null
     */
    protected $carbs;

    /**
     * @Column(type="float")
     * @var float|null
     */
    protected $fats;

    /**
     * @Column(type="float")
     * @var float|null
     */
    protected $fiber;

    /**
     * @Column(type="float")
     * @var float|null
     */
    protected $kj;

    /**
     * @Column(type="float")
     * @var float|null
     */
    protected $protein;

    /**
     * @Column(type="float")
     * @var float|null
     */
    protected $saturated;

    /**
     * @Column(type="float")
     * @var float|null
     */
    protected $salt;

    /**
     * @Column(type="float")
     * @var float|null
     */
    protected $sugar;

    public function getCarbs(): ?float
    {
        return $this->carbs;
    }

    public function setCarbs(float $carbs): void
    {
        $this->carbs = $carbs;
    }

    public function getFats(): ?float
    {
        return $this->fats;
    }

    public function setFats(float $fats): void
    {
        $this->fats = $fats;
    }

    public function getFiber(): ?float
    {
        return $this->fiber;
    }

    public function setFiber(float $fiber): void
    {
        $this->fiber = $fiber;
    }

    public function getKj(): ?float
    {
        return $this->kj;
    }

    public function setKj(float $kj): void
    {
        $this->kj = $kj;
    }

    public function getProtein(): ?float
    {
        return $this->protein;
    }

    public function setProtein(float $protein): void
    {
        $this->protein = $protein;
    }

    public function getSalt(): ?float
    {
        return $this->salt;
    }

    public function setSalt(float $salt): void
    {
        $this->salt = $salt;
    }

    public function getSaturated(): ?float
    {
        return $this->saturated;
    }

    public function setSaturated(float $saturated): void
    {
        $this->saturated = $saturated;
    }

    public function getSugar(): ?float
    {
        return $this->sugar;
    }

    public function setSugar(float $sugar): void
    {
        $this->sugar = $sugar;
    }
}
