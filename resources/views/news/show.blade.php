@extends('default')

@section('content')

    <div class="container">

        @isset($news)
            
            <h1 class="text-center">{{ $news->title }}</h1>
            <div class="panel panel-default">
                <div class="panel-heading">{{ $news->desc }}</div>
                <div class="panel-body">
                    {{ $news->text }}
                </div>
            </div>

            <div class="row">

                @foreach($news->relevantTags(5)->get() as $k => $news)
                    <div class="{{$loop->first ? 'col-xs-offset-1' : ''}} col-xs-2">
                        <div class="thumbnail">
                          <div class="caption">
                            <h3>{{ $news->title }}</h3>
                            <p>{{ $news->desc }}</p>
                            <p><a href="{!! route('news.show', $news->id) !!}" class="btn btn-primary" role="button">Button</a></p>
                          </div>
                        </div>
                    </div>
                @endforeach

            </div>

        @endisset

    </div>

@endsection