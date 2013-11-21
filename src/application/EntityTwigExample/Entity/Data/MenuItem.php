<?php

namespace EntityTwigExample\Entity\Data;

use EntityTwigExample\Entity\Entity;

class MenuItem extends Entity
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $href;

    /**
     * @param string $name
     * @param string $href
     */
    function __construct($name, $href = '')
    {
        parent::__construct();

        if (empty($href)) {
            $href = '/' . $name;
        }

        $this->name = $name;
        $this->href = $href;
    }
}
