EntityTwigExample
=================

How to use CodeBlanche/Entity in combination with fabpot/Twig

Install
-------

Clone this repository to your server/pc and ```cd``` into the project directory. If not already available you can install composer using ```curl -sS https://getcomposer.org/installer | php``` or following the instructions provided at http://getcomposer.org/download/. Install the necessary dependancies with ```composer.phar install```.


Overview
--------

### public/bootstrap.php

Here we create the Twig instance to process the templates and build the data array. At the writing of this example, Twig requires that the root input to the template renderer is an array. Values within this array however may be ArrayAccess(able) objects.

We can now build an array of Entities containing the data structure required for our templates.

### src/application/EntityTwigExample/Entity/Entity.php

This is our Entity proxy where we can add our own custom behaviours or override the default behaviours of CodeBlanche/Entity. In this example we have : 
* implement the ArrayAccess interface
* changed the default marshal from Strict (checks everything) to Typed (Only tries to cast to specific types but beyond that anything goes)
* overridden the get and __isset methods to permit some lazy loading magic
* and added the __toString method so we can automatically cast the object to a string for output.

### src/application/EntityTwigExample/Entity/Data/*.php

These are our Entities where we either override the constructor to dynamically load data upon class creation, or just override the constructor arguments so we can make the constructor argument more specific to the entities needs.

**Important: Class type definitions must be fully qualified until these can be resolved dynamically. See src/application/EntityTwigExample/Entity/Data/Page.php:20 for an example.**
