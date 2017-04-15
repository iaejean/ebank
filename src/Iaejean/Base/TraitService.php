<?php
namespace Iaejean\Base;

use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation as DI;
use Psr\Log\LoggerInterface;

/**
 * Class TraitService
 * @package Iaejean\Base
 */
trait TraitService
{
    /**
     * @var EntityManager
     * @DI\Inject("doctrine.orm.entity_manager")
     */
    public $entityManager;

    /**
     * @var LoggerInterface
     * @DI\Inject("logger")
     */
    public $logger;
}
