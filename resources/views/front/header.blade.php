<header class="site-navbar" role="banner">
    <div class="container-fluid">
      <div class="row align-items-center">
        
        <div class="col-12 search-form-wrap js-search-form">
          <form method="get" action="#">
            <input type="text" id="s" class="form-control" placeholder="Search...">
            <button class="search-btn" type="submit"><span class="icon-search"></span></button>
          </form>
        </div>

        <div class="col-6 site-logo">
          <a href="/" class="text-black h2 mb-0">Sức Khỏe Blog</a>
        </div>

        <div class="col-6 text-right">
          <nav class="site-navigation" role="navigation">
            <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block mb-0">
              <li><a href="/">Trang chủ</a></li>
              <li><a href="/home">Quản Trị</a></li>
              @foreach($categories as $category)
              <li><a href="/c/{{$category->id}}">{{ $category->name }}</a></li>
              @endforeach
              <li class="d-none d-lg-inline-block"><a href="#" class="js-search-toggle"><span class="icon-search"></span></a></li>
            </ul>
          </nav>
          <a href="#" class="site-menu-toggle js-menu-toggle text-black d-inline-block d-lg-none"><span class="icon-menu h3"></span></a></div>
        </div>

    </div>
  </header>