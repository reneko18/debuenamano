<template>
    <div class="modulo-pasos">
            <div class="row">
                <div class="col-lg-7 col-md-12">
                    <h2>Una vez que compren tu artículo ¿A que cuenta te depositamos el pago?.</h2>
                    <p class="bajada-h2">Define el precio de venta de tu articulo considerando la comisión de DBM.</p>
                </div>
            </div>
            <div class="row col-md-11 mx-auto">
                <div class="col">
                    <div>
                        <label for="infoPayName" class="form-label">Nombre y apellido</label>
                        <input type="text" class="form-control" id="infoPayName" placeholder="Nombre y Apellido">
                    </div>
                    <div>
                        <label for="infoPayBank" class="form-label">Banco</label>
                        <select id="infoPayBank" class="form-select" aria-label="Default select example">
                            <option selected>Elige el banco</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div>
                        <label for="infoPayAccountNumber" class="form-label">Nº de cuenta</label>
                        <input type="text" class="form-control" id="infoPayAccountNumber" placeholder="">
                    </div>
                </div>
                <div class="col">
                    <div>
                        <label for="infoPayRut" class="form-label">Rut</label>
                        <input type="text" class="form-control" id="infoPayRut" placeholder="Rut">
                    </div>
                    <div>
                        <label for="infoPayTypeAccount" class="form-label">Tipo de cuenta</label>
                        <select id="infoPayTypeAccount" class="form-select" aria-label="Default select example">
                            <option selected>Elige el tipo de cuenta</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div>
                        <a href="#">
                            <svg version="1.1" id="cardSellingForm" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                viewBox="0 0 22 16" xml:space="preserve">
                                <path class="st0" d="M18.5,1H2.8C1.8,1,1,1.8,1,2.8v10.5c0,1,0.8,1.8,1.8,1.8h15.8c1,0,1.8-0.8,1.8-1.8V2.8C20.3,1.8,19.5,1,18.5,1z
                                    "/>
                                <path class="st0" d="M1,6.2h19.3"/>
                            </svg>
                            <span>Definir como cuenta prederterminada</span>
                        </a>
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
    <style>
        #cardSellingForm{
            width:100%;
            max-width: 20px;
            margin-right: 1rem;
        }
        #cardSellingForm .st0{
            fill:none;
            stroke:#728C54;
            stroke-width:2;
            stroke-linecap:round;
            stroke-linejoin:round;
        }
    </style>
    
    