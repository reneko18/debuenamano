<template>
    <Toast/>
    <div class="container pt-5">
        <div class="row">
            <div class="col">
                <h1>Publicación en revisión</h1>
            </div>
            <div class="col d-flex justify-content-end align-items-center">
                <a class="underline-dbm save-edit-pro cursor-pointer" @click="SaveProductStatus">Guardar</a>
                <a class="btn boton-principal" @click="UpdateProductStatus">Enviar a Vitrina <font-awesome-icon :icon="['fas', 'chevron-right']" /></a>
            </div>
        </div> 
        <div class="row">
            <div class="col">
                <p><strong>Enviado el :</strong> {{ formattedCreateDate }}</p>
            </div>
            <div class="col">
                <p><strong>Fecha ultima modificación:</strong> {{ formattedUpdatedDate }}</p>
            </div>
        </div>       
        <div><h2>Presentación</h2></div>
        <div class="row">
            <div class="col-lg-5 col-md-12 left-column">
                <div>
                    <label for="productName" class="form-label">Nombre*</label>
                    <input
                        type="text"
                        class="form-control"
                        id="productName"
                        placeholder="Nombre del artículo"
                        v-model="productInfo.name"
                    />
                </div>
                <div
                    class="position-relative"
                    v-click-outside-element="closeDropdown"
                >
                    <div class="position-relative div-cat">
                        <label for="testCat" class="form-label"
                            >Categoría*</label
                        >
                        <input
                            id="testCat"
                            type="text"
                            class="form-control cat-select"
                            :value="productInfo?.category?.name"
                            @click="showAndCloseDropdown"
                            readonly
                        />
                        <font-awesome-icon
                            :icon="['fas', 'chevron-down']"
                            @click="showAndCloseDropdown"
                        />
                    </div> 
                    <div id="dropdown-cats">
                        <div class="accordion" id="accordionCategories">
                            <div v-for="category in categories">                         
                                <div
                                    v-if="category.children == ''"
                                    class="cat-sin-hijo"
                                >                                  
                                    <input
                                        :id="'cat-' + category.id"
                                        class="btn-check"
                                        :value="category"
                                        type="radio"
                                        name="categoria" 
                                        v-model="productInfo.category"         
                                    />
                                    <label
                                        :for="'cat-' + category.id"
                                        class="btn"
                                        >{{ category.name }}</label
                                    >
                                </div>
                                <h2 v-else class="accordion-header">    
                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        :data-bs-target="generateDataBsTarget(category.id)"
                                    >
                                        {{ category.name }}
                                    </button>
                                </h2>
                                <div
                                    :id="generateID(category.id)"
                                    class="accordion-collapse collapse"
                                    data-bs-parent="#accordionCategories"
                                >
                                    <div class="accordion-body">
                                        <div
                                            v-for="subcategory in category.children"
                                        >
                                            <div
                                                v-if="
                                                    category.id ==
                                                    subcategory.parent_id
                                                "
                                            >
                                                <input
                                                    :id="
                                                        'subcat-' +
                                                        subcategory.id
                                                    "
                                                    class="btn-check"
                                                    :value="subcategory"
                                                    type="radio"
                                                    name="subcategoria"
                                                    v-model="productInfo.category"                                          
                                                />
                                                <label
                                                    :for="
                                                        'subcat-' +
                                                        subcategory.id
                                                    "
                                                    class="btn"
                                                    >{{
                                                        subcategory.name
                                                    }}</label
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>
                </div>
                <div class="cont-genre">
                    <label for="productGenre" class="form-label">Género</label>
                    <select-dbm-static
                        id="productGenre"
                        :items="genders"   
                        :selected="productInfo.gender_id"
                        @update:selected="updateSelectedGender"
                        placeholder="Seleccione un género"
                    />
                </div>
            </div>
            <div class="col-lg-7 col-md-12">
                <span class="tit-age-range">Rango de edad de tu articulo*</span>
                <div class="row row-age-range">
                    <select-dbm-static
                        id="range-age"
                        :items="rangeAge"   
                        :selected="productInfo.age_filter_id"
                        @update:selected-static="updateSelectedRangeAge"
                        placeholder="Seleccione un rango"
                    /> 
                </div>
                <div>
                    <label for="desc-pro" class="form-label"
                        >Breve descripción*</label
                    >
                    <div class="position-relative">
                        <textarea
                            id="desc-pro"
                            class="form-control"
                            placeholder="Describe el artículo..."
                            v-model="productInfo.description"
                            @input="updateCharacterCount" 
                            :style="{ height: textareaHeight + 'px' }"                           
                            rows="4"
                            maxlength="280"
                        ></textarea>
                        <span class="character-count-badge"
                            >{{ characterCount }}/280 caracteres</span
                        >
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div>
                    <label for="brandName" class="form-label">Marca*</label>
                    <input
                        type="text"
                        class="form-control"                       
                        id="brandName"
                        placeholder="Ingresa el nombre de la marca"
                        v-model="productInfo.brand"
                    />
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div>
                    <label for="modelName" class="form-label">Modelo</label>
                    <input
                        type="text"
                        class="form-control"
                        id="modelName"
                        placeholder="Ingresa el modelo del artículo"
                        v-model="productInfo.model"
                    />
                </div>
            </div>
        </div>
        <div class="edit-pro-admin row-main-dim">
                <div class="row-child-dim">
                    <div class="col-dim">
                        <label for="height-pro" class="form-label">Alto*</label>
                        <input
                            type="text"
                            class="form-control"  
                            placeholder="0,0"
                            id="height-pro"
                            v-model="deliveryInformation.height"  
                            @input="handleNumericInput('height')"                          
                        />
                    </div>
                    <div class="col-dim">
                        <label for="unh-pro" class="form-label"></label>
                        <select
                            id="unh-pro"
                            class="form-select"                      
                            v-model="deliveryInformation.height_unit"
                        >
                            <option value="cm">cm</option>
                            <option value="in">in</option>
                        </select>
                    </div>
                </div>
                <div class="row-child-dim">
                    <div class="col-dim">
                        <label for="width-pro" class="form-label">Ancho*</label>
                        <input
                            type="text"
                            class="form-control"           
                            placeholder="0,0"
                            id="width-pro"
                            v-model="deliveryInformation.width"
                            @input="handleNumericInput('width')"
                        />
                    </div>
                    <div class="col-dim">
                        <label for="unw-pro" class="form-label"></label>
                        <select
                            id="unw-pro"
                            class="form-select"                  
                            v-model="deliveryInformation.width_unit"
                        >
                            <option value="cm">cm</option>
                            <option value="in">in</option>
                        </select>
                    </div>
                </div>
                <div class="row-child-dim">
                    <div class="col-dim">
                        <label for="long-pro" class="form-label">Largo*</label>
                        <input
                            type="text"
                            class="form-control"  
                            placeholder="0,0"
                            id="long-pro"
                            v-model="deliveryInformation.length"
                            @input="handleNumericInput('length')"
                        />
                    </div>
                    <div class="col-dim">
                        <label for="unl-pro" class="form-label"></label>
                        <select
                            id="unl-pro"
                            class="form-select"                   
                            v-model="deliveryInformation.length_unit"
                        >
                            <option value="cm">cm</option>
                            <option value="in">in</option>
                        </select>
                    </div>
                </div>
                <div class="row-child-dim">
                    <div class="col-dim">
                        <label for="weight-pro" class="form-label">Peso</label>
                        <input
                            type="text"
                            class="form-control"   
                            placeholder="0,0"
                            id="weight-pro"
                            v-model="deliveryInformation.weight"
                            @input="handleNumericInput('weight')"
                        />
                    </div>
                    <div class="col-dim position-relative">
                        <label for="unwe-pro" class="form-label"></label>
                        <select
                            id="unwe-pro"
                            class="form-select"                 
                            v-model="deliveryInformation.weight_unit"
                        >
                            <option value="g">g</option>
                            <option value="Kg">Kg</option>
                        </select>
                    </div>
                </div>
        </div>

        <div><h2>Estado</h2></div>
        <div class="row">
            <div class="col-lg-5 col-md-12">
                <div>
                    <label for="statusItem" class="form-label">Estado*</label>
                    <select
                        id="statusItem"
                        class="form-select"        
                        v-model="productInfo.status"
                    >
                        <option disabled selected value="">
                            Seleccione un estado
                        </option>
                        <option value="Usado en buen estado">
                            Usado en buen estado
                        </option>
                        <option value="Sin uso">Sin uso</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-7 col-md-12" v-if="productInfo.status !== 'Sin uso'">
                <div class="row">
                    <div class="col-md-3">
                        <label for="usageItem" class="form-label"
                            >Tiempo de uso*</label
                        >
                        <input
                            type="text"
                            class="form-control"
                            placeholder="00"
                            id="usageItem"
                            v-model="productInfo.used_time"
                            @input="handleNumericInput('used_time')"
                        />
                    </div>
                    <div class="col-md-4">
                        <label for="usageItem-pro" class="form-label"></label>
                        <select
                            id="usageItem-pro"
                            class="form-select"                    
                            v-model="productInfo.used_time_unit"
                        >
                            <option value="Dias">Dias</option>
                            <option value="Meses">Meses</option>
                            <option value="Años">Años</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5 col-md-12">
                <div class="position-relative">
                    <label for="obser-pro" class="form-label"
                        >Observación</label
                    >
                    <textarea
                        id="obser-pro"
                        class="form-control"
                        placeholder="Que observaciones presenta el artículo..."
                        v-model="productInfo.remark"
                        @input="updateCharacterCountObs"
                        rows="4"
                        maxlength="280"
                    ></textarea>
                    <span class="character-count-badge"
                        >{{ characterCountObs }}/280 caracteres</span
                    >
                </div>
            </div>
            <div class="col-lg-7 col-md-12">
                <div class="position-relative">
                    <label for="reco-pro" class="form-label"
                        >Recomendaciones</label
                    >
                    <textarea
                        id="reco-pro"
                        class="form-control"
                        placeholder="Que recomendación darías para el correcto uso del artículo..."
                        v-model="productInfo.advice"
                        @input="updateCharacterCountReco"
                        rows="4"
                        maxlength="280"
                    ></textarea>
                    <span class="character-count-badge"
                        >{{ characterCountReco }}/280 caracteres</span
                    >
                </div>
            </div>
        </div>

        <div><h2>Fotografías</h2></div>
        <div class="row">
            <div class="col-5">
                <div class="cont-upload-image">
                    <div v-bind="getRootProps()" class="dropzone">
                        <svg
                            version="1.1"
                            id="icon-upload"
                            xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink"
                            x="0px"
                            y="0px"
                            viewBox="0 0 29 29"
                            style="enable-background: new 0 0 29 29"
                            xml:space="preserve"
                        >
                            <path
                                class="st0"
                                d="M27.3,18.8v5.6c0,0.7-0.3,1.4-0.8,2c-0.5,0.5-1.2,0.8-2,0.8H5.1c-0.7,0-1.4-0.3-2-0.8c-0.5-0.5-0.8-1.2-0.8-2
                                    v-5.6"
                            />
                            <path class="st0" d="M21.8,9.1l-6.9-6.9L7.9,9.1" />
                            <path class="st0" d="M14.8,2.2v16.7" />
                        </svg>
                        <h3 v-if="isDragActive">Suelta las fotos aquí</h3>
                        <h3 v-else>Arrastra y suelta tus fotos aquí</h3>
                        <h4>Archivos soportados JPG, PNG</h4>
                        <h4>o</h4>
                        <input v-bind="getInputProps()" />
                        <button @click="openFileInput">buscar archivos</button>
                        <p>Peso máximo 2MB</p>
                    </div>
                </div>
            </div>
            <div class="col-7">
                <div class="cont-images-result">
                    <span v-show="productInfo.galleries != ''">Archivos</span>
                    <!-- <div
                        class="row-results"
                        v-for="(image, index) in productInfo.galleries"
                        :key="index"
                    >
                        <div class="first">
                            <img :src="'/' + image.url" :alt="image.alt" />
                            <p>{{ image.alt }}</p>
                        </div>
                        <div class="second">
                            <p>Tamaño</p>
                            <button @click="deleteImage(index)">
                                <font-awesome-icon
                                    :icon="['far', 'trash-can']"
                                />
                            </button>
                        </div>
                    </div> -->
                    <div
                        class="row-results"
                        v-for="(image, index) in productInfo.galleries"
                        :key="index"
                    >
                        <div class="first">
                            <img :src="isBase64Image(image) ? image.src : '/' + image.url" :alt="image.alt" />
                            <p v-if="isBase64Image(image)">{{ image.name }}</p>
                            <p v-else>{{ image.alt }}</p>
                        </div>
                        <div class="second">
                            <p>Tamaño</p>
                            <button @click="deleteImage(index)">
                                <font-awesome-icon :icon="['far', 'trash-can']" />
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div>
            <h2>Datos de origen del despacho</h2>
        </div>
        <div class="modulo-pasos">
            <div class="row">
                <div class="col-4">
                    <div 
                        class="cont-option-delivery" 
                        v-if="productInfo.delivery_information?.option === 'Chilexpress'"
                    >
                        <input
                            type="radio"
                            class="btn-check"
                            name="delivery-option"
                            id="chilexpress"
                            value="Chilexpress"
                            v-model="productInfo.delivery_information.option"
                        />
                        <label
                            class="btn"
                            for="chilexpress" 
                        >
                            <span>LO LLEVO A LA</span>
                            <span>Sucursal de Chilexpress</span>
                        </label>
                    </div>
                    <div 
                        class="cont-option-delivery"  
                        v-else-if="productInfo.delivery_information?.option === 'Domicilio'"
                    >
                        <input
                            type="radio"
                            class="btn-check"
                            name="delivery-option"
                            id="house"
                            value="Domicilio"
                            v-model="productInfo.delivery_information.option"
                        />
                        <label
                            class="btn"
                            for="house"
                        >
                            <span>PREFIERO EL RETIRO</span>
                            <span>Retiro a domicilio</span>
                        </label>
                    </div>
                </div>
                <div class="col-8">
                    <div
                        v-if="
                            productInfo.delivery_information?.option === 'Chilexpress'
                        "
                    >
                        <label for="region" class="form-label"
                            >Tu región *</label
                        >  
                        <select
                            id="region"
                            class="form-select"
                            v-model="selected.region"
                        >
                            <option disabled selected value="">
                                Selecciona una región
                            </option>
                            <option :value="r.regionId" v-for="r in regions">
                                {{ r.regionName }}
                            </option>
                        </select>
                        <label for="city" class="form-label">Tu comuna *</label>
                        <select
                            id="city"
                            class="form-select"
                            v-model="selected.city"
                        >
                            <option disabled selected value="">
                                Selecciona tu comuna
                            </option>
                            <option
                                :value="com.countyName"
                                v-for="com in cities"
                            >
                                {{ com.countyName }}
                            </option>
                        </select>
                        <label for="offices" class="form-label"
                            >Sucursal de Chilexpress *</label
                        >
                        <select
                            id="offices"
                            class="form-select"
                            v-model="productInfo.delivery_information.chile_office"
                        >
                            <option disabled selected value="">
                                Selecciona una sucursal
                            </option>
                            <option
                                :value="offi.officeName"
                                v-for="offi in offices"
                            >
                                {{ offi.officeName }}
                            </option>
                        </select>
                    </div>
                    <div
                        v-else-if="
                            productInfo.delivery_information?.option === 'Domicilio'
                        "
                    >
                        <div>
                            <label for="street" class="form-label"
                                >Calle / Avenida</label
                            >
                            <input
                                type="text"
                                id="street"
                                class="form-control"
                                placeholder="Ingresa tu dirección"
                                v-model="productInfo.delivery_information.address"
                            />
                        </div>
                        <div>
                            <label for="number" class="form-label">Nª</label>
                            <input
                                type="text"
                                id="number"
                                class="form-control"
                                placeholder="Ingresa el número"
                                v-model="productInfo.delivery_information.adddress_number"
                            />
                        </div>
                        <div>
                            <label for="dptoHouse" class="form-label"
                                >Depto/casa</label
                            >
                            <input
                                type="text"
                                id="dptoHouse"
                                class="form-control"
                                placeholder="Ingresa los datos"
                                v-model="productInfo.delivery_information.dpto_house"
                            />
                        </div>
                        <div>
                            <label for="regionHouse" class="form-label"
                                >Tu región *</label
                            >
                            <select
                                id="regionHouse"
                                class="form-select"
                                v-model="selected.region"
                            >
                                <option disabled selected value="">
                                    Selecciona una región
                                </option>
                                <option
                                    :value="r.regionId"
                                    v-for="r in regions"
                                >
                                    {{ r.regionName }}
                                </option>
                            </select>
                        </div>
                        <div>
                            <label for="cityHouse" class="form-label"
                                >Tu comuna *</label
                            >
                            <select
                                id="cityHouse"
                                class="form-select"
                                v-model="selected.city"
                            >
                                <option disabled selected value="">
                                    Selecciona tu comuna
                                </option>
                                <option
                                    :value="com.countyName"
                                    v-for="com in cities"
                                >
                                    {{ com.countyName }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div>
            <h2>Precio</h2>
        </div>
        <div class="modulo-pasos">
            <div class="row">
                <div class="col-lg-7 col-md-12">
                    <h2>¿Cuál es el precio de venta de tu artículo?</h2>
                    <p class="bajada-h2">
                        Define el precio de venta de tu articulo considerando la
                        comisión de DBM.
                    </p>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="input-group mb-3">
                    <span class="input-group-text">$</span>
                    <input
                        type="text"
                        class="form-control input-precio"
                        id="priceItem"
                        placeholder="Precio"
                        v-model="productInfo.price"
                        @input="feeDBM"
                    />
                </div>
                <div class="row row-income">
                <div class="col">
                        <p>- $ {{ isNaN(priceFee) ? 'Ingrese un precio valido' : priceFee }}</p>
                        <p><strong class="price-income">$ {{ isNaN(priceFinal) ? 'Ingrese un precio valido' : priceFinal }}</strong></p>
                    </div>
                    <div class="col text-right">
                        <p>Comisión DBM 22%</p>
                        <p><strong>Tu ganancia</strong></p>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <h2>Cuenta depósito</h2>
        </div>
        <div class="row col-md-11 mx-auto">
            <div class="col">
                <div>
                    <label for="infoPayName" class="form-label"
                        >Nombre y apellido</label
                    >
                    <input
                        type="text"
                        class="form-control"
                        id="infoPayName"
                        placeholder="Nombre y Apellido"
                        v-model="userFullName"
                    />
                </div>
                <div>
                    <label for="infoPayBank" class="form-label">Banco</label>
                    <select
                        id="infoPayBank"
                        class="form-select"
                        v-model="userBank"
                    >
                        <option selected>Elige el banco</option>
                        <option value="Banco BICE">Banco BICE</option>
                        <option value="Banco Consorcio">Banco Consorcio</option>
                        <option value="Banco Corpbanca">Banco Corpbanca</option>
                        <option value="Banco Crédito e Inversiones">
                            Banco Crédito e Inversiones
                        </option>
                        <option value="Banco Estado">Banco Estado</option>
                        <option value="Banco Falabella">Banco Falabella</option>
                        <option value="Banco Internacional">
                            Banco Internacional
                        </option>
                        <option value="Banco Paris">Banco Paris</option>
                        <option value="Banco Ripley">Banco Ripley</option>
                        <option value="Banco Santander">Banco Santander</option>
                        <option value="Banco Security">Banco Security</option>
                        <option value="Banco de Chile / Edwards-Citi">
                            Banco de Chile / Edwards-Citi
                        </option>
                        <option value="Banco del Desarrollo">
                            Banco del Desarrollo
                        </option>
                        <option value="Coopeuch">Coopeuch</option>
                        <option value="HSBC Bank">HSBC Bank</option>
                        <option value="Itau">Itau</option>
                        <option value="Rabobank">Rabobank</option>
                        <option value="Tenpo Prepago">Tenpo Prepago</option>
                        <option value="Prepago Los Héroes">
                            Prepago Los Héroes
                        </option>
                        <option value="Scotiabank">Scotiabank</option>
                        <option value="Scotiabank Azul">Scotiabank Azul</option>
                        <option value="Mercado Pago">Mercado Pago</option>
                        <option value="TAPP Caja Los Andes">
                            TAPP Caja Los Andes
                        </option>
                        <option value="Copec Pay">Copec Pay</option>
                        <option value="La Polar Prepago">
                            La Polar Prepago
                        </option>
                        <option value="Global66">Global66</option>
                    </select>
                </div>
                <div>
                    <label for="infoPayAccountNumber" class="form-label"
                        >Nº de cuenta</label
                    >
                    <input
                        type="text"
                        class="form-control"
                        id="infoPayAccountNumber"
                        placeholder=""
                        v-model="userBankAccount"
                    />
                </div>
            </div>
            <div class="col">
                <div>
                    <label for="infoPayRut" class="form-label">Rut</label>
                    <input
                        type="text"
                        class="form-control"
                        id="infoPayRut"
                        placeholder="Rut"
                        v-model="userRut"
                        @input="formatAndValidateRUT"
                    />      
                </div>
                <div>
                    <label for="infoPayTypeAccount" class="form-label"
                        >Tipo de cuenta</label
                    >
                    <select
                        id="infoPayTypeAccount"
                        class="form-select"
                        v-model="userBankAccountType"
                    >
                        <option value="Cuenta Vista">Cuenta Vista</option>
                        <option value="Cuenta Corriente">
                            Cuenta Corriente
                        </option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, computed, onMounted, onUpdated, watch} from "vue";
import { useDropzone } from "vue3-dropzone";
import Toast from 'primevue/toast';
import { useToast } from "primevue/usetoast";
import SelectDbmStatic from "../components/Dbm/SelectDbmStatic.vue";
const props = defineProps({
    productSlug: { type: String, default: "" },
});

const toast = useToast();

// const formatPrice = (value) => {
//   // Remove non-numeric characters
//   const numericValue = value.replace(/[^0-9]/g, "");

//   // Insert a point separator for thousands
//   return numericValue.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
// };

const genders = ref([]);
const rangeAge = ref([
    {id: 1, value: 1, name:"Recién nacido"},
    {id: 2, value: 2, name:"3 a 12 Meses"},
    {id: 3, value: 3, name:"12 a 24 Meses"},
    {id: 4, value: 4, name:"2 a 6 Años"},
]);
const productInfo = ref({});
const deliveryInformation = ref({});

// const priceFormatDirective = {
//   mounted(el, binding) {
//     const context = binding.instance;

//     el.addEventListener("input", function (e) {
//       // Remove non-numeric characters
//       const value = e.target.value.replace(/[^0-9]/g, "");

//       // Insert a point separator for thousands
//       const formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

//       // Set the formatted value as a string
//       e.target.value = formattedValue;

//       // Save the formatted string to formData.stepEightPrice
//       // If you need to save the numeric value, convert it back to a number
//       // context.formData.stepEightPrice = parseFloat(value);
//       context.productInfo.value.price = formattedValue;
//     });
//   },
// };

// const instance = getCurrentInstance();
// if (instance) {
//   instance.appContext.app.directive("price-format", priceFormatDirective);
// }

// watch(() => productInfo.value.price, (newPrice) => {
//   productInfo.value.price = formatPrice(newPrice);
// });


const characterCount = ref(0);
const textareaHeight = ref(100);
const categories = ref([]);
const dropdown = ref(false);
const activeTrigger = ref(false);
const characterCountObs = ref(0);
const characterCountReco = ref(0);

// Handle gender update
const updateSelectedGender = (newGender) => {
    productInfo.value.gender_id = newGender;
};

// Handle Range Age update
const updateSelectedRangeAge = (newRangeAge) => {
    productInfo.value.age_filter_id = newRangeAge;
};

//Photos 
const isDragActive = ref(false);
const fileInput = ref(null);

const openFileInput = () => {
    if (fileInput.value) {
        fileInput.value.click();
    }
};

const onDrop = (acceptedFiles, rejectedFiles) => {
    Promise.all(
        acceptedFiles.map((file) => {
            return new Promise((resolve) => {
                const reader = new FileReader();

                reader.onload = () => {
                    const image = {
                        src: reader.result,
                        name: file.name,
                        size: `${(file.size / (1024 * 1024)).toFixed(2)} MB`,
                    };

                    productInfo.value.galleries.push(image);
                    resolve();
                };

                reader.readAsDataURL(file);
            });
        })
    ).then(() => {
        console.log('All files processed:', productInfo.value.galleries);
    });

    console.log(acceptedFiles);
    console.log(rejectedFiles);
};

const { getRootProps, getInputProps, ...rest } = useDropzone({
    onDrop,
    onDragEnter: () => (isDragActive.value = true),
    onDragLeave: () => (isDragActive.value = false),
    onDropAccepted: () => (isDragActive.value = false),
});

const deleteImage = (index) => {
    productInfo.value.galleries.splice(index, 1);
};

const isBase64Image = (image) => {
    return image.src && image.src.startsWith('data:image/');
};


//End Photos

//Despacho
const selectedRef = ref({
    region: "",
    city: "",
});
const lastSelected = ref({
    region: "",
    city: "",
});
const selected = ref(selectedRef.value);
const cities = ref([]);
const regions = ref([]);
const offices = ref([]);
const loading = ref(false);

const getComunasChilexpress = async function () {
    const apiKey = "570f3f00500c433a9b2b94e7b4803c1b";
    const apiUrl = "https://testservices.wschilexpress.com/georeference/api/v1.0/coverage-areas";

    try {
        const response = await axios.get(apiUrl, {
            params: {
                api_key: apiKey,
                RegionCode: selectedRef.value.region,
                type: 1,
            },
        });
        cities.value = response.data.coverageAreas;
    } catch (error) {
        console.error("Error fetching cities:", error);
    }
};

const getCoberturaOptions = async function () {
    const apiUrl = "https://testservices.wschilexpress.com/georeference/api/v1.0/offices?Type=0";
    const regionCode = selectedRef.value.region;
    const cityName = selectedRef.value.city;

    try {
        const response = await axios.get(apiUrl, {
            headers: {
                "Cache-Control": "no-cache",
                "Ocp-Apim-Subscription-Key": "570f3f00500c433a9b2b94e7b4803c1b",
            },
            params: {
                RegionCode: regionCode,
                CountyName: cityName,
            },
        });

        offices.value = response.data.offices;
    } catch (error) {
        console.error("Error:", error);
    }
};

const getRegionsChilexpress = async () => {
    try {
        const apiKey = "570f3f00500c433a9b2b94e7b4803c1b";
        const apiUrl = "https://testservices.wschilexpress.com/georeference/api/v1.0/regions";

        loading.value = true;
        const response = await axios.get(apiUrl, {
            params: {
                api_key: apiKey,
            },
        });

        regions.value = response.data.regions;
    } catch (error) {
        console.error("Error fetching regions:", error);
    } finally {
        loading.value = false;
    }
};

//END DESPACHOS

//PRECIO

const priceFee = ref('');
const priceFinal = ref('');

const feeDBM = () => {
        // Remove dots to get the raw number for calculations
        const rawPrice = productInfo.value.price.replace(/[.]/g, "");
        // Check if rawPrice is a valid number
    if (!isNaN(rawPrice)) {
        const fee = Math.round(rawPrice * 0.22);
        const finalAmount = rawPrice - fee;

        // Convert numeric values to strings and format with point as separator and no decimal places
        priceFee.value = fee
            .toString()
            .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            priceFinal.value = finalAmount
            .toString()
            .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    } else {
        // Set a default message when the input is not a valid number
        priceFee.value = 'Ingrese un precio valido';
        priceFinal.value = 'Ingrese un precio valido';
    }
}



watch(() => productInfo.value.price, () => {
  feeDBM();
});
//END PRECIO

//BANK
const userFullName = ref('');
const userBank = ref('');
const userBankAccount = ref('');
const userBankAccountType = ref('');
const userRut = ref('');

// const formatAndValidateRUT = () => {
//             // Obtain the value from the formattedRUT
//             let rut = userRut.value;
//                 .replace(/[^\dKk]/g, "")
//                 .toUpperCase();
//             const length = rut.length;

//             if (length > 1) {
//                 rut = rut.replace(
//                     /^(\d{1,2})(\d{3})(\d{3})(\d{1})$/,
//                     "$1.$2.$3-$4"
//                 );
//             } else {
//                 rut = rut.replace(
//                     /^(\d{1,2})(\d{3})(\d{3})(\d{0,1})$/,
//                     "$1.$2.$3-$4"
//                 );
//             }

//             userRut.value = rut;

//             // Now, perform the validation
//             const rutDigits = rut.replace(/[^\d]/g, "").slice(0, -1);
//             const verificationDigit = rut.slice(-1);

//             let sum = 0;
//             let multiplier = 2;

//             for (let i = rutDigits.length - 1; i >= 0; i--) {
//                 sum += parseInt(rutDigits.charAt(i), 10) * multiplier;
//                 multiplier = multiplier === 7 ? 2 : multiplier + 1;
//             }

//             const expectedVerificationDigit = 11 - (sum % 11);

// }
//END BANK

const updateCharacterCount = () => { 
            const text = productInfo.value.description;
            const newCharacterCount = text.length;
            characterCount.value = newCharacterCount;
};
const updateCharacterCountObs = () => {
            const text = formData.stepFiveDetails;
            const newCharacterCount = text.length;
            characterCountObs.value = newCharacterCount;
};
const updateCharacterCountReco = () => {
            const text = formData.stepFiveAdvice;
            const newCharacterCount = text.length;
            characterCountReco.value = newCharacterCount;
};

watch(() => productInfo.value.description, (newValue) => {
    characterCount.value = newValue.length;
});
watch(() => productInfo.value.remark, (newValue) => {
    characterCountObs.value = newValue.length;
});
watch(() => productInfo.value.advice, (newValue) => {
    characterCountReco.value = newValue.length;
});

const updateTextareaHeight = () => {
            const catHeight =
                document.querySelector(".cat-select").offsetHeight + 24;
            const genreHeight =
                document.querySelector(".cont-genre").offsetHeight;
            const leftHeight = catHeight + genreHeight;

            // Update the textareaHeight data property to match the left column height
            textareaHeight.value = leftHeight;
};



const showAndCloseDropdown = () => {
    if (dropdown.value == false) {
        dropdown.value = true;
        activeTrigger.value = true;
        TweenMax.fromTo(
            "#dropdown-cats",
            0.55,
            {
                autoAlpha: 0,
                y: -10,
            },
            {
                autoAlpha: 1,
                y: 0,
                ease: Power2.easeOut,
            }
        );
    } else {
        dropdown.value = false;
        activeTrigger.value = false;
        TweenMax.to("#dropdown-cats", 0.2, {
            autoAlpha: 0,
            y: -10,
            ease: Power2.easeOut,
        });
    }
};

const closeDropdown = () => {
    dropdown.value = false;
    activeTrigger.value = false;
    TweenMax.to("#dropdown-cats", 0.2, {
        autoAlpha: 0,
        y: -10,
        ease: Power2.easeOut,
    });
};

const fetchData = async (product_id) => {
    try {
        const response = await axios.get(`/api/products/edit/${product_id}`);
        productInfo.value = response.data;
        userFullName.value = productInfo.value.user.bank_detail.full_name;
        userBank.value = productInfo.value.user.bank_detail.bank;
        userBankAccount.value = productInfo.value.user.bank_detail.account_number;
        userBankAccountType.value = productInfo.value.user.bank_detail.account_type;
        userRut.value = productInfo.value.user.bank_detail.rut;  
        deliveryInformation.value = response.data.delivery_information;  
    } catch (error) {
        console.error("Error fetching data:", error);
    }
};

const fetchGenders = async () => {
    try{
        const response = await axios.get("/api/product/getgenders");
        // genders.value = response.data;
        genders.value = response.data.map(gender => ({
            id: gender.id,
            name: gender.name,
            value: gender.id,
        }));
    } catch (error){
        console.error("Error fetching agefilters:", error);
    }
}

const UpdateProductStatus = async() => {
    try {
        const response = await axios.put(
            `/api/product/updatestatus/${props.productSlug}`, 
            {
                name: productInfo.value.name,
                gender_id: productInfo.value.gender_id,
                age_filter_id: productInfo.value.age_filter_id,
                description: productInfo.value.description,
                category_id: productInfo.value.category.id,
                brand: productInfo.value.brand,
                model: productInfo.value.model,
                height: productInfo.value.height,
                height_unit: productInfo.value.height_unit,
                width: productInfo.value.width,
                width_unit: productInfo.value.width_unit,
                length: productInfo.value.length,
                length_unit: productInfo.value.length_unit,
                weight: productInfo.value.weight,
                weight_unit: productInfo.value.weight_unit,
                status: productInfo.value.status,
                used_time: productInfo.value.used_time,
                used_time_unit: productInfo.value.used_time_unit,
                remark: productInfo.value.remark,
                advice: productInfo.value.advice,
                images: productInfo.value.galleries,
                //Delivery Information
                option: productInfo.value.delivery_information.option,
                region_code: productInfo.value.delivery_information.region_code,
                region_name: productInfo.value.delivery_information.region_name,
                dity_name: productInfo.value.delivery_information.city_name,
                city_code: productInfo.value.delivery_information.city_code,
                chile_office: productInfo.value.delivery_information.chile_office,
                address: productInfo.value.delivery_information.address,
                address_number: productInfo.value.delivery_information.address_number,
                dpto_house: productInfo.value.delivery_information.dpto_house,
                price: productInfo.value.price,
                //Bank Details
                full_name: userFullName.value,
                bank: userBank.value ,
                account_number: userBankAccount.value,
                account_type: userBankAccountType.value,
                rut: userRut.value,       
                publish_status: 'En vitrina',
                visible_status: 'Si',
            }
        );
        toast.add({severity:'success', detail: 'El producto fue puesto en vitrina exitosamente',life: 4000});  
        console.log("Product updated successfully:", response.data); 
        // Navigate back to the previous page after 6 seconds
        setTimeout(() => {
            window.history.back();
        }, 4000); // 6 seconds delay  
    } catch (error) {
        console.error("Error updating product:", error);
    }
}

const SaveProductStatus = async() => {
    try{
        // const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

        const response = await axios.put(
            `/api/savestatus/${props.productSlug}`, 
            {
                name: productInfo.value.name,
                gender_id: productInfo.value.gender_id,
                age_filter_id: productInfo.value.age_filter_id,
                description: productInfo.value.description,
                category_id: productInfo.value.category.id,
                brand: productInfo.value.brand,
                model: productInfo.value.model,
                height: productInfo.value.height,
                height_unit: productInfo.value.height_unit,
                width: productInfo.value.width,
                width_unit: productInfo.value.width_unit,
                length: productInfo.value.length,
                length_unit: productInfo.value.length_unit,
                weight: productInfo.value.weight,
                weight_unit: productInfo.value.weight_unit,
                status: productInfo.value.status,
                used_time: productInfo.value.used_time,
                used_time_unit: productInfo.value.used_time_unit,
                remark: productInfo.value.remark,
                advice: productInfo.value.advice,
                images: productInfo.value.galleries,
                //Delivery Information
                option: productInfo.value.delivery_information.option,
                region_code: productInfo.value.delivery_information.region_code,
                region_name: productInfo.value.delivery_information.region_name,
                dity_name: productInfo.value.delivery_information.city_name,
                city_code: productInfo.value.delivery_information.city_code,
                chile_office: productInfo.value.delivery_information.chile_office,
                address: productInfo.value.delivery_information.address,
                address_number: productInfo.value.delivery_information.address_number,
                dpto_house: productInfo.value.delivery_information.dpto_house,
                price: productInfo.value.price,
                //Bank Details
                full_name: userFullName.value,
                bank: userBank.value ,
                account_number: userBankAccount.value,
                account_type: userBankAccountType.value,
                rut: userRut.value,   
                publish_status: 'En revisión',               
            },
            // {
            //     headers: {
            //         "X-CSRF-TOKEN": csrfToken,
            //     },
            // }
        ); 
        toast.add({severity:'success', detail: 'El producto fue guardado exitosamente',life: 4000});
        console.log("Product updated successfully:", response.data);
    }catch (error){
        console.error("Error saving product!!",error);
    }
}

const fetchCategories = async() => {
    try{
        const response = await axios.get("/api/categories");
        categories.value = response.data.categories;
    } catch (error){
        console.error("Error fetching data:", error);
    }
};

const generateDataBsTarget = (categoryId) => {
    return `#panel-${categoryId}`;
};

const generateID = (id) => {
    return `panel-${id}`;
}

const handleNumericInput = (fieldName) => {
    // Get the current value from the corresponding data property
    let value = productInfo.value[fieldName];
    // Apply the numeric filtering logic
    value = value.replace(/[^0-9]/g, '');
    // Update the corresponding data property
    productInfo.value[fieldName] = value;
}

const formatDate = (dateString) => {
    const dateObject = new Date(dateString);
    const day = dateObject.getDate().toString().padStart(2, '0');
    const month = (dateObject.getMonth() + 1).toString().padStart(2, '0');
    const year = dateObject.getFullYear();
    return `${day}/${month}/${year}`;
};

const formattedCreateDate = computed(() => {
  return formatDate(productInfo.value.created_at);
});

const formattedUpdatedDate = computed(() => {
  return formatDate(productInfo.value.updated_at);
});

onUpdated(() => {
    updateTextareaHeight();
});

onMounted(async() => {
    await fetchData(props.productSlug);
    await fetchGenders();
    await fetchCategories();
    await getRegionsChilexpress();
    watch(
        () => selectedRef.value.city,
        (newCity) => {
            if (newCity !== lastSelected.value.city) {
                getCoberturaOptions();
                lastSelected.value.city = newCity;
            }
            productInfo.value.delivery_information.city = lastSelected.value.city;
        }
    );
    watch(
        () => selectedRef.value.region,
        (newRegion) => {
            if (newRegion !== lastSelected.value.region) {
                getComunasChilexpress();
                lastSelected.value.region = newRegion;
            }
            productInfo.value.delivery_information.region = lastSelected.value.region;
        }
    );

    watch(
        () => productInfo.value.delivery_information?.option,
        (newOptionDelivery) => {
            if (newOptionDelivery === "Domicilio") {
                productInfo.value.delivery_information.chile_office = "";
            }
        }
    );

    if (selectedRef.value.region !== null) {
        selectedRef.value.region = productInfo.value.delivery_information?.region_code;
    }

    if (selectedRef.value.city !== null) {
        selectedRef.value.city = productInfo.value.delivery_information?.city_name;
    }
});

</script>

<style scoped>
/*Photos*/
.cont-upload-image {
    background-color: #fff;
    border-radius: 6px;
    padding: 2rem 3rem;
    box-shadow: 0px 2px 4px 0px rgba(10, 13, 8, 0.1);
}
.cont-upload-image .dropzone {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-items: center;
    padding: 3rem 0;
    border: 1px dashed #c0c6b9;
}
#icon-upload {
    width: 25px;
    height: auto;
    margin-bottom: 1rem;
}
#icon-upload .st0 {
    fill: none;
    stroke: #728c54;
    stroke-width: 3;
    stroke-linecap: round;
    stroke-linejoin: round;
}
.dropzone {
    margin-bottom: 1rem;
}
.dropzone h3 {
    font-size: 18px;
    font-weight: 700;
    line-height: 16px;
    color: #1b1f22;
}
.dropzone h4 {
    font-family: "Inter", sans-serif;
    font-size: 14px;
    font-weight: 500;
    line-height: 16px;
}
.dropzone p {
    font-family: "Inter", sans-serif;
    font-size: 12px;
    font-weight: 300;
    line-height: 16px;
}
.dropzone button {
    color: #728c54;
    border: 2px solid #727c54;
    width: 100%;
    max-width: 163px;
    height: 43px;
    font-weight: 700;
    font-size: 15px;
    margin-bottom: 0.5rem;
}
.cont-images-result span {
    font-family: "Inter", sans-serif;
    font-size: 12px;
    font-weight: 400;
    color: #c0c6b9;
}
.cont-images-result .row-results {
    display: flex;
    flex-direction: row;
    margin-bottom: 1rem;
    justify-content: space-between;
}
.cont-images-result .row-results img {
    width: 100%;
    max-width: 80px;
    height: 80px;
    margin-right: 1rem;
    object-fit: cover;
}
.cont-images-result .row-results p {
    margin-bottom: 0;
}
.cont-images-result .row-results .first,
.cont-images-result .row-results .second {
    display: flex;
    flex-direction: row;
    align-items: center;
}
.cont-images-result .row-results .first p {
    font-family: "Inter", sans-serif;
    font-size: 12px;
    font-weight: 400;
    color: #1b1f22;
}
.cont-images-result .row-results .second p {
    font-size: 12px;
    font-weight: 600;
    color: #1b1f22;
    margin-right: 4rem;
}
.cont-images-result .row-results .second .fa-trash-can {
    height: 1.4em;
}
.cont-images-result .row-results .second .fa-trash-can path {
    fill: #728c54;
}
/*Despacho*/
.cont-option-delivery label {
    display: flex;
    flex-direction: column;
    align-items: baseline;
    width: 100%;
    height: auto;
    background-color: #fff;
    border-radius: 2px;
    border: 1px dashed #c0c6b9;
    padding: 1.8rem 1rem;
    margin-bottom: 1rem;
}
.cont-option-delivery label span:first-child {
    font-size: 9px;
    font-weight: 700;
    color: #454545;
    line-height: 14px;
    margin-bottom: 2px;
}

.cont-option-delivery label span:last-child {
    font-family: "Quicksand", sans-serif;
    font-size: 18px;
    font-weight: 700;
    color: #728c54;
    line-height: 16px;
}

.cont-option-delivery .btn-check:checked + .btn {
    background-color: #728c54;
}
.cont-option-delivery .btn-check:checked + .btn span {
    color: #fff;
}

</style>