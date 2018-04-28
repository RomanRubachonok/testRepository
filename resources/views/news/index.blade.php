@extends('default')

@section('content')

    <div class="container">

        <h1 class="text-center">News</h1>

        @isset($news)

            @foreach($news as $item)

                <div class="media">
                    <div class="media-left">
                        <a href="{!! route('news.show', $item->id) !!}">
                            <img alt="64x64" class="media-object" data-src="holder.js/64x64" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNjMwZTgyNzJmMyB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE2MzBlODI3MmYzIj48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMy4xNzk2ODc1IiB5PSIzNi41NTYyNSI+NjR4NjQ8L3RleHQ+PC9nPjwvZz48L3N2Zz4=" data-holder-rendered="true" style="width: 64px; height: 64px;">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading"><a href="{!! route('news.show', $item->id) !!}">{{ $item->title }}</a></h4>
                        <p><em>{{ $item->desc }}</em></p>
                        <p>{{ $item->text }}</p>
                    </div>
                </div>

            @endforeach

            <div class="row text-center">
                {{ $news->links() }}
            </div>

        @endisset

        @isset($newsCategory)

            <div class="row">
                @foreach($newsCategory as $category)

                        <div class="{{$loop->first ? 'col-xs-offset-1' : ''}} col-xs-2">
                            <div class="list-group">
                                @foreach($category->latestNews(5)->get() as $k => $news)

                                      <a href="{!! route('news.show', $news->id) !!}" class="list-group-item">
                                        <h4 class="list-group-item-heading">{{ $news->title }}</h4>
                                        <p class="list-group-item-text">{{ $news->desc }}</p>
                                      </a>

                                @endforeach
                            </div>
                        </div>

                @endforeach
            </div>

        @endisset

    </div>

@endsection