@extends('blog.default')

@section('content')
    <div class="col-lg-8 col-md-10 mx-auto">

        @foreach($items as $item)
            <div class="post-preview">
                <a href="post.html">
                    <h2 class="post-title">{{ $item->title }}</h2>
                    <h3 class="post-subtitle">
                        {{ limitation($item->description, 50) }}
                    </h3>
                </a>
                <p class="post-meta">Posted by
                    <a href="#">{{ $item->author }}</a>
                    on {{ $item->published_at }}</p>
            </div>
            <hr>
        @endforeach

        <!-- Pager -->
        <div class="clearfix">
            <a class="btn btn-primary float-right" href="{{ website()->url('/news') }}">Older Posts &rarr;</a>
        </div>
    </div>
@endsection
