<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\libraries\Github;
use App\GithubRepo;

class GithubController extends Controller
{

    protected $repos;

    public function __construct(GithubRepo $repos)
    {
        $this->repos = $repos;
    }

    /**
     * Show the list of Repositories from DB
     * Get data sorted by most starred
     *
     * @return Response
     */

    public function index()
    {
        $repos = $this->repos->orderBy('stars', 'desc')->paginate(intval(env('APP_ITEMS_PER_PAGE', 10)));
        return View('repos', compact('repos'));
    }

    /**
     * Show the details for the given repo_id.
     *
     * @param  int  $id
     * @return Response
     */
    public function repo($id)
    {
        $repo = $this->repos->where('repo_id', '=', $id)->firstOrFail();
        return view('repo', compact('repo'));
    }

    /**
     * Fetch the latest details from github API
     *
     * @return true/false
     * @uses App\libraries\Github
     */
    public function fetch()
    {

        $github = new \App\libraries\Github(env('GITHUB_REPO_SEARCH_API'), env('GITHUB_USERAGENT'), env('GITHUB_TOKEN'));

        //if empty or timeout
        if (empty($github)) {
            //throw error and fallback to cached data
            return false;
        }

        //assume everything fails
        $api_reponse = false;

        /*
         * Github provides only 100 items in a call
         * And api has limits
         * 30 request per minute and 1000 max
         * loop until fist failed response
         */
        while($github->getRepoPage()) {
            // atleast one fetch happend
            $api_reponse = true;
            $repoArray = $github->buildRepoArray();
            if(!GithubRepo::insertOrUpdate($repoArray)) {
                //failed , no need to continue until we fix failure
                echo false;exit;
            }

        }

        echo $api_reponse;
    }
}
