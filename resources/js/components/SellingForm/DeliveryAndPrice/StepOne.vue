<template>
    <div class="modulo-pasos">
            <div class="row">
                <div class=" col-lg-7 col-md-12">
                    <h2>Envío o retiro del artículo</h2>
                    <p class="bajada-h2">Una vez que tu artículo sea vendido, lo enviarás a la sucursal del courier o prefieres que gestionemos su retiro.</p>
                    <p>Llevas el articulo a la sucursal o prefieres que gestionemos el retiro</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="sucursalYes">
                        <label class="form-check-label" for="sucursalYes">Sí, puedo llevarlo a la sucursal</label>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="sucursalNo">
                        <label class="form-check-label" for="sucursalNo">No, prefiero que vengan a retirarlo (costo adicional $3.500)</label>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <p>*Ten presente que la persona que compre tu artículo eligirá si desea que el envío sea por Chilexpress o Blue Express</p>
                </div>
            </div> 
            
            <div>
                <p>El artículo será retirado en la siguiente dirección:</p>
            </div>  
            <div class="row">
                <div class="col-lg-7 col-md-12">
                    <div>
                        <label for="addName" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="addName" placeholder="Direccion">
                    </div>
                </div>
                <div class="col-lg-5 col-md-12">
                    <div>
                        <label for="contPhone" class="form-label">Contacto nombre + fono </label>
                        <input type="text" class="form-control" id="contPhone" placeholder="--">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <label for="region-pro">Región</label>
                    <select id="region-pro" class="form-select" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="col-lg-4 col-md-12">
                    <label for="comuna-pro">Comuna</label>
                    <select id="comuna-pro" class="form-select" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="col-lg-4 col-md-12">
                    <a href="#">
                        <font-awesome-icon :icon="['far', 'pen-to-square']" />
                        <span>Cambiar dirección</span>
                    </a>
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