<?php
namespace Faker\Provider;

class Item extends \Faker\Provider\Base
{

    protected static $item = array(
        'Hammer',
        'Light Bulb',
        'Synthetic Turf',
        'Brick',
        'Clippers',
        'Lawn Mower',
        'Weed Spray',
        'Nails',
        'Weed Whacker',
        'Protective Gear',
        'Work Gloves',
        'Nail Gun'
    );

    public function item(){
        return static::randomElement(static::$item);
    }
}