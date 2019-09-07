<?php
declare(strict_types=1);

namespace Ecolos\SyliusNutrinfoPlugin\Form\DataTransformer;

use Burgov\Bundle\KeyValueFormBundle\KeyValueContainer;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Burgov\Bundle\KeyValueFormBundle\Form\DataTransformer\HashToKeyValueArrayTransformer as BaseTransformer;

class HashToKeyValueArrayTransformer extends BaseTransformer
{
    private $useContainerObject;

    /**
     * @param bool $useContainerObject Whether to return a KeyValueContainer object or simply an array
     */
    public function __construct(bool $useContainerObject)
    {
        parent::__construct($useContainerObject);

        $this->useContainerObject = $useContainerObject;
    }

    /**
     * @param mixed $value
     * @return KeyValueContainer|array
     * @throws TransformationFailedException
     */
    public function reverseTransform($value)
    {
        $return = $this->useContainerObject ? new KeyValueContainer() : [];

        foreach ($value as $data) {
            if (['key', 'value', 'unit'] != array_keys($data)) {
                throw new TransformationFailedException;
            }

            if (array_key_exists($data['key'], $return)) {
                throw new TransformationFailedException('Duplicate key detected');
            }

            $return[$data['key']] = [
                "value" => $data['value'],
                "unit" => $data['unit']
            ];
        }

        return $return;
    }

}
