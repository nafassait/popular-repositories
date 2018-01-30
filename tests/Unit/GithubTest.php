<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use App\libraries\Github;

class GithubTest extends TestCase
{

    private $testjson, $testresponse;

    /**
     * Method for setup required data for each test
     *
     */
    public function setUp()
    {
        $this->setTestData();
    }

    /**
     * Tests for repo array build
     *
     * @return void
     */
    public function testbuildRepoArray()
    {
        $dummyData = json_decode($this->testjson);

        $mockGitHub = Mockery::mock(new \App\libraries\Github('example.com', 'example', 'example'));
        $this->assertEquals($dummyData, $mockGitHub->setRepoItems($dummyData));

        $this->assertEquals($this->testresponse, $mockGitHub->buildRepoArray());

    }

    /**
     * Test for getrepo method
     *
     * @return void
     */
    public function testGetRepo()
    {

        $mockGitHub = Mockery::mock(new \App\libraries\Github(env('GITHUB_REPO_SEARCH_API'), env('GITHUB_USERAGENT'), env('GITHUB_TOKEN')));
        $mockGitHub->shouldReceive('curlRequest')->andReturn(10);

        $this->assertNotEmpty($mockGitHub->getRepo());
    }


    /**
     * A helper method to keep dummy data used for assertion  checks
     */
    public function setTestData() {
        $this->testjson = '{
              "total_count": 1523926,
              "incomplete_results": false,
              "items": [
                {
                  "id": 1863329,
                  "name": "laravel",
                  "full_name": "laravel/laravel",
                  "owner": {
                    "login": "laravel",
                    "id": 958072,
                    "avatar_url": "https://avatars3.githubusercontent.com/u/958072?v=4",
                    "gravatar_id": "",
                    "url": "https://api.github.com/users/laravel",
                    "html_url": "https://github.com/laravel",
                    "followers_url": "https://api.github.com/users/laravel/followers",
                    "following_url": "https://api.github.com/users/laravel/following{/other_user}",
                    "gists_url": "https://api.github.com/users/laravel/gists{/gist_id}",
                    "starred_url": "https://api.github.com/users/laravel/starred{/owner}{/repo}",
                    "subscriptions_url": "https://api.github.com/users/laravel/subscriptions",
                    "organizations_url": "https://api.github.com/users/laravel/orgs",
                    "repos_url": "https://api.github.com/users/laravel/repos",
                    "events_url": "https://api.github.com/users/laravel/events{/privacy}",
                    "received_events_url": "https://api.github.com/users/laravel/received_events",
                    "type": "Organization",
                    "site_admin": false
                  },
                  "private": false,
                  "html_url": "https://github.com/laravel/laravel",
                  "description": "A PHP Framework For Web Artisans",
                  "fork": false,
                  "url": "https://api.github.com/repos/laravel/laravel",
                  "forks_url": "https://api.github.com/repos/laravel/laravel/forks",
                  "keys_url": "https://api.github.com/repos/laravel/laravel/keys{/key_id}",
                  "collaborators_url": "https://api.github.com/repos/laravel/laravel/collaborators{/collaborator}",
                  "teams_url": "https://api.github.com/repos/laravel/laravel/teams",
                  "hooks_url": "https://api.github.com/repos/laravel/laravel/hooks",
                  "issue_events_url": "https://api.github.com/repos/laravel/laravel/issues/events{/number}",
                  "events_url": "https://api.github.com/repos/laravel/laravel/events",
                  "assignees_url": "https://api.github.com/repos/laravel/laravel/assignees{/user}",
                  "branches_url": "https://api.github.com/repos/laravel/laravel/branches{/branch}",
                  "tags_url": "https://api.github.com/repos/laravel/laravel/tags",
                  "blobs_url": "https://api.github.com/repos/laravel/laravel/git/blobs{/sha}",
                  "git_tags_url": "https://api.github.com/repos/laravel/laravel/git/tags{/sha}",
                  "git_refs_url": "https://api.github.com/repos/laravel/laravel/git/refs{/sha}",
                  "trees_url": "https://api.github.com/repos/laravel/laravel/git/trees{/sha}",
                  "statuses_url": "https://api.github.com/repos/laravel/laravel/statuses/{sha}",
                  "languages_url": "https://api.github.com/repos/laravel/laravel/languages",
                  "stargazers_url": "https://api.github.com/repos/laravel/laravel/stargazers",
                  "contributors_url": "https://api.github.com/repos/laravel/laravel/contributors",
                  "subscribers_url": "https://api.github.com/repos/laravel/laravel/subscribers",
                  "subscription_url": "https://api.github.com/repos/laravel/laravel/subscription",
                  "commits_url": "https://api.github.com/repos/laravel/laravel/commits{/sha}",
                  "git_commits_url": "https://api.github.com/repos/laravel/laravel/git/commits{/sha}",
                  "comments_url": "https://api.github.com/repos/laravel/laravel/comments{/number}",
                  "issue_comment_url": "https://api.github.com/repos/laravel/laravel/issues/comments{/number}",
                  "contents_url": "https://api.github.com/repos/laravel/laravel/contents/{+path}",
                  "compare_url": "https://api.github.com/repos/laravel/laravel/compare/{base}...{head}",
                  "merges_url": "https://api.github.com/repos/laravel/laravel/merges",
                  "archive_url": "https://api.github.com/repos/laravel/laravel/{archive_format}{/ref}",
                  "downloads_url": "https://api.github.com/repos/laravel/laravel/downloads",
                  "issues_url": "https://api.github.com/repos/laravel/laravel/issues{/number}",
                  "pulls_url": "https://api.github.com/repos/laravel/laravel/pulls{/number}",
                  "milestones_url": "https://api.github.com/repos/laravel/laravel/milestones{/number}",
                  "notifications_url": "https://api.github.com/repos/laravel/laravel/notifications{?since,all,participating}",
                  "labels_url": "https://api.github.com/repos/laravel/laravel/labels{/name}",
                  "releases_url": "https://api.github.com/repos/laravel/laravel/releases{/id}",
                  "deployments_url": "https://api.github.com/repos/laravel/laravel/deployments",
                  "created_at": "2011-06-08T03:06:08Z",
                  "updated_at": "2018-01-29T17:51:44Z",
                  "pushed_at": "2018-01-27T17:01:05Z",
                  "git_url": "git://github.com/laravel/laravel.git",
                  "ssh_url": "git@github.com:laravel/laravel.git",
                  "clone_url": "https://github.com/laravel/laravel.git",
                  "svn_url": "https://github.com/laravel/laravel",
                  "homepage": "https://laravel.com",
                  "size": 8969,
                  "stargazers_count": 38391,
                  "watchers_count": 38391,
                  "language": "PHP",
                  "has_issues": false,
                  "has_projects": true,
                  "has_downloads": true,
                  "has_wiki": false,
                  "has_pages": false,
                  "forks_count": 12441,
                  "mirror_url": null,
                  "archived": false,
                  "open_issues_count": 27,
                  "license": null,
                  "forks": 12441,
                  "open_issues": 27,
                  "watchers": 38391,
                  "default_branch": "master",
                  "score": 1.0
                }
              ]
            }';

        $this->testresponse = array(0 => array(
            "repo_id" => 1863329,
            "name" => "laravel/laravel",
            "url" => "https://github.com/laravel/laravel",
            "created_at" => "2011-06-08 03:06:08",
            "last_push_date" => "2018-01-27 17:01:05",
            "description" => "A PHP Framework For Web Artisans",
            "stars" => 38391
        ));
    }
}
