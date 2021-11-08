<?php

namespace Vehicle\Mapper;

use Aqilix\ORM\Mapper\AbstractMapperFactory as ORMAbstractMapperFactory;

/**
 * Abstract Mapper with Doctrine support
 *
 * @author Arif Rahman Hakim <harifrahman999@gmail.com>
 */
class AbstractMapperFactory extends ORMAbstractMapperFactory
{
    protected $mapperPrefix = 'Vehicle\\Mapper';
}
