<?php

namespace SimonWessel\TeamCityApi;

use Httpful\Request;
use SimonWessel\TeamCityApi\Entities\BuildStatus;
use Httpful\Response;
use SimonWessel\TeamCityApi\Entities\Project;

class TeamCityApi
{

    /**
     * URL of the TeamCity instance
     * @var string
     */
    protected $url;

    protected $username;

    protected $password;

    public function __construct($url, $username, $password)
    {
        $this->url = $url;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Builds API call
     * @param $path
     * @param string $method
     * @param string $body
     * @return Response
     * @throws \Exception
     */
    protected function apiCall($path, $method = 'GET', $body = null)
    {
        if ($this->url === null)
            throw new \Exception("No teamcity URL defined");

        $uri = $this->url . '/httpAuth' . $path;

        /** @var Response $response */
        $response = Request::init($method)
            ->uri($uri)
            ->body($body)
            ->authenticateWith($this->username, $this->password)
            ->send();

        // ToDo: custom exceptions
        if ($response->code !== 200 && !($response->body instanceof \SimpleXMLElement)) {
            if (!empty(trim($response->raw_body)))
                throw new \Exception(sprintf("Got non-XML result: %s", $response->raw_body));

            throw new Exception(sprintf("Got response code %s", $response->code));
        }

        return $response;
    }

    /**
     * Returns the build history order by time descending
     * @return BuildStatus[]
     */
    public function getBuilds()
    {
        $response = $this->apiCall("/app/rest/builds");
        $result = array();

        /** @var \SimpleXMLElement $element */
        foreach ($response->body as $element)
            $result[] = new BuildStatus(current($element->attributes()));

        return $result;
    }

    /**
     * Starts a build with the given build type identifier
     * @param string $buildTypeId
     * @return Response
     */
    public function startBuild($buildTypeId)
    {
        $url = sprintf("/action.html?add2Queue=%s", $buildTypeId);

        return $this->apiCall($url, 'POST');
    }

    /**
     * Returns all projects
     * @return Project[]
     */
    public function getProjects()
    {
        $response = $this->apiCall("/app/rest/projects");
        $result = array();

        foreach ($response->body as $element)
            $result[] = new Project(current($element->attributes()));

        return $result;
    }

}
