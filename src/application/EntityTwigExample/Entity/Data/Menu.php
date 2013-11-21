<?php

namespace EntityTwigExample\Entity\Data;

use EntityTwigExample\Entity\Entity;

class Menu extends Entity
{
    public function __construct()
    {
        parent::__construct();

        $data = array(
            new MenuItem('home'),
            new MenuItem('about'),
            new MenuItem('other'),
            new MenuItem('contact'),
        );

        $this->fromArray($data);
    }
}
