<footer>
    <hr class="hr-verde">
    <div class="top-footer">
        <div class="container mx-auto row">
            <div class="col-md-4 mb-24">
                <img src="{{ asset('/img/logo-footer.svg')}}" alt="logo footer">
                <p>Tu tienda virtual para bebés, niños y niñas, donde todos los artículos están con poco uso y muy bien cuidados.</p>
                <div class="d-flex social-icons">
                    <a href="#" class="circle">
                        <svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.76288 0.987305H6.51288C5.51832 0.987305 4.56449 1.38239 3.86123 2.08565C3.15797 2.78892 2.76288 3.74274 2.76288 4.7373V6.9873H0.512878V9.9873H2.76288V15.9873H5.76288V9.9873H8.01288L8.76288 6.9873H5.76288V4.7373C5.76288 4.53839 5.8419 4.34763 5.98255 4.20697C6.1232 4.06632 6.31397 3.9873 6.51288 3.9873H8.76288V0.987305Z" fill="#D29C37"/>
                        </svg>
                    </a>
                    <a href="#" class="circle">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.8872 1.9873H5.38721C3.31614 1.9873 1.63721 3.66624 1.63721 5.7373V13.2373C1.63721 15.3084 3.31614 16.9873 5.38721 16.9873H12.8872C14.9583 16.9873 16.6372 15.3084 16.6372 13.2373V5.7373C16.6372 3.66624 14.9583 1.9873 12.8872 1.9873Z" stroke="#D29C37" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12.136 9.01552C12.2286 9.6397 12.122 10.2772 11.8313 10.8373C11.5407 11.3974 11.0809 11.8516 10.5172 12.1353C9.95359 12.419 9.31485 12.5177 8.69185 12.4175C8.06885 12.3172 7.49333 12.0231 7.04714 11.5769C6.60095 11.1307 6.30681 10.5552 6.20656 9.93218C6.10631 9.30918 6.20506 8.67044 6.48876 8.1068C6.77245 7.54316 7.22665 7.08332 7.78675 6.7927C8.34685 6.50208 8.98433 6.39546 9.60851 6.48802C10.2452 6.58243 10.8346 6.87912 11.2898 7.33425C11.7449 7.78938 12.0416 8.37883 12.136 9.01552Z" stroke="#D29C37" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M13.2637 5.36182H13.2697" stroke="#D29C37" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="col-md-6 mb-24">
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
            <div class="col-md-2 mb-24">
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
            <div class="col-md-2">
                <span>DBM - {{ date('Y') }}</span>
            </div>
            <div class="col-md-10 d-md-flex justify-content-md-end">
            <ul class="nav-bottom-footer">
                <li><a href="#">Políticas de devolución</a></li>
                <li><a href="#">Políticas de privacidad</a></li>
                <li><a href="{{ route('terms') }}">Términos y condiciones</a></li>
            </div>
        </div>
    </div>
</footer>