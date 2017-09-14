<?php

namespace SimonWessel\TeamCityApi\Entities;

/**
 * Class BuildStatus
 * @package SimonWessel\TeamCityApi
 */
class BuildStatus extends TeamCityObject
{

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $buildTypeId;

    /**
     * @var int
     */
    public $number;

    /**
     * @var string
     */
    public $status;

    /**
     * @var string
     */
    public $state;

    /**
     * @var string
     */
    public $href;

    /**
     * @var string
     */
    public $webUrl;

}
