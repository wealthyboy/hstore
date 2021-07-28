@extends('layouts.app')
@section('content')
<div class=" bg--gray">
   <section class="breadcrumb justify-content-center">
      <div class="background-image" data-background="{{ optional($blog_image)->image }}" 
         style="background-image: url({{ optional($blog_image)->image }}); background-position: {{ optional($blog_image)->x_pos . '%' }} {{ optional($blog_image)->y_pos . '%'}};"
         data-bg-posx="center" data-bg-posy="center" data-bg-overlay="4"></div>
      <div class="breadcrumb-content">
         <div class="container-fluid">
            <div class="row">
               <div class="col-12 text-center">
                  <h1 class="breadcrumb-title">Blog</h1>
                  <nav class="breadcrumb-link">
                     <span><a href="/">Home</a></span> /
                     <span>Blog</span>
                  </nav>
               </div>
            </div>
         </div>
      </div>
   </section>
   <div class="container  bg--gray">
      <div class="head text-center mt-3 mb-3">
         <h4  class="widget-title "> BLOG </h4>
      </div>
      <!--Content-->
      <div class="col-lg-9">
        @foreach($posts as $post)

         <article class="post">
            <div class="post-media">
               <a href="">
                <img title="{{ $post->title }}" src="{{ $post->image }}" alt="{{ $post->title }} ">
               </a>
            </div>
            <!-- End .post-media -->
            <div class="post-body">
               <div class="post-date">
                  <span class="day">{{ $post->created_at->format('d') }}</span>
                  <span class="month">Jun</span>
               </div>
               <!-- End .post-date -->
               <h2 class="post-title">
                  <a title="{{  $post->title }}" href="{{ route('blog.show',['blog'=> $post->slug]) }}">{{ $post->title }}</a>
               </h2>
               <div class="post-content">
                  <p><?php echo  html_entity_decode($post->teaser);  ?></p>
                  <a title="{{  $post->title }}" href="{{ route('blog.show',['blog'=> $post->slug]) }}" class="read-more">Read More <i class="icon-angle-double-right"></i></a>
               </div>
               <!-- End .post-content -->
               <div class="post-meta">
                  <span><i class="icon-calendar"></i></span>
                  <span><i class="icon-user"></i>By <a href="#">Admin</a></span>
                  <span><i class="icon-folder-open"></i>
                  @foreach($post->attributes as $tag)
                       <a href="/blog/tag/{{ $tag->id }}"><i class="fa fa-tags"></i> {{ $tag->name }}</a>
                    @endforeach
                  </span>
               </div>
               <!-- End .post-meta -->
            </div>
            <!-- End .post-body -->
         </article>
        @endforeach
         <!-- End .post -->
         <nav class="toolbox toolbox-pagination border-0">
            <ul class="pagination">
               <li class="page-item active">
                  <a class="page-link" href="#">1 <span class="sr-only">(current)</span></a>
               </li>
               <li class="page-item"><a class="page-link" href="#">2</a></li>
               <li class="page-item"><a class="page-link" href="#">3</a></li>
               <li class="page-item"><a class="page-link" href="#">4</a></li>
               <li class="page-item"><a class="page-link" href="#">5</a></li>
               <li class="page-item"><span class="page-link">...</span></li>
               <li class="page-item">
                  <a class="page-link page-link-btn" href="#"><i class="icon-angle-right"></i></a>
               </li>
            </ul>
         </nav>
      </div>
      <!-- End .col-lg-9 -->
      <!--End Content--> 
   </div>
   <!-- /container -->
</div>
<!-- /container -->
@endsection
@section('page-scripts')
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
@stop
@section('inline-scripts')
$(document).ready(function() {
$('.blog-masonry-wrap').masonry({
// options
itemSelector: '.blog-item-grid',
});      
});
@stop