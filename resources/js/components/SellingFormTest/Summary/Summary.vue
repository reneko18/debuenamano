<template>
    <div class="modulo-resumen">
        <div class="col-lg-7 col-md-12">
            <h2>Resumen de la publicación de tu artículo en venta</h2>
            <p class="bajada-h2">
                Verifica que los datos y la información que nos has
                proporcionado sea la correcta antes de enviarnos la publicación.
            </p>
        </div>
        <div><h2>Presentación</h2></div>
        <div class="row">
            <div class="col-6">
                <div>
                    <label for="productName" class="form-label">Nombre*</label>
                    <input
                        type="text"
                        class="form-control"
                        id="productName"
                        placeholder="Nombre del artículo"
                        v-model="formData.stepOneNameProduct"
                    />
                    <!--<p v-if="msg.name">{{ msg.name }}</p>-->
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
                            :value="formData.stepOneCategoryProduct.name"
                            @click="showAndCloseDropdown"
                            readonly
                        />
                        <i
                            class="fa-solid fa-chevron-down"
                            @click="showAndCloseDropdown"
                        ></i>
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
                                        :value="category.name"
                                        type="radio"
                                        name="categoria"
                                        v-model="
                                            formData.stepOneCategoryProduct
                                        "
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
                                        :data-bs-target="
                                            generateDataBsTarget(category.id)
                                        "
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
                                                    :value="subcategory.name"
                                                    type="radio"
                                                    name="categoria"
                                                    v-model="
                                                        formData.stepOneCategoryProduct
                                                    "
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
                    <select
                        id="productGenre"
                        class="form-select"
                        v-model="formData.stepOneGenre"
                    >
                        <option selected>Seleccione un género</option>
                        <option value="Niño">Niño</option>
                        <option value="Niña">Niña</option>
                        <option value="Unisex">Unisex</option>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <span class="tit-age-range">Rango de edad de tu articulo*</span>
                <div class="row row-age-range">  
                    <div class="col-md-2" v-if="formData.stepOneShowFirstInput">
                        <input                            
                            type="text"
                            class="form-control"                           
                            placeholder="00"
                            id="age-pro"
                            v-model="formData.stepOneAgeIni"
                            @input="handleNumericInput('stepOneAgeIni')"
                        />
                    </div>
                    <div class="col-md-4">   
                        <select
                            id="neonat-pro"
                            class="form-select"                            
                            v-model="formData.stepOneAgeDateIni"
                        >
                            <option value="Recién nacido">Recién nacido</option>
                            <option value="Semanas">Semanas</option>
                            <option value="Meses">Meses</option>
                            <option value="Años">Años</option>
                        </select>
                    </div>
                    <div
                        class="col-md-1 col-a flex-column justify-content-center"   
                    >
                        <span>a</span>
                    </div>
                    <div class="col-md-2">  
                        <input
                            type="text"
                            class="form-control"                           
                            placeholder="00"
                            id="month-pro"
                            v-model="formData.stepOneAgeFin"
                            @input="handleNumericInput('stepOneAgeFin')"
                        />
                    </div>
                    <div class="col-md-3">              
                        <select
                            id="monthsel-pro"
                            class="form-select"                           
                            v-model="formData.stepOneAgeDateFin"
                        >
                            <option value="Semanas">Semanas</option>
                            <option value="Meses">Meses</option>
                            <option value="Años">Años</option>
                        </select>
                    </div>
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
                            v-model="formData.stepOneDescriptionProduct"
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
            <div class="col-7">
                <div>
                    <label for="brandName" class="form-label">Marca*</label>
                    <input
                        type="text"
                        class="form-control"
                        id="brandName"
                        placeholder="Ingresa el nombre de la marca"
                        v-model="formData.stepTwoBrandProduct"
                    />
                </div>
            </div>
            <div class="col-5">
                <div>
                    <label for="modelName" class="form-label">Modelo</label>
                    <input
                        type="text"
                        class="form-control"
                        id="modelName"
                        placeholder="Ingresa el modelo del artículo"
                        v-model="formData.stepTwoModelProduct"
                    />
                </div>
            </div>
        </div>
        <div class="cont-dimen-1 resumen">
            <h2>Medidas Embalado</h2>
            <div class="row-main-dim">
                <div class="row-child-dim">
                    <div class="col-dim">
                        <label for="height-pro" class="form-label">Alto*</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="0,0"
                            id="height-pro"
                            v-model="formData.stepThreeHeight"
                            @input="handleNumericInput('stepThreeHeight')"
                        />
                    </div>
                    <div class="col-dim">
                        <label for="unh-pro" class="form-label"></label>
                        <select
                            id="unh-pro"
                            class="form-select"
                            v-model="formData.stepThreeHeightUnit"
                        >
                            <option selected>Seleccione</option>
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
                            v-model="formData.stepThreeWidth"
                            @input="handleNumericInput('stepThreeWidth')"
                        />
                    </div>
                    <div class="col-dim">
                        <label for="unw-pro" class="form-label"></label>
                        <select
                            id="unw-pro"
                            class="form-select"
                            v-model="formData.stepThreeWidthUnit"
                        >
                            <option selected>Seleccione</option>
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
                            v-model="formData.stepThreeLength"
                            @input="handleNumericInput('stepThreeLength')"
                        />
                    </div>
                    <div class="col-dim">
                        <label for="unl-pro" class="form-label"></label>
                        <select
                            id="unl-pro"
                            class="form-select"
                            v-model="formData.stepThreeLengthUnit"
                        >
                            <option selected>Seleccione</option>
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
                            v-model="formData.stepThreeWeight"
                            @input="handleNumericInput('stepThreeWeight')"
                        />
                    </div>
                    <div class="col-dim position-relative">
                        <label for="unwe-pro" class="form-label"></label>
                        <select
                            id="unwe-pro"
                            class="form-select"
                            v-model="formData.stepThreeWeightUnit"
                        >
                            <option selected>Seleccione</option>
                            <option value="g">g</option>
                            <option value="Kg">Kg</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="cont-dimen-2 resumen">
            <h2>Medidas Reales</h2>
            <div class="row-main-dim">                
                <div class="row-child-dim">
                    <div class="col-dim">
                        <label for="height-pro" class="form-label">Alto*</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="0,0"
                            id="height-pro"
                            v-model="formData.stepThreeHeightReal"  
                            @input="handleNumericInput('stepThreeHeightReal')"                          
                        />
                    </div>
                    <div class="col-dim">
                        <label for="unh-pro" class="form-label"></label>
                        <select
                            id="unh-pro"
                            class="form-select"                      
                            v-model="formData.stepThreeHeightRealUnit"
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
                            v-model="formData.stepThreeWidthReal"
                            @input="handleNumericInput('stepThreeWidthReal')"
                        />
                    </div>
                    <div class="col-dim">
                        <label for="unw-pro" class="form-label"></label>
                        <select
                            id="unw-pro"
                            class="form-select"                  
                            v-model="formData.stepThreeWidthRealUnit"
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
                            v-model="formData.stepThreeLengthReal"
                            @input="handleNumericInput('stepThreeLengthReal')"
                        />
                    </div>
                    <div class="col-dim">
                        <label for="unl-pro" class="form-label"></label>
                        <select
                            id="unl-pro"
                            class="form-select"                   
                            v-model="formData.stepThreeLengthRealUnit"
                        >
                            <option value="cm">cm</option>
                            <option value="in">in</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div><h2>Estado</h2></div>
        <div class="row">
            <div class="col-6">
                <div>
                    <label for="statusItem" class="form-label">Estado</label>
                    <select
                        id="statusItem"
                        class="form-select"
                        v-model="formData.stepFourState"
                    >
                        <option selected>Seleccione un estado</option>
                        <option value="Usado en buen estado">
                            Usado en buen estado
                        </option>
                        <option value="Sin uso">Sin uso</option>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col-md-3">
                        <label for="usageItem" class="form-label"
                            >Tiempo de uso</label
                        >
                        <input
                            type="text"
                            class="form-control"
                            placeholder="00"
                            id="usageItem"
                            v-model="formData.stepFourUsageTime"
                            @input="handleNumericInput('stepFourUsageTime')"
                        />
                    </div>
                    <div class="col-md-4">
                        <label for="usageItem-pro" class="form-label"></label>
                        <select
                            id="usageItem-pro"
                            class="form-select"
                            v-model="formData.stepFourUsageUnit"
                        >
                            <option selected>Seleccione un estado</option>
                            <option value="Dias">Dias</option>
                            <option value="Meses">Meses</option>
                            <option value="Años">Años</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="position-relative">
                    <label for="obser-pro" class="form-label"
                        >Observación</label
                    >
                    <textarea
                        id="obser-pro"
                        class="form-control"
                        placeholder="Que observaciones presenta el artículo..."
                        v-model="formData.stepFiveDetails"
                        @input="updateCharacterCountObs"
                        rows="4"
                        maxlength="280"
                    ></textarea>
                    <span class="character-count-badge"
                        >{{ characterCountObs }}/280 caracteres</span
                    >
                </div>
            </div>
            <div class="col-6">
                <div class="position-relative">
                    <label for="reco-pro" class="form-label"
                        >Recomendaciones</label
                    >
                    <textarea
                        id="reco-pro"
                        class="form-control"
                        placeholder="Que recomendación darías para el correcto uso del artículo..."
                        v-model="formData.stepFiveAdvice"
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
        <div>
            <div class="col">
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
                        <button class="btn" @click="openFileInput">
                            buscar archivos
                        </button>
                        <input
                            ref="fileInput"
                            type="file"
                            style="display: none"
                            v-bind="getInputProps()"
                        />
                        <p>Peso máximo 2MB</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="cont-images-result-end">
                    <span v-show="formData.stepSixPhoto != ''">Adjunto ahora</span>
                    <div
                        class="row-results"
                        v-for="(image, index) in formData.stepSixPhoto"
                        :key="index"
                    >
                        <div class="first">
                            <img :src="image.src" alt="Uploaded Thumbnail" />
                            <p>{{ image.name }}</p>
                        </div>
                        <div class="second">
                            <p>{{ image.size }}</p>
                            <button class="btn" @click="deleteImage(index)">
                                <font-awesome-icon :icon="['far', 'trash-can']" />
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="cont-images-result-end">
                    <span v-show="formData.stepSixPhotoDB != ''">Adjunto anteriormente</span>
                    <div
                        class="row-results"
                        v-for="(image, index) in formData.stepSixPhotoDB"
                        :key="index"
                    >
                        <div class="first">
                            <img :src="'/' + image.url" :alt="image.alt" />
                            <p>{{ image.alt }}</p>
                        </div>
                        <div class="second">
                            <p>{{ image.size }}</p>
                            <button class="btn" @click="showDeleteConfirmation(index)">
                                <font-awesome-icon :icon="['far', 'trash-can']" />
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <h2>Origen del Despacho</h2>
        </div>
        <div class="modulo-pasos">
            <div class="row">
                <div class="col-4">
                    <div 
                        class="cont-option-delivery" 
                        v-if="formData.stepSevenSelectedSection === 'Chilexpress'"
                    >
                        <input
                            type="radio"
                            class="btn-check"
                            name="delivery-option"
                            id="chilexpress"
                            value="Chilexpress"
                            v-model="formData.stepSevenOptionDelivery"
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
                        v-else-if="formData.stepSevenSelectedSection === 'Domicilio'"
                    >
                        <input
                            type="radio"
                            class="btn-check"
                            name="delivery-option"
                            id="house"
                            value="Domicilio"
                            v-model="formData.stepSevenOptionDelivery"
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
                            formData.stepSevenSelectedSection === 'Chilexpress'
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
                                :value="com"
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
                            v-model="formData.stepSevenChilexpressOffice"
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
                            formData.stepSevenSelectedSection === 'Domicilio'
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
                                v-model="formData.stepSevenStreet"
                            />
                        </div>
                        <div>
                            <label for="number" class="form-label">Nª</label>
                            <input
                                type="text"
                                id="number"
                                class="form-control"
                                placeholder="Ingresa el número"
                                v-model="formData.stepSevenStreetNumber"
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
                                v-model="formData.stepSevenStreetDptoHouse"
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
                                    :value="com"
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
                <input
                    type="text"
                    class="form-control"
                    id="priceItem"
                    placeholder="Precio"
                    v-model="formData.stepEightPrice"
                    @input="feeDBM"
                />
                <div class="row row-income">
                <div class="col">
                        <p>- $ {{ isNaN(formData.stepEightPriceFee) ? 'Ingrese un precio valido' : formData.stepEightPriceFee }}</p>
                        <p><strong class="price-income">$ {{ isNaN(formData.stepEightPriceFinalAmount) ? 'Ingrese un precio valido' : formData.stepEightPriceFinalAmount }}</strong></p>
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
                        v-model="formData.stepNineName"
                    />
                </div>
                <div>
                    <label for="infoPayBank" class="form-label">Banco</label>
                    <select
                        id="infoPayBank"
                        class="form-select"
                        v-model="formData.stepNineBank"
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
                        v-model="formData.stepNineBankNumber"
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
                        v-model="formData.stepNineRut"
                        @input="formatAndValidateRUT"
                    />
                    <!-- <div v-if="isValidRUT" class="text-success">Valid RUT</div>
                    <div v-else class="text-danger">Invalid RUT</div> -->
                </div>
                <div>
                    <label for="infoPayTypeAccount" class="form-label"
                        >Tipo de cuenta</label
                    >
                    <select
                        id="infoPayTypeAccount"
                        class="form-select"
                        v-model="formData.stepNineBankType"
                    >
                        <option selected>Elige el tipo de cuenta</option>
                        <option value="Cuenta Vista">Cuenta Vista</option>
                        <option value="Cuenta Corriente">
                            Cuenta Corriente
                        </option>
                    </select>
                </div>
            </div>
        </div>

        <a class="btn boton-principal" @click="submitForm">
            Confirmar <font-awesome-icon :icon="['fas', 'chevron-right']"
        /></a>
    </div>   
    <Dialog v-model="displayConfirmDialog" modal :visible="displayConfirmDialog" @hide="cancelDelete">
      <span>Estas seguro que deseas eliminar esta imagen?</span>
      <Button label="Anular" class="p-button-text" @click="cancelDelete" />
      <Button label="Eliminar" class="p-button-text" @click="deleteImageServer" />
    </Dialog>
</template>
<script setup>
    import Dialog from 'primevue/dialog';
    import Button from "primevue/button";
    import { useFormStore } from "../../../stores/valuesTwo";
    import { useDropzone } from "vue3-dropzone";
    import { ref, watch , onMounted } from "vue";

    const props = defineProps({
        userId: { 
            type: String, 
            default: "" 
        },
        productId: { 
            type: String, 
            default: "" 
        },
        productSlug: { 
            type: String, 
            default: "" 
        },
        userBank: { 
            type: [Object, String], 
            default: null, 
        },
    });

    const formStore = useFormStore();
    const formData = formStore.formData;
    const characterCount = ref(0);
    const dropdown = ref(false);
    const activeTrigger = ref(false);
    const textareaHeight = ref(100);
    const categories = ref([]);
    const characterCountObs = ref(0);
    const characterCountReco = ref(0);
    const productInfo = ref('');

    //Despacho
    const selected = ref({
        region: "",
        city: "",
    });

    const lastSelected = ref({
        region: "",
        city: "",
    });

    const cities = ref([]);
    const offices = ref([]);
    // Define and initialize regions as an empty array
    const regions = ref([]);
    const loading = ref(false); // Define loading as a ref and initialize it

    const bankDetails = ref([]);
    const useBankDetails = ref(props.userBank);
    //Fin despacho


    const fetchData = async () => {
        try {
            const response = await axios.get("/api/categories");
            categories.value = response.data.categories;
        } catch (error) {
            console.error("Error fetching categories:", error);
            }
    };

    const updateCharacterCount = () => {
        const text = formData.stepOneDescriptionProduct;
        const newCharacterCount = text.length;
        characterCount.value = newCharacterCount;
    };

    const fetchProductInfo = async () => {
        try {
            if(props.productId){
                const response = await axios.get(`/api/product/getinfo/${props.productSlug}`);
                console.log(response);
                productInfo.value = response.data.product;
                console.log(productInfo.value.delivery_information);
                if(props.productId){
                    formData.stepOneNameProduct = productInfo.value.name;
              
                    // Update formData with category information
                    if (productInfo.value.category) {
                        formData.stepOneCategoryProduct = productInfo.value.category; 
                    }

                    formData.stepOneGenre = productInfo.value.genre;
                    formData.stepOneAgeIni = productInfo.value.age_ini;
                    formData.stepOneAgeDateIni = productInfo.value.age_date_ini;
                    formData.stepOneAgeFin = productInfo.value.age_fin;
                    formData.stepOneAgeDateFin = productInfo.value.age_date_fin;
                    formData.stepOneDescriptionProduct = productInfo.value.description;
                    formData.stepTwoBrandProduct = productInfo.value.brand;
                    formData.stepTwoModelProduct = productInfo.value.model;                    
                    formData.stepFourState = productInfo.value.status;
                    formData.stepFourUsageTime = productInfo.value.used_time;
                    formData.stepFourUsageUnit = productInfo.value.used_time_unit;
                    formData.stepFiveDetails = productInfo.value.remark;
                    formData.stepFiveAdvice = productInfo.value.advice;
                    formData.stepEightPrice = productInfo.value.price;
                    formData.stepThreeLengthReal = productInfo.value.length_real;                       
                    formData.stepThreeLengthRealUnit = productInfo.value.length_real_unit;   
                    formData.stepThreeWidthReal = productInfo.value.width_real;                      
                    formData.stepThreeWidthRealUnit = productInfo.value.width_real_unit;    
                    formData.stepThreeHeightReal = productInfo.value.height_real;                    
                    formData.stepThreeHeightRealUnit = productInfo.value.height_real_unit; 
                                // Update formData with delivery information
                    if (productInfo.value.delivery_information) {          

                        formData.stepThreeLength = productInfo.value.delivery_information.length;                       
                        formData.stepThreeLengthUnit = productInfo.value.delivery_information.length_unit;   
                        formData.stepThreeWidth = productInfo.value.delivery_information.width;                      
                        formData.stepThreeWidthUnit = productInfo.value.delivery_information.width_unit;    
                        formData.stepThreeHeight = productInfo.value.delivery_information.height;                    
                        formData.stepThreeHeightUnit = productInfo.value.delivery_information.height_unit; 
                        formData.stepThreeWeight = productInfo.value.delivery_information.weight;                    
                        formData.stepThreeWeightUnit = productInfo.value.delivery_information.weight_unit;                       
                        formData.stepSevenOptionDelivery = productInfo.value.delivery_information.option;
                        // formData.stepSevenRegion = productInfo.value.delivery_information.region_code;
                        // formData.stepSevenCity = {
                        //     countyName: productInfo.value.delivery_information.city_name,
                        //     countyCode: productInfo.value.delivery_information.city_code
                        // };
                        selected.value.region = productInfo.value.delivery_information.region_code;
                        selected.value.city = {
                            countyName: productInfo.value.delivery_information.city_name,
                            countyCode: productInfo.value.delivery_information.city_code,
                            regionCode: productInfo.value.delivery_information.region_code,
                        }
                        formData.stepSevenChilexpressOffice = productInfo.value.delivery_information.chile_office;
                        formData.stepSevenStreet = productInfo.value.delivery_information.address;
                        formData.stepSevenStreetNumber = productInfo.value.delivery_information.address_number;
                        formData.stepSevenStreetDptoHouse = productInfo.value.delivery_information.dpto_house;
                    }
                    if (productInfo.value.galleries){
                        formData.stepSixPhotoDB = productInfo.value.galleries;
                    }
                    //Bank Details
                }
            }
        } catch (error) {
            console.error("Error fetching categories:", error);
        }
    };

    const submitForm = async () => {
        try {
            firstPhase();
            secondPhase();
            fourthPhase();
            changeDraftStatus();
            window.location.href = "/exito-producto-venta"; 
        } catch (error) {
            console.error("Error saving data:", error);
        }
    };

    const firstPhase = async () => {
        try {
            const csrfToken = document.head.querySelector(
                'meta[name="csrf-token"]'
            ).content;
            const slug = props.productSlug ? props.productSlug : formData.stepZeroSlug;
            const response = await axios.post(
                `/api/product/store/oneupdate/${slug}`,
                formData,
                {
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                }
            );

            console.log(response);             
        } catch (error) {
            console.error(error.response.data);
        }
    };
    const secondPhase = async () => {
        try {
            const csrfToken = document.head.querySelector(
                'meta[name="csrf-token"]'
            ).content;
            const slug = props.productSlug ? props.productSlug : formData.stepZeroSlug;
            const response = await axios.post(
                `/api/product/store/two/${slug}`,
                formData,
                {
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                }
            );

            console.log(response);             
        } catch (error) {
            console.error(error.response.data);
        }
    };

    const fourthPhase = async () => {
        try {
            const csrfToken = document.head.querySelector(
                'meta[name="csrf-token"]'
            ).content;
            const slug = props.productSlug ? props.productSlug : formData.stepZeroSlug;
            const response = await axios.post(
                `/api/product/store/four/${slug}`,
                formData,
                {
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                }
            );

            console.log(response);             
        } catch (error) {
            console.error(error.response.data);
        }
    };

    const changeDraftStatus = async () => {
        try {
            const csrfToken = document.head.querySelector(
                'meta[name="csrf-token"]'
            ).content;
            const slug = props.productSlug ? props.productSlug : formData.stepZeroSlug;
            const status = "En revisión";
            const response = await axios.post(
                `/api/product/store/draft-status/${slug}`,
                { status },
                {
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                }
            );

            console.log(response);             
        } catch (error) {
            console.error(error.response.data);
        }
    };


    const generateDataBsTarget = (categoryId) => {
        return `#panel-${categoryId}`;
    };

    const generateID = (id) => {
        return `panel-${id}`;
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

    const updateTextareaHeight = () => {
        const catHeight = document.querySelector(".cat-select").offsetHeight + 24;
        const genreHeight = document.querySelector(".cont-genre").offsetHeight;
        const leftHeight = catHeight + genreHeight;
        textareaHeight.value = leftHeight;
    };

    const handleNumericInput = (fieldName) => {
        let value = formData[fieldName];
        value = value.replace(/[^0-9]/g, '');
        formData[fieldName] = value;
    };

    //Estado Observaciones
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

    //Photos
    const isDragActive = ref(false);
    const fileInput = ref(null);

    const openFileInput = () => {
        if (fileInput.value) {
            fileInput.value.click();
        }
    };

    function onDrop(acceptedFiles, rejectedFiles) {
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

                        formData.stepSixPhoto.push(image);
                        resolve();
                    };

                    reader.readAsDataURL(file);
                });
            })
        ).then(() => {
            console.log("All files processed:", formData.stepSixPhoto);
        });

        console.log(acceptedFiles);
        console.log(rejectedFiles);
    }

    const { getRootProps, getInputProps, ...rest } = useDropzone({
        onDrop,
        onDragEnter: () => (isDragActive.value = true),
        onDragLeave: () => (isDragActive.value = false),
        onDropAccepted: () => (isDragActive.value = false),
    });

    function deleteImage(index) {
        formData.stepSixPhoto.splice(index, 1);
    }

    const displayConfirmDialog = ref(false);
        let imageToDeleteIndex;

    const showDeleteConfirmation = (index) => {
        imageToDeleteIndex = index;
        displayConfirmDialog.value = true;
    };
    const cancelDelete = () => {
        displayConfirmDialog.value = false;
    };
    const deleteImageServer = () => {
        const imageId = formData.stepSixPhotoDB[imageToDeleteIndex].id;
        axios.delete(`/api/images/${imageId}`)
            .then(() => {
            // Update UI after successful deletion
            formData.stepSixPhotoDB.splice(imageToDeleteIndex, 1);
            displayConfirmDialog.value = false;
            })
            .catch(error => {
            console.error('Error deleting image:', error);
            // Handle error
            });
    };

    //Despacho
    const toggleSection = (section) => {
        formData.stepSevenSelectedSection = section;
    };
    const getRegionsChilexpress = async function () {
        const apiKey = "570f3f00500c433a9b2b94e7b4803c1b";
        const apiUrl = "https://testservices.wschilexpress.com/georeference/api/v1.0/regions";

        try {
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
    const getComunasChilexpress = async function () {
        const apiKey = "570f3f00500c433a9b2b94e7b4803c1b";
        const apiUrl = "https://testservices.wschilexpress.com/georeference/api/v1.0/coverage-areas";

        try {
            loading.value = true;
            const response = await axios.get(apiUrl, {
                params: {
                    api_key: apiKey,
                    RegionCode: selected.value.region,
                    type: 1,
                },
            });
            cities.value = response.data.coverageAreas;
        } catch (error) {
            console.error("Error fetching cities:", error);
        } finally {
            loading.value = false;
        }
    };
    const getCoberturaOptions = async function () {
        const apiUrl = "https://testservices.wschilexpress.com/georeference/api/v1.0/offices?Type=0";   
        const regionCode = selected.value.region;            
        const cityName = selected.value.city;

        try {
            const response = await axios.get(apiUrl, {
                headers: {
                    "Cache-Control": "no-cache",
                    "Ocp-Apim-Subscription-Key": "570f3f00500c433a9b2b94e7b4803c1b",
                },
                params: {
                    RegionCode: regionCode,
                    CountyName: cityName.countyName,
                },
            });
            offices.value = response.data.offices;
        } catch (error) {
            console.error("Error:", error);
        }
    };

    const formatAndValidateRUT = () => {
    let rut = formData.stepNineRut.replace(/[^\dKk]/g, "").toUpperCase();
    const length = rut.length;

    if (length > 1) {
        rut = rut.replace(/^(\d{1,2})(\d{3})(\d{3})(\d{1})$/, "$1.$2.$3-$4");
    } else {
        rut = rut.replace(/^(\d{1,2})(\d{3})(\d{3})(\d{0,1})$/, "$1.$2.$3-$4");
    }

    formData.stepNineRut = rut;

    const rutDigits = rut.replace(/[^\d]/g, "").slice(0, -1);
    const verificationDigit = rut.slice(-1);

    let sum = 0;
    let multiplier = 2;

    for (let i = rutDigits.length - 1; i >= 0; i--) {
        sum += parseInt(rutDigits.charAt(i), 10) * multiplier;
        multiplier = multiplier === 7 ? 2 : multiplier + 1;
    }

    const expectedVerificationDigit = 11 - (sum % 11);
    };

    const fetchBankDetails = () => {
    axios
        .get(`/api/user/${props.userId}/getbankdetails`)
        .then((response) => {
        formData.stepNineName = response.data.full_name;
        formData.stepNineBank = response.data.bank;
        formData.stepNineBankNumber = response.data.account_number;
        formData.stepNineRut = response.data.rut;
        formData.stepNineBankType = response.data.account_type;
        useBankDetails.value = true;
        })
        .catch((error) => {
        console.error("Error fetching user details:", error);
        });
    };

    // Watch for changes in formData.stepOneAgeDateIni
    watch(() => formData.stepOneAgeDateIni, (newValue, oldValue) => {
        if (newValue === "Recién nacido") {
            formData.stepOneShowFirstInput = false; // Hide the second select
        } else {
            formData.stepOneShowFirstInput = true; // Show the second select
        }
    });

    // Watch for changes in textareaHeight and update it accordingly
    watch(() => [dropdown.value, activeTrigger.value], () => {
        updateTextareaHeight();
    });



    onMounted(() => {
        fetchData();   
        fetchProductInfo();
        updateTextareaHeight();
        getRegionsChilexpress();
        fetchBankDetails();
        watch(
            () => selected.value.region,
            (newRegion) => {
                if (newRegion !== lastSelected.value.region) {
                    getComunasChilexpress.call(this);
                    lastSelected.value.region = newRegion;
                }
                formData.stepSevenRegion = lastSelected.value.region;
            }
        );

        watch(
            () => selected.value.city,
            (newCity) => {
                if (newCity !== lastSelected.value.city) {
                    getCoberturaOptions.call(this);
                    lastSelected.value.city = newCity;
                }
                formData.stepSevenCity = lastSelected.value.city;
            }
        );

        watch(
            () => formData.stepSevenOptionDelivery,
            (newOptionDelivery) => {
                if (newOptionDelivery === "Domicilio") {
                    formData.stepSevenChilexpressOffice = "";
                }
            }
        );

        // Set the initial selected region and city values from formData
        // selected.value.region = formData.stepSevenRegion;
        // selected.value.city = formData.stepSevenCity;
        // Set the initial selected region and city values from formData
        if (!props.productId) {
            selected.value.region = formData.stepSevenRegion;
            selected.value.city = formData.stepSevenCity;
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
.cont-images-result-end span{
    font-family: "Inter", sans-serif;
    font-size: 15px;
    font-weight: 500;
    color: #344026;
}
.cont-images-result .row-results,.cont-images-result-end .row-results {
    display: flex;
    flex-direction: row;
    margin-bottom: 1rem;
    justify-content: space-between;
}
.cont-images-result .row-results img, .cont-images-result-end .row-results img {
    width: 100%;
    max-width: 80px;
    height: 80px;
    margin-right: 1rem;
    object-fit: cover;
}
.cont-images-result .row-results p, .cont-images-result-end .row-results p {
    margin-bottom: 0;
}
.cont-images-result .row-results .first,
.cont-images-result .row-results .second,
.cont-images-result-end .row-results .first,
.cont-images-result-end .row-results .second {
    display: flex;
    flex-direction: row;
    align-items: center;
}
.cont-images-result .row-results .first p,.cont-images-result-end .row-results .first p {
    font-family: "Inter", sans-serif;
    font-size: 12px;
    font-weight: 400;
    color: #1b1f22;
}
.cont-images-result .row-results .second p,.cont-images-result-end .row-results .second p {
    font-size: 12px;
    font-weight: 600;
    color: #1b1f22;
    margin-right: 4rem;
}
.cont-images-result .row-results .second .fa-trash-can,.cont-images-result-end .row-results .second .fa-trash-can {
    height: 1.4em;
}
.cont-images-result .row-results .second .fa-trash-can path,.cont-images-result-end .row-results .second .fa-trash-can path {
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
