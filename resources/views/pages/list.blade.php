@extends('layout')
@section('content')
<div class="col-md-8">
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-6">
                    <article class="post post-grid">
                        <div class="post-thumb">
                            <a href="{{route('post.show',['slug'=>$post->slug])}}"><img src="{{$post->getImage()}}" alt=""></a>

                            <a href="{{route('post.show',['slug'=>$post->slug])}}" class="post-thumb-overlay text-center">
                                <div class="text-uppercase text-center">View Post</div>
                            </a>
                        </div>
                        <div class="post-content">
                            <header class="entry-header text-center text-uppercase">
                                <h6><a href="{{route('category.show',['slug'=>$post->category->slug])}}">{{$post->category->title}}</a></h6>

                                <h1 class="entry-title"><a href="{{route('post.show',['slug'=>$post->slug])}}">{{$post->title}}</a></h1>


                            </header>
                            <div class="entry-content">
                                <p>{!! $post->description !!}
                                </p>

                                <div class="social-share">
                                    <span class="social-share-title pull-left text-capitalize">От <a href="#">{{$post->author->name}}</a>  {{$post->getDate()}}</span>
                                </div>
                            </div>
                        </div>

                    </article>
                </div>
            @endforeach
        </div>
        {{$posts->links()}}
    </div>
@endsection