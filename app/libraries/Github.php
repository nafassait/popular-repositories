<?php

namespace App\libraries;

use Exception;

/**
 * Class Github
 *
 * Class connects to Github's Search API using Curl requests
 * Manages and format data
 * needed for requests and data returned from API.
 * repositories returned from Github's API.
 *
 * @package App\libraries
 */
class Github
{
	/**
	 * Github's API URL with defined PHP request variables
	 *
	 * @var string
	 */
	private $reposPerPage = 100;
	private $repos;
	private $apiUrl, $useragent, $token;
	
	public $page = 1;

	/**
	 * Github constructor call
     *
     * @param string $api api url
     * @param string $useragrent
     * @param string $token git auth token
     *
	 */
	public function __construct($api, $useragent, $token)
	{
        $this->apiUrl = "{$api}?q=language:php&sort=stars&order=desc&per_page={$this->reposPerPage}&page=";
	    $this->useragent = $useragent;
	    $this->token = $token;
	}

	/**
	 * Executes a Curl request to retrieve repository data
	 *
	 * @param $url
	 * @return mixed data obj
	 */
	public function curlRequest($url)
	{

        try {
            $curl = curl_init($url);

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($curl, CURLOPT_USERAGENT, $this->useragent);
            curl_setopt($curl, CURLOPT_HTTPHEADER, ['Authorization: token ' . $this->token]);

            $curlResponse = curl_exec($curl);
            $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if ($curlResponse === false || ($http_status != 200 ) ) {
                throw new Exception("API issue or Invalid config. Response status: ".$http_status. ' CURL Response'.print_r($curlResponse, true));
            }

            curl_close($curl);

        } catch(Exception $e){
            report($e);
        }

		return json_decode($curlResponse);
	}

	/**
     * Retrieve a page of PHP starred repositories from the Github API
     *
     * @return bool
     */
	public function getRepoPage()
	{

		$this->repos = $this->getRepo();
		$this->nextPage();

		if (empty($this->repos)) {
		    return false;
        }

        return true;
	}

    /**
     * Get Repo Details from github
     * uses config details to fetch api details
     *
     * @return bool|mixed
     */

	public function getRepo() {

	    $repoBundle = $this->curlRequest($this->apiUrl . $this->page);

	    //API limit reached and no more items
        if (empty($repoBundle->items)) {
            return false;
        }

        return $repoBundle;
    }

	/**
	 * Increments the 'page' parameter by one for Github API requests
	 */
	private function nextPage()
	{
		$this->page++;
	}

	/**
	 * Builds an array of the Github repository, formatted for the DB
	 *
	 * @return array
	 */
	public function buildRepoArray()
	{

	    if (empty($this->repos->items))
	        return false;

        $repoArray = [];

	    foreach ($this->repos->items as $repo) {
            $repoArray [] = [
                'repo_id' => $repo->id,
                'name' => $repo->full_name,
                'url' => $repo->html_url,
                'created_at' => date("Y-m-d H:i:s", strtotime($repo->created_at)),
                'last_push_date' => date("Y-m-d H:i:s", strtotime($repo->pushed_at)),
                'description' => $repo->description,
                'stars' => $repo->stargazers_count
            ];
        }

		return $repoArray;
	}

    /**
     * A helper method to enable custom data,
     * useful for validation and unit testing
     *
     * @param $data
     * @return mixed
     */
    public function setRepoItems($data)
    {
        $this->repos = $data;

        return $this->repos;
    }
}