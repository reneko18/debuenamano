<nav class="navbar navbar-expand-lg header">
  <div class="container"> 
    <a class="navbar-brand position-absolute" href="{{ route('inicio')}}">
      <img src="{{ asset('/img/logo-dbm.svg')}}" alt="logo de buena mano">
    </a>          
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarFormt" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarFormt">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="{{ route('loop.index')}}">Comprar</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('formtest.show')}}">Vender</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('nosotros')}}">Somos</a></li> 
        <li class="nav-item"><a class="nav-link" href="{{ route('post.blog')}}">Blog</a></li>   
      </ul>
    </div>     
  </div>
</nav>

