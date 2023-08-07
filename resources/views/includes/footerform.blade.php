<footer>
    <hr class="hr-verde">
    <div class="top-footer">
        <div class="container mx-auto row">
            <div class="col-4">
                <img src="{{ asset('/img/logo-footer.svg')}}" alt="logo footer">
                <p>Tu tienda virtual para bebés, niños y niñas, donde todos los artículos están con poco uso y muy bien cuidados.</p>
                <div class="d-flex">
                    <img src="{{ asset('/icons/face-footer.svg')}}" alt="icono facebook footer">
                    <img src="{{ asset('/icons/insta-footer.svg')}}" alt="icono instagram footer">
                </div>
            </div>
            <div class="col-md-6">
                <h2>Categorías</h2>
                <div class="row">
                    <div class="col-md-4">
                        <ul class="nav-footer">
                            <li><a href="#">Accesorios de baño</a></li>
                            <li><a href="#">Alimentación del bebé</a></li>
                            <li><a href="#">Artículos de maternidad</a></li>
                            <li><a href="#">Cunas y camas</a></li>
                            <li><a href="#">Decoración</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="nav-footer">
                            <li><a href="#">Disfraces infantiles</a></li>
                            <li><a href="#">Juguetes, juegos y peluches</a></li>
                            <li><a href="#">Mobiliario infantil</a></li>
                            <li><a href="#">Paseo</a></li>
                            <li><a href="#">Transporte del bebé</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="nav-footer">
                            <li><a href="#">Tronas y andadores</a></li>
                            <li><a href="#">Seguridad y cuidado</a></li>
                            <li><a href="#">Otros</a></li>
                        </ul>
                    </div>
                </div>
            </div> 
            <div class="col-md-2">
                <h2>Centro de ayuda</h2>
                <div class="row">
                    <div class="col">
                        <ul class="nav-footer">
                            <li><a href="#">Tu orden</a></li>
                            <li><a href="#">Tu cuenta</a></li>
                            <li><a href="#">Tus favoritos</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-footer">
        <div class="container mx-auto row">
            <div class="col-7">
                <span>DBM - {{ date('Y') }}</span>
            </div>
            <div class="col-5">
            <ul class="nav-bottom-footer">
                <li><a href="#">Políticas de devolución</a></li>
                <li><a href="#">Políticas de privacidad</a></li>
                <li><a href="#">Términos y condiciones</a></li>
            </div>
        </div>
    </div>
</footer>