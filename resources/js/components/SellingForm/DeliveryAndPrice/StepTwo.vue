<template>
    <div class="modulo-pasos">
            <div class="row">
                <div class="col-lg-7 col-md-12">
                    <h2>¿Cuál es el precio de venta de tu artículo?</h2>
                    <p class="bajada-h2">Define el precio de venta de tu articulo considerando la comisión de DBM.</p>
                </div>
            </div>
            <div class="col-lg-5 col-md-12">
                <input type="text" class="form-control" id="priceItem" placeholder="Precio">
                <div class="row">
                    <div class="col">
                        <p>-$21.250</p>
                        <p>-$3.500</p>
                        <p>$60.250</p>
                    </div>
                    <div class="col">
                        <p>Comisión DBM 25%</p>
                        <p>Retiro a domicilio</p>
                        <p>Tu ganancia</p>
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