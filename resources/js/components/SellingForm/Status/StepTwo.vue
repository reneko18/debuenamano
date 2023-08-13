<template>
    <div class="modulo-pasos">
            <div class="row">
                <div class=" col-lg-7 col-md-12">
                    <h2>Observaciones y/o recomendaciones sobre el artículo</h2>
                    <p class="bajada-h2">Si hay alguna característica especial, consejo de uso o cualquier otro detalle que quieras compartir con los posibles compradores, te invitamos a que nos lo cuentes.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5 col-md-12">
                    <div>
                        <label for="obser-pro" class="form-label">Observación</label>
                        <textarea id="obser-pro" class="form-control" placeholder="Que observaciones presenta el artículo..."></textarea>                          
                    </div>
                </div>
                <div class="col-lg-7 col-md-12">
                    <div>
                        <label for="reco-pro" class="form-label">Recomendaciones</label>
                        <textarea id="reco-pro" class="form-control" placeholder="Que recomendación darías para el correcto uso del artículo..."></textarea>                          
                    </div>
                </div>
            </div>   
            <button class="btn boton-principal">Continuar <font-awesome-icon :icon="['fas', 'chevron-right']" /></button>
    </div>
    </template>
    <script>
    export default {
        setup() {
            
        },
    }
    </script>
    
    