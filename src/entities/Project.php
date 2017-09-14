<?php

namespace SimonWessel\TeamCityApi\Entities;

/**
 * Class Project
 * @package SimonWessel\TeamCityApi
 */
class Project extends TeamCityObject
{

    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $href;

    /**
     * @var string
     */
    public $webUrl;

}
