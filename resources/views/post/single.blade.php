@extends('includes.baseform')
@section('title')
{{ $post->meta_title }} - De Buena Mano
@endsection

@push('post-seo')   
    <meta name="description" content="{{$post->meta_description}}">    
@endpush
@push('material-icons')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@endpush
@section('content')
    <section class="container-fluid breadcrumb-sec p-pages pb-5">
      <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('post.blog') }}">Blog</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li>
            </ol>
        </nav>
      </div>
    </section>
    <section class="container-fluid first-sec-post">
      <div class="col-8 mx-auto cont-1">
        <div class="row-meta">
          <div class="col1">
            <a href="{{ route('author.index') }}">
              <img src="{{ asset($post->author->main_img) }}" alt="image">
              <span>{{ $post->author->firstname }} {{ $post->author->lastname }}</span>
            </a>
          </div>
          @php
          \Carbon\Carbon::setLocale('es');
          @endphp
          
          <div class="col2">
              {{ \Carbon\Carbon::parse($post->created_ate)->translatedFormat('j \d\e F Y') }}
          </div>              
        </div>
        <h1>{{ $post->title }}</h1>
        <div class="row-cats-share">
          <div class="cont-1">
              @foreach ( $post->postcategories as $cats )
                <a href="{{ route('postcategories.archive') }}" class="cat-meta">{{ $cats->name }}</a>
              @endforeach   
          </div>
          <div class="cont-2">
            <svg version="1.1" id="share" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                viewBox="0 0 19 23" style="enable-background:new 0 0 19 23;" xml:space="preserve" data-bs-toggle="modal" data-bs-target="#shareSocial">
              <path class="st0" d="M1.5,11.8v8c0,0.5,0.2,1,0.6,1.4c0.4,0.4,0.9,0.6,1.4,0.6h12c0.5,0,1-0.2,1.4-0.6c0.4-0.4,0.6-0.9,0.6-1.4v-8"
                />
              <path class="st0" d="M13.5,5.8l-4-4l-4,4"/>
              <path class="st0" d="M9.5,1.8v13"/>
            </svg>
          </div>
        </div>     
      </div>
      <div class="container mx-auto">
          <img class="img-fluid main-img" src="{{asset($post->main_img)}}" alt="">
          <span class="caption-img d-flex justify-content-center">{{ $post->caption_img }}</span>
      </div>
    </section>

    <section class="container-fluid second-sec-post">
      <div class="container mx-auto">
        <div class="col-10 mx-auto content">
          {!! $post->content !!}
        </div>       
      </div>
    </section>
    <section class="container-fluid third-sec-post">
      <div class="container mx-auto">
        <div class="col-10 mx-auto cont-1">
          @foreach ( $post->postcategories as $cats )
          <span class="cat-meta">{{ $cats->name }}</span>
          @endforeach   
        </div>
      </div>
    </section>

    <!--Modal Share-->
    <div class="modal fade" id="shareSocial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Compartir este articulo</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"><i class="fa-regular fa-circle-xmark"></i></span>
            </button>
          </div>
          <div class="modal-body">
              <div class="mb-4 row-title">
                                      <div>                        
                      <img src="https://pro.architoi.com/images/gallery/52 Quai du Mesnil_finalisation-51689795037.jpg" alt="">
                  </div>
                                      <div>
                      <h2 class="title">{{ $post->title }}</h2>
                  </div>         
              </div>
              
              <div class="grid-share">
                  <a href="#"
                      title="Partager cette page par mail">
                      <span class="material-symbols-outlined">mail</span> <span>Email</span>
                  </a>
                  <a href="#" target="_blank">
                      <i class="fa-brands fa-square-whatsapp"></i> <span>Whatsapp</span>
                  </a> 
                  <a href="#" target="_blank">
                      <i class="fa-brands fa-square-facebook"></i> <span>Facebook</span>
                  </a> 
                  <a href="#" target="_blank">
                      <i class="fa-brands fa-linkedin"></i> <span>Linkedin</span>
                  </a>                
                  <a href="#" target="_blank">
                      <i class="fa-brands fa-square-twitter"></i> <span>Twitter</span>
                  </a>              
                  <a href="" id="copylink" data-url-value="#">
                      <span class="material-symbols-outlined">content_copy</span> <span>Copiar link</span>
                  </a>
              </div>      
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>             
          </div>
        </div>
      </div>
    </div>
@endsection

@push('script-copy-link')
<script type="text/javascript">    
  (function($) {

  $(document).ready(function() {   
      
      var $temp = $("<input>");
      var $url = $('#copylink').data('url-value');

      $('#copylink').on('click', function(){
      $("body").append($temp);           
      $temp.val($url).select();            
      document.execCommand('copy');
      $temp.remove();
      alert("Link copiado");        
      });
    });
  });
</script>
@endpush