<html>
<head>
    <title>Github API</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    @yield('styles')
</head>
<body>
<header>
    <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
            <a href="{{url('/')}}" class="navbar-brand d-flex align-items-center">
                <svg aria-hidden="true" class="octicon octicon-mark-github" height="32" version="1.1" viewBox="0 0 16 16" width="32"><path fill-rule="evenodd" d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0 0 16 8c0-4.42-3.58-8-8-8z"></path></svg>
            </a>
        </div>
    </div>
</header>
<main role="main">
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-headin">Popular PHP Repositories</h1>
            <p class="lead text-muted">This will list top 1000 starred PHP repositories from github. Pagination is included at the bottom of the
                list for easy navigation.
            </p>
            <p>
                <a id="fetch-git" href="#{{-- url('/fetch') --}}" class="btn btn-primary">Fetch Github Data</a>
            </p>
        </div>

    </section>
</main>


@yield('content')

<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script language="JavaScript">
    $("#fetch-git").click(function() {
        event.stopPropagation();
        $(this).hide().after('<i>fetching...</i>');
        $.get( "{{url('/fetch')}}", function( data ) {
            if(data) {
                $("#fetch-git").text('Fetch completed. Reload').attr('href', '{{url("/")}}').off('click');
                $('.repos.container').hide();
            } else {
                $("#fetch-git").text('Fetch failed...Retry');
            }
        }).fail(function() {
            $("#fetch-git").text('Fetch failed...Retry');
        }).done(function() {
            $("#fetch-git").show().next('i').hide();
        });
        return false;
    });
</script>
@yield('scripts')

</body>
</html>