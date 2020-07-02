@extends('front.app')

@section('content')

<div class="site-section bg-light" style="background-image: url(https://www.vinmec.com/static/img/maternity/background.663c1cf25358.gif); background-size: cover;">
    <div class="container">
        <div class="row align-items-stretch retro-layout-2">
        <div class="col-md-10">
           <h1>Giải pháp theo dõi sức khỏe - Giảm cân hiệu quả nhanh chóng</h1>
        </div>
        </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
        <div class="row mb-5">
        <div class="col-12">
            <h2>Bài viết mới</h2>
        </div>
        </div>
        <div class="row">
            @if (isset($posts))
                @foreach ($posts as $post)
                <div class="col-lg-4 mb-4">
                    <div class="entry2">
                    <a href="/p/{{$post->id}}"><img src="{{$post->post_image_path}}" alt="Image" class="img-fluid rounded"></a>
                    <div class="excerpt">
                    <span class="post-category text-white bg-secondary mb-3">{{ $post->category->name }}</span>

                    <h2><a href="/p/{{$post->id}}">{{$post->title}}</a></h2>
                    <div class="post-meta align-items-center text-left clearfix">
                        <figure class="author-figure mb-0 mr-3 float-left"><img src="images/person_1.jpg" alt="Image" class="img-fluid"></figure>
                        <span class="d-inline-block mt-1">Đăng bởi <a href="#">Admin</a></span>
                    </div>
                    
                        <p>{{$post->body}}</p>
                        <p><a href="/p/{{$post->id}}">Đọc thêm</a></p>
                    </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
        {{-- <div class="row text-center pt-5 border-top">
            <div class="col-md-12">
                <div class="custom-pagination">
                <span>1</span>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <span>...</span>
                <a href="#">15</a>
                </div>
            </div>
        </div> --}}
    </div>
</div>

<div class="site-section">
    <div class="container">
        <div class="row mb-5">
        <div class="col-12">
            <h2>Video mới</h2>
        </div>
        </div>
        <div class="row">
            @if (isset($postsVideo))
                @foreach ($postsVideo as $post)
                <div class="col-lg-4 mb-4">
                    <div class="entry2">
                    <a href="/p/{{$post->id}}"><img src="{{$post->post_image_path}}" alt="Image" class="img-fluid rounded"></a>
                    <div class="excerpt">
                    <span class="post-category text-white bg-secondary mb-3">{{ $post->category->name }}</span>

                    <h2><a href="/p/{{$post->id}}">{{$post->title}}</a></h2>
                    <div class="post-meta align-items-center text-left clearfix">
                        <figure class="author-figure mb-0 mr-3 float-left"><img src="images/person_1.jpg" alt="Image" class="img-fluid"></figure>
                        <span class="d-inline-block mt-1">Đăng bởi <a href="#">Admin</a></span>
                    </div>
                    
                        <p>{{$post->body}}</p>
                        <p><a href="/p/{{$post->id}}">Đọc thêm</a></p>
                    </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
        {{-- <div class="row text-center pt-5 border-top">
            <div class="col-md-12">
                <div class="custom-pagination">
                <span>1</span>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <span>...</span>
                <a href="#">15</a>
                </div>
            </div>
        </div> --}}
    </div>
</div>

{{-- <div class="site-section bg-light">
    <div class="container">

        <div class="row align-items-stretch retro-layout">
        
        <div class="col-md-5 order-md-2">
            <a href="single.html" class="hentry img-1 h-100 gradient" style="background-image: url('images/img_4.jpg');">
            <span class="post-category text-white bg-danger">Travel</span>
            <div class="text">
                <h2>The 20 Biggest Fintech Companies In America 2019</h2>
                <span>February 12, 2019</span>
            </div>
            </a>
        </div>

        <div class="col-md-7">
            
            <a href="single.html" class="hentry img-2 v-height mb30 gradient" style="background-image: url('images/img_1.jpg');">
            <span class="post-category text-white bg-success">Nature</span>
            <div class="text text-sm">
                <h2>The 20 Biggest Fintech Companies In America 2019</h2>
                <span>February 12, 2019</span>
            </div>
            </a>
            
            <div class="two-col d-block d-md-flex">
            <a href="single.html" class="hentry v-height img-2 gradient" style="background-image: url('images/img_2.jpg');">
                <span class="post-category text-white bg-primary">Sports</span>
                <div class="text text-sm">
                <h2>The 20 Biggest Fintech Companies In America 2019</h2>
                <span>February 12, 2019</span>
                </div>
            </a>
            <a href="single.html" class="hentry v-height img-2 ml-auto gradient" style="background-image: url('images/img_3.jpg');">
                <span class="post-category text-white bg-warning">Lifestyle</span>
                <div class="text text-sm">
                <h2>The 20 Biggest Fintech Companies In America 2019</h2>
                <span>February 12, 2019</span>
                </div>
            </a>
            </div>  
            
        </div>
        </div>

    </div>
</div> --}}


<div class="site-section bg-lightx">
        <div class="container">
          <div class="row justify-content-center text-center">
            <div class="col-md-5">
              <div class="subscribe-1 ">
                <h2>Đăng ký để nhận tin tức mới nhất</h2>
                <form action="#" class="d-flex">
                  <input type="text" class="form-control" placeholder="Enter your email address">
                  <input type="submit" class="btn btn-primary" value="Đăng ký">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection