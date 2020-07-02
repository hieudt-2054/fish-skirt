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
           {{ $post->body }}
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
                  <a href="/c/{{$post->id}}">
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
            <h3 class="heading">Categories</h3>
            <ul class="categories">
              <li><a href="#">Food <span>(12)</span></a></li>
              <li><a href="#">Travel <span>(22)</span></a></li>
              <li><a href="#">Lifestyle <span>(37)</span></a></li>
              <li><a href="#">Business <span>(42)</span></a></li>
              <li><a href="#">Adventure <span>(14)</span></a></li>
            </ul>
          </div>
          <!-- END sidebar-box -->

          <div class="sidebar-box">
            <h3 class="heading">Tags</h3>
            <ul class="tags">
              <li><a href="#">Travel</a></li>
              <li><a href="#">Adventure</a></li>
              <li><a href="#">Food</a></li>
              <li><a href="#">Lifestyle</a></li>
              <li><a href="#">Business</a></li>
              <li><a href="#">Freelancing</a></li>
              <li><a href="#">Travel</a></li>
              <li><a href="#">Adventure</a></li>
              <li><a href="#">Food</a></li>
              <li><a href="#">Lifestyle</a></li>
              <li><a href="#">Business</a></li>
              <li><a href="#">Freelancing</a></li>
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
          <h2>More Related Posts</h2>
        </div>
      </div>

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
  </div>


  <div class="site-section bg-lightx">
    <div class="container">
      <div class="row justify-content-center text-center">
        <div class="col-md-5">
          <div class="subscribe-1 ">
            <h2>Subscribe to our newsletter</h2>
            <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit nesciunt error illum a explicabo, ipsam nostrum.</p>
            <form action="#" class="d-flex">
              <input type="text" class="form-control" placeholder="Enter your email address">
              <input type="submit" class="btn btn-primary" value="Subscribe">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection