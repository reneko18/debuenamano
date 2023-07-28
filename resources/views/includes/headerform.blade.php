<header>
    <div class="top-header">
        <div class="container d-flex justify-content-end">
            <div class="icons">
                <a class="user" href="#">
                    <img src="{{ asset('/icons/user.svg')}}" alt="icono usuario">                    
                </a>
                <a class="wishlist" href="#">
                    <img src="{{ asset('/icons/wishlist.svg')}}" alt="icono wishlist">
                </a>
                <a class="cart" href="#">
                    <img src="{{ asset('/icons/cart.svg')}}" alt="icono carro">
                </a>            
            </div>
        </div>
    </div>
    @include('includes.navform')
</header>