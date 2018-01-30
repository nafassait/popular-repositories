@extends('layout.master')

@section('content')

    <div class="container repos">

        <ul class="list-group list-group-flush mb-3">
        @forelse($repos as $repo)
                <li class="list-group-item">
                    <h4><a href="{{action('GithubController@repo', ['id' => $repo->repo_id]) }}" >{{ $repo->name }}</a></h4>
                    <p>{{ str_limit($repo->description, $limit = 150, $end = '...') }}</p>
                    <p>
                        <small class="text-muted">
                            Last updated {{ Carbon\Carbon::parse($repo->last_push_date)->diffForHumans() }} ago
                            |
                            <svg aria-label="star" class="octicon octicon-star" height="14" role="img" version="1.1" viewBox="0 0 14 16" width="14"><path fill-rule="evenodd" d="M14 6l-4.9-.64L7 1 4.9 5.36 0 6l3.6 3.26L2.67 14 7 11.67 11.33 14l-.93-4.74z"></path></svg>
                            {{number_format($repo->stars)}}
                        </small>

                    </p>
                </li>
            @empty
                <li class="alert alert-warning" role="alert" style="list-style: none;">No items found. Please try fetch first.</li>
        @endforelse
        </ul>

        <div class="text-center">

            <nav aria-label="Page navigation" class="d-inline-flex">
                {{ $repos->links() }}
            </nav>
        </div>

</div>



@endsection