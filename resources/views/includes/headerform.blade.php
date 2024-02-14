<header class="fixed-top"> 
    <div class="top-header">
        <div class="container d-flex justify-content-end">
                @auth
                    @if(isset($cartCount) && $cartCount > 0)
                        <a href="{{ route('cart.index') }}" style="color: #fff; text-decoration: none;">Cart ({{ $cartCount }} items)</a>
                    @else
                        <p>Your cart is empty.</p>
                    @endif
                @else    
                    <a href="{{ route('cart.index') }}" style="color:#fff;text-decoration:none;">Cart ({{ count(Session::get('cart', [])) }} items)</a>
                @endauth
                @auth
                    <div style="color:#fff;">
                        Bienvenido, {{ auth()->user()->name }}!
                        @if(auth()->user()->hasRole('customer'))
                            (Cliente)
                        @elseif(auth()->user()->hasRole('admin'))
                            (Admin)
                        @endif
                    </div>
                    <div style="color:#fff;">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                         {{ __('Logout') }}
                         </a>
                         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                @endauth
                <ul class="iconos">
                    <li>
                        <div class="dropdown">
                            <a class="user dropdown-toggle" data-bs-toggle="dropdown">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="17" viewBox="0 0 15 17" fill="none">
                                    <path d="M3.35376 4.45892C3.35376 2.27247 5.12623 0.5 7.31269 0.5C9.49914 0.5 11.2716 2.27247 11.2716 4.45892C11.2716 6.64538 9.49914 8.41785 7.31269 8.41785C5.12623 8.41785 3.35376 6.64538 3.35376 4.45892Z" fill="white"/>
                                    <path d="M1.28064 11.3576C2.02308 10.6151 3.03005 10.198 4.08002 10.198H10.5434C11.5934 10.198 12.6004 10.6151 13.3428 11.3576C14.0853 12.1 14.5024 13.107 14.5024 14.1569V15.7728C14.5024 16.1538 14.2094 16.4663 13.8365 16.4974L13.8208 16.4986C13.8057 16.4995 13.7905 16.5 13.7752 16.5C13.7598 16.5 13.7446 16.4995 13.7295 16.4986H0.893925C0.878837 16.4995 0.863625 16.5 0.848302 16.5C0.446676 16.5 0.121094 16.1744 0.121094 15.7728V14.1569C0.121094 13.107 0.538193 12.1 1.28064 11.3576Z" fill="white"/>
                                </svg>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/login">Login</a></li>
                                <li><a class="dropdown-item" href="/register">Registrarse</a></li>
                                @auth
                                    <li><a class="dropdown-item" href="{{ route('dashboard.client', ['user' => Auth::user()]) }}">Mi cuenta</a></li>
                                @endauth
                            </ul>
                        </div>
                    </li>
                    <li><a class="wishlist" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="17" viewBox="0 0 19 17" fill="none">
                            <path d="M16.6588 2.32611C16.2386 1.90569 15.7396 1.57219 15.1905 1.34465C14.6413 1.11711 14.0527 1 13.4583 1C12.8639 1 12.2753 1.11711 11.7262 1.34465C11.177 1.57219 10.6781 1.90569 10.2579 2.32611L9.38578 3.19821L8.51367 2.32611C7.66486 1.4773 6.51363 1.00044 5.31323 1.00044C4.11283 1.00044 2.96159 1.4773 2.11278 2.32611C1.26397 3.17492 0.787109 4.32616 0.787109 5.52656C0.787109 6.72696 1.26397 7.87819 2.11278 8.727L9.38578 16L16.6588 8.727C17.0792 8.30679 17.4127 7.80785 17.6402 7.25871C17.8678 6.70957 17.9849 6.12097 17.9849 5.52656C17.9849 4.93214 17.8678 4.34355 17.6402 3.7944C17.4127 3.24526 17.0792 2.74633 16.6588 2.32611Z" fill="white" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a></li>
                    <li>
                        <a class="cart" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.566284 0.738281C0.290142 0.738281 0.0662842 0.962139 0.0662842 1.23828C0.0662842 1.51442 0.290142 1.73828 0.566284 1.73828H2.96629L3.58409 4.82497C3.58653 4.84135 3.58977 4.85747 3.59377 4.8733L4.76832 10.7417L4.7684 10.7421C4.85556 11.1804 5.09408 11.5742 5.44223 11.8544C5.78915 12.1337 6.22291 12.2826 6.6681 12.2752H13.4872C13.9324 12.2826 14.3661 12.1337 14.713 11.8544C15.0613 11.5741 15.2998 11.1802 15.3869 10.7417L15.3877 10.7379L16.5116 4.84426C16.5395 4.69788 16.5007 4.54669 16.4057 4.43187C16.3107 4.31706 16.1695 4.25059 16.0205 4.25059H4.48896L3.86641 1.14015C3.81964 0.906474 3.61445 0.738281 3.37614 0.738281H0.566284ZM6.18448 16.7389C6.98516 16.7389 7.63424 16.0898 7.63424 15.2891C7.63424 14.4884 6.98516 13.8394 6.18448 13.8394C5.3838 13.8394 4.73472 14.4884 4.73472 15.2891C4.73472 16.0898 5.3838 16.7389 6.18448 16.7389ZM15.3624 15.2891C15.3624 16.0898 14.7133 16.7389 13.9126 16.7389C13.112 16.7389 12.4629 16.0898 12.4629 15.2891C12.4629 14.4884 13.112 13.8394 13.9126 13.8394C14.7133 13.8394 15.3624 14.4884 15.3624 15.2891Z" fill="white"/>
                            </svg>
                        </a>
                    </li> 
                </ul>           
            </div>
        </div>
    </div>
    @include('includes.navform')
</header>


