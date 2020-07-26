@extends('front.app')

@section('content')

<div class="site-section bg-light">
    <div class="container">
        <div class="row align-items-stretch retro-layout-2">
            <h4>Bạn đang xem danh mục : {{$category->name}}</h4>
        </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
        <div class="row mb-5">
        <div class="col-12">
            <h2>Bài viết gần đây</h2>
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
                    
                        <p>{!! $post->body !!}</p>
                        <p><a href="/p/{{$post->id}}">Đọc thêm</a></p>
                    </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</div>


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