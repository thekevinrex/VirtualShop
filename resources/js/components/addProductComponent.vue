<template lang="">
    
    <div class="bg-white w-full flex flex-col dark:bg-dark">
        
        <slot :isLoading="isLoading"></slot>

        <div class="sticky-top top-14 z-50 bg-white dark:bg-dark w-full flex-col">
            <slot name="header" :updateProduct="updateProduct" :isDisabled="isDisableUpdateProduct"  :actualTab="actualTab" :updateTab="updateTab"></slot>
        </div>
        
        <div class="flex flex-wrap flex-row w-full">
            
            <div v-if="actualTab == 'info'" class="flex flex-row flex-wrap w-full dark:text-white">
                <slot name="info" :price="price" :info="info" :listening="listening" :marcas="marcas" :addInfo="addInfo" :deleteInfo="deleteInfo" :fetch_video="fetch_video" :loading="loadingCategory" :required="required" :fieldsData="getFieldsData"></slot>
            </div>

            <div v-if="actualTab == 'variantes'"  class="flex flex-row flex-wrap w-full dark:text-white">
                <slot name="variantes" :selectVarianteCate="selectVarianteCate" :selectedCate="selectedCate" :variantes="variantes" :addVariante="addVariante" :setCateVarianteAsMain="setCateToHaveImages" :addVarianteCate="addVarianteCate" :deleteVarianteCate="deleteVarianteCate" :deleteVariante="deleteVariante" :fieldsData="getFieldsData"></slot>
            </div>

            <div v-if="actualTab == 'money'"  class="flex flex-row flex-wrap w-full dark:text-white">    
                <slot name="money" :price="price" :variantes="variantes" :provincias="provincias" :fieldsData="getFieldsData"></slot>
            </div>
        </div>
    </div>

        
</template>

<script>

import { mapActions } from 'pinia';
import { useMainStore } from '../store/mainStore';
import { isArray } from '@vue/shared';
import { v4 as uuidv4 } from 'uuid';
import { prepateAxiosErrorToDisplay } from '../functions/axios.js';

export default {

    props: {
        fetchCategoryDataFrom: String,
        sendProductDataTo: String,
        provincias : [String, Array],
    },
    
    data() {
        return {

            info: {
                name : '',
                description: '',
                restric_age: true,
                ratings : 'allow',
                details: [],
                videos: [],
            },

            price: {
                mergedVariantes: [],
                price: 0 + "",
                delivery: 'logistic',
                delivery_data: [],
                currency: 'USD'
            },
            
            listening: {
                category: "",
                marca: "",
                modelo: "",
            },

            variantes: {
                cates: [],
                variantes: [],
                mainVariante : uuidv4(),
            },

            selectedCate : 0,
            loadingCategory: false,
            isLoading : false,

            marcas: [],
            required: [],
            fetch_video: '',

            fieldsData : [],

            actualTab : 'info',
        };
    },

    mounted() {

        this.provincias.forEach(element => {

            this.price.delivery_data.push({
                id: element.id,
                municipios: element.municipios.map((e) => {
                    return {
                        id : e.id,
                        price : e.price,
                        value : true,
                    };
                }),
            });
            
        });
        
        this.variantes.variantes.push({
            id: uuidv4(),
            cate: this.variantes.mainVariante,

            image: '',
            images: [],
            name: 'Main variante',
            des : '',
        });

    },

    watch: {

        'listening.category': function (newValue) {
            this.fetchRequiredDataFromCategory(newValue);
        },
        
    },

    computed: {

        isDisableUpdateProduct: function () {

            if (this.fieldsData.filter(e => { return e.error }).length > 0) {
                return true;
            }

            return false;
        }
        
    },

    methods: {
        ...mapActions(useMainStore, ['addNewPageNotification']),

        /**
         * Used to verificate the required input, it is passed to every template and listen when each field input triggerit
         */
        getFieldsData: function (data) {
            if (!this.fieldsData.find(e => { return e.key == data.key })) {
                this.fieldsData = [
                    ...this.fieldsData,
                    data,
                ];
            }
        },

        /**
         * When a new variante is created it call this method, that will permutate all the variantes
         */
        generateCrossCateVsVarianteModel: function () {

            if (this.variantes.cates.length == 0) {
                this.price.mergedVariantes = [];
                return false;
            }

            let variantes = [];

            this.variantes.cates.forEach((element) => {
                variantes.push(
                    this.variantes.variantes
                    .filter(e => { return e.cate == element.id })
                    .map(e => { return e.id })
                );
            });

            let newMergeVariantes = this.mergeCateWithVariante(variantes, this.variantes.cates.length);

            this.price.mergedVariantes = [];
            newMergeVariantes.forEach(element => {

                this.price.mergedVariantes.push({
                    id: uuidv4(),
                    price : this.price.price,
                    merged: (!isArray(element)? [element] : element),
                });

            });

        },

        /**
         * A recursive method to permutate the variants
         */
        mergeCateWithVariante: function (arr, total) {

            let returnArr = [];
            let length = arr.length;

            if (total < 0 || total > length)
                return returnArr;

            for (let i = 0; i < length; i++) {
                let t = arr[i];
                if (total == 1) {
                    return t;
                } else {
                    let b = this.mergeCateWithVariante(arr.slice(i + 1), total - 1);
                    t.forEach(element => {
                        b.forEach(ele => {
                            returnArr.push([
                                element,
                                ele,
                            ].flat());
                        });
                    });   
                }
            }

            return returnArr;  
        },

        /**
         * it update the tabs and validate the current tab
         */
        updateTab: function (newTab) {

            if (!['money', 'variantes', 'info'].includes(newTab))
                return false;

            this.fieldsData = this.fieldsData.filter(e => { return !e.deleted });

            this.fieldsData.forEach(e => {
                if (typeof e.validate() == 'function')
                    e.validate();
            });

            if (this.fieldsData.filter(e => { return e.error }).length > 0) {
                return false;
            }

            this.actualTab = newTab;
        },

        addInfo: function () {
            this.info.details.push({
                value: '',
                key: '',
                id: uuidv4 (),
            });
        },

        deleteInfo: function (id) {
            this.info.details = this.info.details.filter((element) => { return element.id != id });
        },

        /**
         * when a new category is selected it will fetch all the brands, and requierement related to the category
         */
        fetchRequiredDataFromCategory: function (value) {

            this.loadingCategory = true;
            var _this = this;

            let fd = {
                'category' : value,
            };

            axios.post(this.fetchCategoryDataFrom, fd)
                .then(function (res) {
                    _this.updateRequiredDataFromCategory(res.data.data);
                })
                .catch(function (err) {
                    _this.loadingCategory = false;
                    _this.addNewPageNotification({
                        message: prepateAxiosErrorToDisplay(err),
                        type: 'error',
                        autoDismiss: true,
                    });
                });
                
        },
        updateRequiredDataFromCategory: function (data) {
            this.loadingCategory = false;
            this.required = data;
        },

        addVarianteCate: function () {
            var idCate = uuidv4();

            this.variantes.cates.push({
                id: idCate,
                value: '',
                with_image: false,
            });

            this.addVariante(idCate);

            if (this.variantes.cates.length == 1) {
                this.setCateToHaveImages(idCate);
                this.selectVarianteCate(idCate);
            }
        },

        setCateToHaveImages: function (idCate) {
            this.variantes.cates = this.variantes.cates.map((element) => { 

                element.with_image = false;
                if (element.id == idCate)
                    element.with_image = true;

                return element;
             });
        },

        selectVarianteCate: function (id) {
            this.selectedCate = id;
        },
        
        addVariante: function (idCate) {
            this.variantes.variantes.push({
                id: uuidv4(),
                cate: idCate,

                image: '',
                images: [],
                name: '',
                des : '',
            });

            this.generateCrossCateVsVarianteModel();
        },

        deleteVarianteCate: function (id) {

            var with_image = this.variantes.cates.some((element) => { return element.id == id && element.with_image });

            this.variantes.cates = this.variantes.cates.filter((element) => { return element.id != id });
            this.variantes.variantes = this.variantes.variantes.filter((element) => { return element.cate != id });

            var selectedCate = JSON.parse(JSON.stringify(this.variantes.cates)).shift();

            if (selectedCate == undefined)
                return false;
            
            this.selectedCate = selectedCate.id;

            if (with_image)
                this.setCateToHaveImages(selectedCate.id);

            this.selectVarianteCate(selectedCate.id);
        },

        deleteVariante: function (id) {

            var cate = this.variantes.variantes.find((element) => { return element.id == id });

            if (cate == undefined)
                return false;

            if (this.variantes.variantes.filter((element) => {return element.cate == cate.cate}).length == 1)
                return false;
            
            this.variantes.variantes = this.variantes.variantes.filter((element) => { return element.id != id });
        },


        updateProduct: function () {

            this.fieldsData = this.fieldsData.filter(e => { return !e.deleted });

            this.fieldsData.forEach(e => {
                if (typeof e.validate() == 'function')
                    e.validate();
            });

            if (this.fieldsData.filter(e => { return e.error }).length > 0) {
                return false;
            }

            let fd = {
                ...this.info,
                ...this.listening,
                ...this.variantes,
                ...this.price,
            };

            let _this = this;
            _this.isLoading = true;

            axios.post(this.sendProductDataTo, fd)
                .then(function (res) {
                    _this.isLoading = false;
                    _this.addNewPageNotification({
                        message: res.data.successMessage,
                        type: 'success',
                        autoDismiss: false,
                    });
                    _this.redirectToProduct(res.data.redirect);
                })
                .catch(function (err) {
                    _this.isLoading = false;
                    _this.addNewPageNotification({
                        message: prepateAxiosErrorToDisplay(err),
                        type: 'error',
                        autoDismiss: true,
                    });
                });
        },

        redirectToProduct: function (to) {
            this.$splade.visit(to);
        }
    }

}
</script>