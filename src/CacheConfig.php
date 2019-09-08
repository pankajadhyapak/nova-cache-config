<?php

namespace Pankajadhyapak\CacheConfig;

use Illuminate\Support\Facades\Cache;
use Laravel\Nova\Card;

class CacheConfig extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = '1/3';

    private $key;
    private $defaultValue;
    private $name;
    private $type;

    /**
     * CacheConfig constructor.
     * @param $name
     * @param $key
     * @param $defaultValue
     * @param $type
     */
    public function __construct($name, $key, $defaultValue, $type)
    {
        $this->key = $key;
        $this->defaultValue = $defaultValue;
        $this->name = $name;
        $this->type = $type;

        $this->withMeta([
            "name" => $this->name,
            "defaultValue" => $this->defaultValue,
            "key" => $this->key,
            "type" => $this->type,
            "currentValue" => Cache::get($this->key, $this->defaultValue)
        ]);
    }


    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'cache-config';
    }
}
