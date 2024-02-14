@extends('includes.baseform')
@section('title')
  Formulario de publicacion de producto - De Buena Mano
@endsection
@section('content')
    <section class="container-fluid p-pages pb-5">
        <div class="container">
            <div class="col-6 mx-auto">
                <h1>{{ auth()->user()->name }} ✨</h1>
                <p>Estamos emocionados de ser parte de tu experiencia en nuestro marketplace y de ver lo que tienes para compartir con nuestra comunidad.</p>
                <p>Nuestro equipo está trabajando arduamente para revisar tu publicación y asegurarse de que todo esté en orden. Este proceso suele ser rápido, así que puedes esperar buenas noticias pronto.</p>
                <p>Mientras tanto, si hay algo más en lo que podamos ayudarte o alguna pregunta que quieras hacernos, no dudes en ponerte en contacto. Estamos aquí para ti.</p>
                <p>¡Gracias por ser parte de nuestra comunidad y por compartir tu increíble contenido!</p>
                <div class="d-flex justify-content-center align-items-center mt-5">
                    <a href="{{ route('inicio') }}" class="underline-dbm mr-5">Volver al home</a>
                    <a href="{{ route('sellingform.show') }}" class="btn boton-principal">Enviar otro artículo</a>
                </div>
            </div>
        </div>        
    </section>
@endsection

@push('confetti')
    <script src="https://cdn.jsdelivr.net/npm/@tsparticles/confetti@3.0.3/tsparticles.confetti.bundle.min.js"></script>
    <script>
        function triggerConfetti() {
            const count = 200,
                defaults = {
                    origin: { y: 0.7 },
                };

            function fire(particleRatio, opts) {
                confetti(
                    Object.assign({}, defaults, opts, {
                        particleCount: Math.floor(count * particleRatio),
                    })
                );
            }

            fire(0.25, {
                spread: 26,
                startVelocity: 55,
            });

            fire(0.2, {
                spread: 60,
            });

            fire(0.35, {
                spread: 100,
                decay: 0.91,
                scalar: 0.8,
            });

            fire(0.1, {
                spread: 120,
                startVelocity: 25,
                decay: 0.92,
                scalar: 1.2,
            });

            fire(0.1, {
                spread: 120,
                startVelocity: 45,
            });
        }

        window.onload = function() {
            triggerConfetti();
        };
    </script>
@endpush