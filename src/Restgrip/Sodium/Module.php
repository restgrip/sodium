<?php
namespace Restgrip\Sodium;

use Restgrip\Module\ModuleAbstract;
use Restgrip\Sodium\Service\SodiumService;

/**
 * @package   Restgrip\Sodium
 * @author    Sarjono Mukti Aji <me@simukti.net>
 */
class Module extends ModuleAbstract
{
    /**
     * @var array
     */
    protected $defaultServices = [
        SodiumService::class,
    ];
}