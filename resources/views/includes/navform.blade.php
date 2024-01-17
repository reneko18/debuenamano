<nav class="navbar navbar-expand-lg header">
    <div class="container"> 
        <a class="navbar-brand position-absolute" href="#">
            <img src="{{ asset('/img/logo-dbm.svg')}}" alt="logo de buena mano">
        </a>          
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarForm" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarFormt">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#">Comprar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('sellingform.show')}}">Vender</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">DBM</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Donar</a>
          </li>   
          <li class="nav-item">
            <a class="nav-link" href="#">Blog</a>
          </li> 
          <li class="nav-item">
            <a class="nav-link icono-buscar" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 15 15" fill="none">
              <path d="M6.77777 12.5555C9.96874 12.5555 12.5555 9.96874 12.5555 6.77777C12.5555 3.5868 9.96874 1 6.77777 1C3.5868 1 1 3.5868 1 6.77777C1 9.96874 3.5868 12.5555 6.77777 12.5555Z" stroke="#1B1F22" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M13.9991 13.9991L10.8574 10.8574" stroke="#1B1F22" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </a>
          </li>
        </ul>
      </div>     
    </div>
  </nav>