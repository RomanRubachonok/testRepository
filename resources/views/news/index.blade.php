<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link href="/css/app.css" rel="stylesheet" type="text/css">
</head>
<body>

<secation class="content">
    <div class="container">

        {{--{{ dd(get_defined_vars()['__data']) }}--}}

        @isset($newsCategory)

            @foreach($newsCategory as $category)

                <div class="row">

                    @foreach($category->latestNews(5)->get() as $k => $news)

                        <div class="col-xs-2">
                            <h4>{{ $news->title }}</h4>
                            <p>{{ $news->desc }}</p>
                            <p>{{ $news->text }}</p>
                        </div>

                    @endforeach

                </div>

            @endforeach

        @endisset

    </div>
</secation>



    <script src="/js/app.js" type="text/javascript"></script>
</body>
</html>
