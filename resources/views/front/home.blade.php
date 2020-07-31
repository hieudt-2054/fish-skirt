@extends('front.app')

@section('content')
<header class="masthead mainbg">
    <div class="container h-100">
      <div class="row h-100">
        <div class="col-lg-7 my-auto">
          <div class="header-content mx-auto">
            <h1 class="mb-5 color-white">
                FishSkirt là hệ thống đo lường, theo dõi quá trình giảm cân của những người dùng có nhu cầu.
                Thời buổi này giảm cân dễ dàng khi đã có hệ thống hỗ trợ, gợi ý, nhằm tối ưu được kết quả mong đợi, giảm cân hiệu quả
            </h1>
            <a href="#popup" class="btn btn-outline btn-xl js-scroll-trigger btn-thamgia">THAM GIA NGAY BÂY
                GIỜ!</a>
          </div>
        </div>
        <div class="col-lg-5 my-auto">
          <div class="device-container">
            <div class="device-mockup iphone6_plus portrait white">
              <div class="device">
                <div class="screen">
                    <img src="https://i.ibb.co/QJSz1M3/image.png" class="img-fluid" alt="">
                </div>
                <div class="button">
                  <!-- You can hook the "home button" to some JavaScript events or just remove it -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <section class="contact bg-timer">
    <div class="container">
      <div class="section-heading text-center">
        <p class="text-muted wh">HÃY NHANH TAY, THỜI GIAN THỬ NGHIỆM CHO PHÉP ĐĂNG KÝ MIỄN PHÍ CHỈ CÒN</p>
        <h2 class="wh"><span id="clock"></span></h2>
      </div>
      <div class="row">
        <div class="col-md-4 center-block">
          <a href="#popup" class="btn btn-outline btn-xl js-scroll-trigger btn-thamgia">THAM GIA NGAY BÂY
            GIỜ!</a>
        </div>
      </div>
    </div>
  </section>
  <section class="features bg-custom-1" id="features">
    <div class="container">
        <div class="section-heading text-center">
        <h2>Tối ưu giảm cân bằng công nghệ</h2>
        <p class="text-muted">Các giá trị dưới là giá trị cốt lõi của hệ thống </p>
        <hr>
        </div>
        <div class="row">
        <div class="col-lg-4 my-auto">
            <div class="device-container">
            <div class="device-mockup iphone6_plus portrait white">
                <div class="device">
                <div class="screen">
                    <img src="https://lh3.googleusercontent.com/mNrWh7xEhqoImo6yxJiPvfwrDbm_T_Ag3FyUInhZyjwNpGE-J_30KMDXCwhh0GfvQkfj" class="img-fluid" alt="">
                </div>
                <div class="button">
                    <!-- You can hook the "home button" to some JavaScript events or just remove it -->
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-lg-8 my-auto">
            <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="feature-item">
                        <i class="fa fa-calculator" aria-hidden="true"></i>
                        <h3>TDEE Calculator</h3>
                        <p class="text-muted">Chắc bạn cũng biết công thức giảm cân TDEE, hệ thống sẽ tính giúp bạn</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="feature-item">
                        <i class="fa fa-book text-primary"></i>
                        <h3>Lưu trữ</h3>
                        <p class="text-muted">Ghi lại quá trình giảm cân của bạn</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                <div class="feature-item">
                    <i class="fa fa-bar-chart text-primary"></i>
                    <h3>Đo lường</h3>
                    <p class="text-muted">Tính toán chỉ số sức khỏe của bạn</p>
                </div>
                </div>
                <div class="col-lg-6">
                <div class="feature-item">
                    <i class="fa fa-heartbeat text-primary"></i>
                    <h3>Rèn luyện</h3>
                    <p class="text-muted">Website luôn cập nhật tin tức và bài tập tốt cho sức khỏe</p>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </section>
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
<section class="contact" id="contact">
    <div class="container">
      <div class="section-heading text-center">
        <h2>Đánh giá từ khách hàng</h2>
        <p class="text-muted">Các đánh giá hữu ích cho người dùng cái nhìn tổng quan</p>
        <hr>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" style="width:200px"
                  class="round center-block">
              </div>
              <div class="row mt-4">
                <i class="fa fa-comments-o center-block ic" aria-hidden="true"></i>
              </div>
              <div class="row">
                <p class="quote mt-5">
                  "Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt laboriosam similique repellendus
                  natus, cupiditate culpa? Adipisci delectus voluptate neque quam in obcaecati pariatur dolorem, qui,
                  quaerat numquam et dignissimos illum."
                </p>
              </div>
              <div class="row">
                <p class="center-block ceo">
                  Founder FS
                </p>
              </div>
              <div class="row center-block">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" style="width:200px"
                  class="round center-block">
              </div>
              <div class="row mt-4">
                <i class="fa fa-comments-o center-block ic" aria-hidden="true"></i>
              </div>
              <div class="row">
                <p class="quote mt-5">
                  "Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt laboriosam similique repellendus
                  natus, cupiditate culpa? Adipisci delectus voluptate neque quam in obcaecati pariatur dolorem, qui,
                  quaerat numquam et dignissimos illum."
                </p>
              </div>
              <div class="row">
                <p class="center-block ceo">
                  Founder ZCAS
                </p>
              </div>
              <div class="row center-block">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" style="width:200px"
                  class="round center-block">
              </div>
              <div class="row mt-4">
                <i class="fa fa-comments-o center-block ic" aria-hidden="true"></i>
              </div>
              <div class="row">
                <p class="quote mt-5">
                  "Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt laboriosam similique repellendus
                  natus, cupiditate culpa? Adipisci delectus voluptate neque quam in obcaecati pariatur dolorem, qui,
                  quaerat numquam et dignissimos illum."
                </p>
              </div>
              <div class="row">
                <p class="center-block ceo">
                  Founder ZCAS
                </p>
              </div>
              <div class="row center-block">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="contact bg-quytrinh">
    <div class="container">
      <div class="section-heading text-center">
        <h2 class="wh">Quy trình sử dụng dễ dàng</h2>
        <p class="text-muted wh">Các bước sử dụng hệ thống đơn giản nhất đối với người dùng giảm cân</p>
      </div>
      <div class="row">
        <div class="timeline">
          <dl class="timeline--entry">
            <dt class="timeline--entry__title">Bước 1</dt>
            <dd class="timeline--entry__detail">Tạo tài khoản và đăng nhập trên hệ thống</dd>
          </dl>
          <dl class="timeline--entry">
            <dt class="timeline--entry__title">Bước 2</dt>
            <dd class="timeline--entry__detail">Nhập các thông tin sau khi đăng nhập. Hệ thống sẽ sử dụng công thức TDEE để tính toán lượng calo hợp lý với bạn</dd>
          </dl>
          <dl class="timeline--entry">
            <dt class="timeline--entry__title">Bước 3</dt>
            <dd class="timeline--entry__detail">Thêm mới các bản ghi về ăn uống hoặc cân nặng hàng ngày</dd>
          </dl>
          <dl class="timeline--entry">
            <dt class="timeline--entry__title">Bước 4</dt>
            <dd class="timeline--entry__detail">Theo dõi quá trình của bạn thông qua biểu đồ trực quan</dd>
          </dl>
          <dl class="timeline--entry">
            <dt class="timeline--entry__title">Bước 5</dt>
            <dd class="timeline--entry__detail">Theo dõi các bài viết tin tức trên hệ thống để tối ưu hóa được kết quả mong muốn</dd>
          </dl>
        </div>
      </div>
    </div>
  </section>
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
              <input type="text" class="form-control" placeholder="Vui lòng điền email của bạn tại đây">
              <input type="submit" class="ml-2 btn btn-primary" value="Đăng ký">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection