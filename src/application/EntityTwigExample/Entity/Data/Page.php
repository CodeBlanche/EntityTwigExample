<?php

namespace EntityTwigExample\Entity\Data;

use EntityTwigExample\Entity\Entity;

class Page extends Entity
{
    /**
     * @var string
     */
    public $title = 'no title';

    /**
     * @var string
     */
    public $bodyId = 'no id';

    /**
     * @var \EntityTwigExample\Entity\Data\Menu
     */
    public $menu;

    /**
     * @param string $title
     */
    function __construct($title)
    {
        parent::__construct();

        $this->title = $title;
    }
}
