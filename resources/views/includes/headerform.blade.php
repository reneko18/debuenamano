<header class="fixed-top"> 
    <div class="top-header">
        <div class="container d-flex justify-content-end">
                @auth
                    <div style="color:#fff;">
                        {{ auth()->user()->name }} {{ auth()->user()->lastname }}
                    </div>
                    <div style="color:#fff;">

                    </div>
                @endauth
                <ul class="iconos">
                    <li>
                        <div class="dropdown">
                            <a class="user dropdown-toggle" data-bs-toggle="dropdown">
                                <svg version="1.1" id="user" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                viewBox="0 0 11 12" style="enable-background:new 0 0 11 12;" xml:space="preserve">
                                    <path class="st0" d="M10.2,10.7V9.6C10.2,9,10,8.4,9.6,8C9.2,7.6,8.6,7.3,8,7.3H3.6C3,7.3,2.4,7.6,2,8C1.6,8.4,1.4,9,1.4,9.6v1.1"/>
                                    <path class="st0" d="M5.8,5.1C7,5.1,8,4.1,8,2.9c0-1.2-1-2.2-2.2-2.2c-1.2,0-2.2,1-2.2,2.2C3.6,4.1,4.6,5.1,5.8,5.1z"/>
                                </svg>
                            </a>
                            <ul class="dropdown-menu">
                                @auth
                                    <li>
                                        <a class="dropdown-item" href="{{ route('dashboard.client', ['user' => Auth::user()]) }}">
                                            Panel de usuario
                                        </a>
                                    </li>
                                    <li>                        
                                        <a 
                                            class="dropdown-item" href="{{ route('logout') }}" 
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            Cerrar sesión
                                         </a>
                                         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                @endauth
                                @guest
                                    <li>
                                        <a class="dropdown-item" href="/login">
                                            Iniciar sesión
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="/register">
                                            Regístrate ahora
                                        </a>
                                    </li>
                                @endguest
                            </ul>
                        </div>
                    </li>
                    @auth
                    <li>
                        <a href="#">
                            <svg version="1.1" id="wishlist" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            viewBox="0 0 13 12" style="enable-background:new 0 0 13 12;" xml:space="preserve">
                            <path class="st0" d="M11.2,1.6c-0.3-0.3-0.6-0.5-1-0.7C9.8,0.8,9.4,0.7,9,0.7S8.2,0.8,7.9,0.9c-0.4,0.2-0.7,0.4-1,0.7L6.3,2.1
                                L5.7,1.6C5.2,1,4.4,0.7,3.6,0.7C2.8,0.7,2,1,1.5,1.6C0.9,2.1,0.6,2.9,0.6,3.7c0,0.8,0.3,1.6,0.9,2.1l0.6,0.6l4.3,4.3l4.3-4.3
                                l0.6-0.6c0.3-0.3,0.5-0.6,0.7-1c0.2-0.4,0.2-0.8,0.2-1.2c0-0.4-0.1-0.8-0.2-1.2S11.4,1.8,11.2,1.6L11.2,1.6z"/>
                            </svg>
                        </a>
                    </li>
                    @endauth
                    <li class="cart-section position-relative">
                        @auth
                            <a class="cart" href="{{ route('newcart.index') }}">
                                <svg version="1.1" id="cart" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                viewBox="0 0 13 12" style="enable-background:new 0 0 13 12;" xml:space="preserve">
                                    <path class="st0" d="M4.9,10.7c0.3,0,0.5-0.2,0.5-0.5c0-0.3-0.2-0.5-0.5-0.5c-0.3,0-0.5,0.2-0.5,0.5C4.5,10.5,4.7,10.7,4.9,10.7z"/>
                                    <path class="st0" d="M10.2,10.7c0.3,0,0.5-0.2,0.5-0.5c0-0.3-0.2-0.5-0.5-0.5c-0.3,0-0.5,0.2-0.5,0.5C9.7,10.5,9.9,10.7,10.2,10.7z"
                                        />
                                    <path class="st0" d="M1.1,0.7H3l1.3,6.4c0,0.2,0.2,0.4,0.3,0.6C4.8,7.7,5,7.8,5.3,7.8h4.6c0.2,0,0.4-0.1,0.6-0.2s0.3-0.3,0.3-0.6
                                        l0.8-4H3.5"/>
                                </svg>
                            </a>
                            @if(isset($cartCount) && $cartCount > 0)
                                <span>{{ $cartCount }}</span>
                            @else
                                <span>0</span>
                            @endif
                        @else
                            <a href="{{ route('newcart.index') }}">
                                <svg version="1.1" id="cart" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                viewBox="0 0 13 12" style="enable-background:new 0 0 13 12;" xml:space="preserve">
                                    <path class="st0" d="M4.9,10.7c0.3,0,0.5-0.2,0.5-0.5c0-0.3-0.2-0.5-0.5-0.5c-0.3,0-0.5,0.2-0.5,0.5C4.5,10.5,4.7,10.7,4.9,10.7z"/>
                                    <path class="st0" d="M10.2,10.7c0.3,0,0.5-0.2,0.5-0.5c0-0.3-0.2-0.5-0.5-0.5c-0.3,0-0.5,0.2-0.5,0.5C9.7,10.5,9.9,10.7,10.2,10.7z"
                                        />
                                    <path class="st0" d="M1.1,0.7H3l1.3,6.4c0,0.2,0.2,0.4,0.3,0.6C4.8,7.7,5,7.8,5.3,7.8h4.6c0.2,0,0.4-0.1,0.6-0.2s0.3-0.3,0.3-0.6
                                        l0.8-4H3.5"/>
                                </svg>
                                <span>{{ count(Session::get('cart', [])) }}</span>
                            </a>
                        @endauth
                    </li> 
                </ul>           
            </div>
        </div>
    </div>
    @include('includes.navform')
</header>



