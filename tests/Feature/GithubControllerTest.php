<?php

namespace Tests\Feature;

use Tests\TestCase;
//use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Mockery;

class GithubControllerTest extends TestCase
{

    public function __construct()
    {
        parent::__construct();

        $this->mock = Mockery::mock('Eloquent', 'Post');
    }

    /**
     *Tests for Index GithubController@index action
     *
     * @return void
     */
    public function testIndex()
    {

        $this->mock
            ->shouldReceive('orderBy')->once()
            ->shouldReceive('paginate')->once()
            ->andReturn(Illuminate\Pagination\LengthAwarePaginator::class);

        $this->app->instance('GithubRepo', $this->mock);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertDontSeeText('No items found. Please try fetch first.');

        $response->assertViewHas('repos');

        $repos = $response->original->getData()['repos'];
        $this->assertInstanceOf('Illuminate\Pagination\LengthAwarePaginator', $repos);

    }

    /**
     * Tests for Index GithubController@repo action
     *
     * @return void
     */
    public function testRepo()
    {

        $this->mock
            ->shouldReceive('where')->once()
            ->shouldReceive('firstOrFail')->once()
            ->andReturn('asd');

        $this->app->instance('GithubRepo', $this->mock);

        $response = $this->get('/repo/128818');

        $response->assertStatus(200);
        $response->assertDontSeeText('Sorry, the page you are looking for could not be found.');

        $response->assertViewHas('repo');

        $repo = $response->original->getData()['repo'];

        $this->assertInstanceOf('App\GithubRepo', $repo);

    }
}
