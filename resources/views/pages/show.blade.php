@extends('layout')
@section('content')
<div class="col-md-8">
        <article class="post">
            <div class="post-thumb">
                <a href="blog.html"><img src="{{$post->getImage()}}" alt=""></a>
            </div>
            <div class="post-content">
                <header class="entry-header text-center text-uppercase">
                    <h6><a href="#">{{$post->category->title}}</a></h6>

                    <h1 class="entry-title"><a href="blog.html">{{$post->title}}</a></h1>

                </header>
                <div class="entry-content">
                    {!! $post->content !!}
                </div>
                <div class="decoration">
                    @foreach($post->tags as $tag)
                        <a href="{{route('tag.show',['slug'=>$tag->slug])}}" class="btn btn-default">{{$tag->title}}</a>
                    @endforeach
                </div>

                <div class="social-share">
                    <span class="social-share-title pull-left text-capitalize">От <a href="#">{{$post->author->name}}</a>  {{$post->getDate()}}</span>

                    <ul class="text-center pull-right">
                        <li><a class="s-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a class="s-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a class="s-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a class="s-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a class="s-instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </article>
        <div class="row"><!--blog next previous-->
            <div class="col-md-6">
                @if($post->hasPrevious())
                    <div class="single-blog-box">
                        <a href="{{route('post.show',['slug'=>$post->getPrevious()->slug])}}">
                            <img src="{{$post->getPrevious()->getImage()}}" alt="">

                            <div class="overlay">

                                <div class="promo-text">
                                    <p><i class=" pull-left fa fa-angle-left"></i></p>
                                    <h5>{{$post->getPrevious()->title}}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
            </div>
            <div class="col-md-6">
                @if($post->hasNext())
                    <div class="single-blog-box">
                        <a href="{{route('post.show',['slug'=>$post->getNext()->slug])}}">
                            <img src="{{$post->getNext()->getImage()}}" alt="">

                            <div class="overlay">

                                <div class="promo-text">
                                    <p><i class=" pull-right fa fa-angle-right"></i></p>
                                    <h5>{{$post->getNext()->title}}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
            </div>
        </div><!--blog next previous end-->
        <div class="related-post-carousel"><!--related post carousel-->
            <div class="related-heading">
                <h4>Можливо вам буде цікаво</h4>
            </div>
            <div class="items">
                @foreach($post->related() as $item)
                    <div class="single-item" style="padding: 10px;">
                        <a href="{{route('post.show',['slug'=>$item->slug])}}">
                            <img src="{{$item->getImage()}}" alt="" style="height: 100px;">

                            <p>{{$item->title}}</p>
                        </a>
                    </div>
                @endforeach
            </div>
        </div><!--related post carousel-->
        <div class="ajax-comment">
        @if($post->comments)
            @foreach($post->comments as $comment)
        <div class="bottom-comment"><!--bottom comment-->
            <div class="comment-img" style="padding-bottom: 15px">
                <img class="img-circle" src="{{$comment->author->getImage()}}" width="75" height="75">
            </div>

            <div class="comment-text">
                <h5>{{$comment->author->name}}</h5>

                <p class="comment-date">
                    {{$comment->created_at->diffForHumans()}}
                </p>


                <p class="para" style="padding-left: 103px">{{$comment->text}}</p>
            </div>
        </div>
            @endforeach
        @endif
        </div>
        <!-- end bottom comment-->
        @if(\Illuminate\Support\Facades\Auth::check())
        <div class="leave-comment"><!--leave comment-->
            <h4>Оставить комментарий</h4>
            <form class="form-horizontal contact-form" role="form" method="post" id="commentForm">
                {{csrf_field()}}
                <input type="hidden" value="{{$post->id}}" name="post_id">
                <div class="form-group">
                    <div class="col-md-12">
					    <textarea class="form-control" rows="6" name="message" placeholder="Ваш комментарий"></textarea>
                    </div>
                </div>
                @if(session('status'))<div class="alert alert-info">{{session('status')}}</div>@endif
                <button class="btn send-btn">Комментировать</button>
            </form>
        </div><!--end leave comment-->
        @endif
    </div>
@endsection