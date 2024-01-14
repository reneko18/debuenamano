<template>
    <div class="col-10 mx-auto mb-5">
        <div>
            <h2>Información personal</h2>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" />
                </div>
            </div>
            <div class="col-3">
                <div class="mb-3">
                    <label for="lastname" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="lastname" />
                </div>
            </div>
            <div class="col-3">
                <div class="mb-3">
                    <label for="birthdate" class="form-label"
                        >Fecha de nacimiento</label
                    >
                    <input type="text" class="form-control" id="birthdate" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="mb-3">
                    <label for="number" class="form-label"
                        >Nº de contacto</label
                    >
                    <input type="text" class="form-control" id="number" />
                </div>
            </div>
            <div class="col-3">
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" />
                </div>
            </div>
        </div>
        <div>
            <a href="" class="btn boton-principal"
                >Editar información personal</a
            >
        </div>
    </div>
    <div class="col-10 mx-auto mb-5">
        <div>
            <h2>Cambio de contraseña</h2>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="mb-3">
                    <label for="password" class="form-label"
                        >Actual contraseña
                    </label>
                    <input type="password" class="form-control" id="password" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="mb-3">
                    <label for="password-confirm" class="form-label"
                        >Ingresa tu nueva contraseña
                    </label>
                    <input
                        type="password"
                        class="form-control"
                        id="password-confirm"
                    />
                </div>
            </div>
            <div class="col-8">
                <span>*Debe contener mínimo 8 carácteres</span>
            </div>
        </div>
        <div>
            <a href="" class="btn boton-principal">Cambiar contraseña</a>
        </div>
    </div>
    <div class="col-10 mx-auto mb-5">
        <div>
            <h2>Cuenta de depósito</h2>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="mb-3">
                    <label for="namebank" class="form-label"
                        >Nombre y apellido</label
                    >
                    <input type="text" class="form-control" id="namebank" />
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="rut" class="form-label">Rut</label>
                    <input type="text" class="form-control" id="rut" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="mb-3">
                    <label for="bank" class="form-label">Banco</label>
                    <input type="text" class="form-control" id="bank" />
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="accounttype" class="form-label"
                        >Tipo de cuenta</label
                    >
                    <input type="text" class="form-control" id="accounttype" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="mb-3">
                    <label for="accountnumber" class="form-label"
                        >Nº de cuenta</label
                    >
                    <input
                        type="text"
                        class="form-control"
                        id="accountnumber"
                    />
                </div>
            </div>
        </div>
        <div>
            <a href="" class="btn boton-principal"
                >Cambiar cuenta de depósito</a
            >
        </div>
    </div>
</template>
<script setup></script>
