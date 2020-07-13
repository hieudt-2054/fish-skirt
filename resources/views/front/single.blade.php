@extends('front.app')

@section('content')
<div class="site-cover site-cover-sm same-height overlay single-page" style="background-image: url('{{$post->post_image_path}}');">
    <div class="container">
      <div class="row same-height justify-content-center">
        <div class="col-md-12 col-lg-10">
          <div class="post-entry text-center">
            <span class="post-category text-white bg-success mb-3">{{ $post->category->name }}</span>
            <h1 class="mb-4"><a href="#">{{$post->title}}</a></h1>
          </div>
        </div>
      </div>
    </div>
</div>
  
  <section class="site-section py-lg">
    <div class="container">
      
      <div class="row blog-entries element-animate">

        <div class="col-md-12 col-lg-8 main-content">
          
          <div class="post-content-body">
           {!! $post->body !!}
          </div>

          
          <div class="pt-5">
            <p>Danh mục: <a href="/c/{{$post->category->id}}">{{ $post->category->name }}</a> </p>
          </div>
        </div>

        <!-- END main-content -->

        <div class="col-md-12 col-lg-4 sidebar">
          <div class="sidebar-box search-form-wrap">
            <form action="#" class="search-form">
              <div class="form-group">
                <span class="icon fa fa-search"></span>
                <input type="text" class="form-control" id="s" placeholder="Type a keyword and hit enter">
              </div>
            </form>
          </div>

          <div class="sidebar-box">
            <h3 class="heading">Bài viết mới</h3>
            <div class="post-entry-sidebar">
              <ul>
                @foreach($newPosts as $post)
                <li>
                  <a href="/p/{{$post->id}}">
                    <img src="{{$post->post_image_path}}" alt="Image placeholder" class="mr-4">
                    <div class="text">
                      <h4>{{$post->title}}</h4>
                    </div>
                  </a>
                </li>
                @endforeach
              </ul>
            </div>
          </div>
          <!-- END sidebar-box -->

          <div class="sidebar-box">
            <h3 class="heading">Danh mục</h3>
            <ul class="categories">
              @foreach($categories as $category)
              <li><a href="/c/{{$category->id}}">{{ $category->name }} <span>({{ $category->posts->count() }})</span></a></li>
              @endforeach
            </ul>
          </div>
        </div>
        <!-- END sidebar -->

      </div>
    </div>
  </section>

  <div class="site-section bg-light">
    <div class="container">

      <div class="row mb-5">
        <div class="col-12">
          <h2>Các bài khác cùng danh mục</h2>
        </div>
      </div>

      <div class="row align-items-stretch retro-layout">

        <div class="col-md-12">
          <div class="two-col d-block d-md-flex">
              @foreach($related as $post)
              <a href="/p/{{ $post->id }}" class="hentry v-height img-2 ml-auto gradient" style="background-image: url('{{$post->post_image_path}}');">
                <span class="post-category text-white bg-primary">{{$post->category->name }}</span>
                <div class="text text-sm">
                  <h2>{{$post->title}}</h2>
                  <span>February 12, 2019</span>
                </div>
              </a>
              @endforeach
          </div>  
          
        </div>
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