<?php
namespace Restgrip\Sodium\Service;

use Phalcon\DiInterface;

/**
 * @method DiInterface getDi()
 * @package   Restgrip\Sodium\Service
 * @author    Sarjono Mukti Aji <me@simukti.net>
 */
trait SodiumServiceTrait
{
    /**
     * @return SodiumService
     */
    public function getSodiumService()
    {
        return $this->getDi()->getShared(SodiumService::class);
    }
}