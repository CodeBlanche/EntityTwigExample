<?php

use EntityTwigExample\Entity\Data\Page;

require __DIR__ . '/../bootstrap.php';

ini_set('display_errors', '1');
ini_set('error_reporting', 6143);

class EntityTwigExampleBootstrap
{
    /**
     * @var Twig_Environment
     */
    protected $twig;

    /**
     * @var array
     */
    protected $data;

    /**
     * Default constructor
     */
    public function __construct()
    {
        $this->twig = new Twig_Environment(
            new Twig_Loader_Filesystem(__DIR__),
            array(
                'cache'       => __DIR__ . '/../cache/twig',
                'auto_reload' => true,
            )
        );

        $this->data = array(
            'page' => new Page('testing'),
        );
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->twig->render('template.twig', $this->data);
    }
}

echo new EntityTwigExampleBootstrap();
