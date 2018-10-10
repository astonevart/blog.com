<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- favicon icon -->

    <title>Blog</title>

    <!-- common css -->
    <link rel="stylesheet" href="/css/front.css">

    <!-- HTML5 shim and Respond.js IE9 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.js"></script>
    <script src="assets/js/respond.js"></script>
    <![endif]-->

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="img/favicon.png">

</head>

<body>

<nav class="navbar main-menu navbar-default">
    <div class="container">
        <div class="menu-content">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{url('/')}}"><img src="/img/logo.png" alt=""></a>
            </div>


            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav text-uppercase">
                    <li><a href="about-me.html">Про мене</a></li>
                    <li><a href="contact.html">Контакти</a></li>
                </ul>

                <ul class="nav navbar-nav text-uppercase pull-right">
                    @if (\Illuminate\Support\Facades\Auth::check())
                        <li><a href="/profile"><img class="img-circle" src="{{\Illuminate\Support\Facades\Auth::user()->getImage()}}" width=40" height="40"></a></li>
                        <li><a href="/logout">Вийти</a></li>
                    @else
                        <li><a href="/register">Зареєструватись</a></li>
                        <li><a href="/login">Вхід</a></li>
                    @endif
                </ul>

            </div>
            <!-- /.navbar-collapse -->


            <div class="show-search">
                <form role="search" method="get" id="searchform" action="#">
                    <div>
                        <input type="text" placeholder="Search and hit enter..." name="s" id="s">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</nav>
<!--main content start-->
<div class="main-content">
    <div class="container">
        <div class="row">
            @yield('content')
            <div class="col-md-4" data-sticky_column>
                <div class="primary-sidebar">
                    <aside class="widget news-letter">
                        @if(session('email'))
                            <div class="alert alert-info">{{session('email')}}</div>
                        @endif
                        <h3 class="widget-title text-uppercase text-center">Отримувати пости</h3>

                        <form action="/subscribe" method="post">
                            {{csrf_field()}}
                            <input type="email" placeholder="Ваш email" name="email">
                            <input type="submit" value="Підписатись"
                                   class="text-uppercase text-center btn btn-subscribe">
                        </form>


                    </aside>
                    <aside class="widget">
                        <h3 class="widget-title text-uppercase text-center">Популярні пости</h3>
                        @foreach($popularPosts as $post)
                        <div class="popular-post">


                            <a href="{{route('post.show',['slug'=>$post->slug])}}" class="popular-img"><img src="{{$post->getImage()}}" alt="">

                                <div class="p-overlay"></div>
                            </a>

                            <div class="p-content">
                                <a href="{{route('post.show',['slug'=>$post->slug])}}" class="text-uppercase">{{$post->title}}</a>
                                <span class="p-date">{{$post->date}}</span>

                            </div>
                        </div>
                        @endforeach

                    </aside>
                    <aside class="widget">
                        <h3 class="widget-title text-uppercase text-center">Рекомендовані пости</h3>

                        <div id="widget-feature" class="owl-carousel">
                            @foreach($featuredPosts as $post)
                            <div class="item">
                                <div class="feature-content">
                                    <img src="{{$post->getImage()}}" alt=""  height="160">

                                    <a href="#" class="overlay-text text-center">
                                        <h5 class="text-uppercase">{{$post->title}}</h5>

                                        <p>{!! $post->description !!}</p>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </aside>
                    <aside class="widget pos-padding">
                        <h3 class="widget-title text-uppercase text-center">Останні пости</h3>
                        @foreach($recentPosts as $post)
                        <div class="thumb-latest-posts">

                            <div class="media">
                                <div class="media-left">
                                    <a href="{{route('post.show',['slug'=>$post->slug])}}" class="popular-img"><img src="{{$post->getImage()}}" alt="">

                                        <div class="p-overlay"></div>
                                    </a>
                                </div>
                                <div class="p-content">
                                    <a href="{{route('post.show',['slug'=>$post->slug])}}" class="text-uppercase">{{$post->title}}</a>
                                    <span class="p-date">{{$post->date}}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </aside>
                    <aside class="widget border pos-padding">
                        <h3 class="widget-title text-uppercase text-center">Категорії</h3>
                        <ul>
                            @foreach($categoriesPosts as $category)
                            <li>
                                <a href="{{route('category.show',['slug'=>$category->slug])}}">{{$category->title}}</a>
                                <span class="post-count pull-right"> ({{$category->posts()->count()}})</span>
                            </li>
                            @endforeach
                        </ul>
                    </aside>
                    <aside class="">
                        <h3 class="widget-title text-uppercase text-center">Follow@Instagram</h3>

                        <div style="padding: 20px; margin-left: 10px">
                            @foreach($instagram->media() as $item)
                                <a href="#"><img src="{{$item->images->standard_resolution->url}}" alt="" width="100" height="100"></a>
                            @endforeach

                        </div>

                    </aside>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end main content-->
<!--footer start-->


<footer class="footer-widget-section">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <aside class="footer-widget">
                    <div class="about-img"><img src="/img/footer-logo.png" alt=""></div>
                    <div class="about-content">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy
                        eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed voluptua. At vero eos et
                        accusam et justo duo dlores et ea rebum magna text ar koto din.
                    </div>
                </aside>
            </div>

            <div class="col-md-4">
                <aside class="footer-widget">
                    <h3 class="widget-title text-uppercase">Testimonials</h3>

                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!--Indicator-->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <div class="single-review">
                                    <div class="review-text">
                                        <p>Lorem ipsum dolor sit amet, conssadipscing elitr, sed diam nonumy eirmod
                                            tempvidunt ut labore et dolore magna aliquyam erat,sed diam voluptua. At
                                            vero eos et accusam justo duo dolores et ea rebum.gubergren no sea takimata
                                            magna aliquyam eratma</p>
                                    </div>
                                    <div class="author-id">
                                        <img src="/img/author.png" alt="">

                                        <div class="author-text">
                                            <h4>Sophia</h4>

                                            <h4>Client, Tech</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="single-review">
                                    <div class="review-text">
                                        <p>Lorem ipsum dolor sit amet, conssadipscing elitr, sed diam nonumy eirmod
                                            tempvidunt ut labore et dolore magna aliquyam erat,sed diam voluptua. At
                                            vero eos et accusam justo duo dolores et ea rebum.gubergren no sea takimata
                                            magna aliquyam eratma</p>
                                    </div>
                                    <div class="author-id">
                                        <img src="/img/author.png" alt="">

                                        <div class="author-text">
                                            <h4>Sophia</h4>

                                            <h4>Client, Tech</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="single-review">
                                    <div class="review-text">
                                        <p>Lorem ipsum dolor sit amet, conssadipscing elitr, sed diam nonumy eirmod
                                            tempvidunt ut labore et dolore magna aliquyam erat,sed diam voluptua. At
                                            vero eos et accusam justo duo dolores et ea rebum.gubergren no sea takimata
                                            magna aliquyam eratma</p>
                                    </div>
                                    <div class="author-id">
                                        <img src="/img/author.png" alt="">

                                        <div class="author-text">
                                            <h4>Sophia</h4>

                                            <h4>Client, Tech</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </aside>
            </div>
            <div class="col-md-4">
                <aside class="footer-widget">
                    <h3 class="widget-title text-uppercase">Custom Category Post</h3>


                    <div class="custom-post">
                        <div>
                            <a href="#"><img src="/img/footer-img.png" alt=""></a>
                        </div>
                        <div>
                            <a href="#" class="text-uppercase">Home is peaceful Place</a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
    <div class="footer-copy">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">&copy; 2018 <a href="#">Blog, </a> Designed with <i
                                class="fa fa-heart"></i> by <a href="#">Alex</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- js files -->
<script src="/js/front.js"></script>
<script>
    $(document).ready(function(){
        $('#commentForm').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '/comment',
                data: $('#commentForm').serialize(),
                success: function(comment){
                    $('.ajax-comment').append('<div class="bottom-comment"><!--bottom comment-->\n' +
                        '            <div class="comment-img" style="padding-bottom: 15px">\n' +
                        '                <img class="img-circle" src="/uploads/'+comment.img+'" width="75" height="75">\n' +
                        '            </div>\n' +
                        '\n' +
                        '            <div class="comment-text">\n' +
                        '                <h5>'+comment.name+'</h5>\n' +
                        '\n' +
                        '                <p class="comment-date">\n' +
                        '                    '+comment.date+'\n' +
                        '                </p>\n' +
                        '\n' +
                        '\n' +
                        '                <p class="para" style="padding-left: 103px">'+comment.text+'</p>\n' +
                        '            </div>\n' +
                        '        </div>');
                }
            });
        });
    });

</script>
</body>
</html>
