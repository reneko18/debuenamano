<template>
<div class="modulo-pasos">
        <div class="row">
                    <div class=" col-lg-7 col-md-12">
                        <h2>Cuéntanos, en que estado de uso se encuentra el artículo</h2>
                        <p class="bajada-h2">Tu transparencia nos ayuda a construir confianza entre los compradores y garantiza una experiencia de compra satisfactoria para todos.</p>
                    </div>
        </div>
        <div class="row">
                    <div class="col-lg-5 col-md-12">
                        <div>
                            <label for="statusItem" class="form-label">Estado</label>
                            <select id="statusItem" class="form-select" aria-label="Default select example">
                                <option selected>Selecciona una categoría</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="usageItem" class="form-label">Tiempo de uso</label>
                                <input type="text" class="form-control" placeholder="00" id="usageItem">
                            </div>
                            <div class="col-md-4">
                                <label for="usageItem-pro" class="form-label"></label>
                                <select id="usageItem-pro" class="form-select" aria-label="Select Usage">
                                    <option selected>Tiempo</option>
                                    <option value="1">Dias</option>
                                    <option value="2">Meses</option>
                                    <option value="3">Años</option>
                                </select>
                            </div>
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

