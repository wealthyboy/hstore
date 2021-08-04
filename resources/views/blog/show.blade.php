@extends('layouts.app')
        
@section('content')
<section   style="background-image: url({{ optional($blog_image)->image }}); background-position: {{ optional($blog_image)->x_pos . '%' }} {{ optional($blog_image)->y_pos . '%'}};" class="justify-content-center">

        <div class="breadcrumb-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1 class="breadcrumb-title">Blog</h1>
                          <nav class="breadcrumb-link">
                            <span><a href="/">Home</a></span> 
                            <span>Blog</span> 
                            <span>{{ $blog->title }}</span>
                        </nav>
                    </div>
                </div>
        </div>
    </div>
</section>
<section id="home">   
    <div class="container">
        <div class="row justifiy-content-center">        
            <div id="content" class="col-md-12">  
                <h3 class="">{{ $blog->title }}</h3>
                <div class="blog-item">
                   <p><?php echo  str_replace('""="">','',html_entity_decode($blog->description));  ?></p>
                </div>
                <div class="comments-area clearfix">
                    <!--Comments-->
                    <comments :blog="{{ $blog }}" />
                </div>
            </div>
        </div> <!-- /row -->
    </div> <!-- /container -->
</section>
<!-- /container -->
@endsection
