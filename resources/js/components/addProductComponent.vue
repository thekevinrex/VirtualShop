<template lang="">
    
    <div class="bg-white w-full flex flex-col dark:bg-dark">
        
        <slot :isLoading="isLoading"></slot>

        <div class="sticky-top top-14 z-50 bg-white dark:bg-dark border-b dark:border-neutral-700 w-full flex-col">
            <slot name="header" 
                :updateProduct="updateProduct" 
                :isDisabled="isDisableUpdateProduct"  
                :navegationTabs="navegationTabs"
                :tabsInfo="tabsInfo"
                :updateTab="updateTab">
            </slot>
        </div>

        <div class="flex flex-wrap flex-row w-full">
            
            <div 
                v-if="navegationTabs.actualTab == 'info'" 
                class="flex flex-row flex-wrap w-full dark:text-white"
            >
                <slot name="info" 
                    :price="price" 
                    :info="info" 
                    :listening="listening"
                    :addInfo="addInfo" 
                    :deleteInfo="deleteInfo" 
                    :fetchVideo="fetchVideo" 
                    :loading="loadingCategory" 
                    :required="required" 
                    :models="models"
                    :setFetchedData="setFetchedData"
                    :fieldsData="getFieldsData">
                </slot>
            </div>

            <div 
                v-if="navegationTabs.actualTab == 'variantes'" 
                class="flex flex-row flex-wrap w-full dark:text-white"
            >
                <slot name="variantes" 
                    :selectVariantCate="selectVariantCate" 
                    :selectedCate="selectedCate" 
                    :variantsData="variantsData" 
                    :addVariant="addVariant" 
                    :setCateVariantAsMain="setCateToHaveImages" 
                    :addVariantCate="addVariantCate" 
                    :deleteVariantCate="deleteVariantCate" 
                    :deleteVariant="deleteVariant" 
                    :fieldsData="getFieldsData">
                </slot>
            </div>

            <div 
                v-if="navegationTabs.actualTab == 'money'"  
                class="flex flex-row flex-wrap w-full dark:text-white"
            >
                <slot name="money" 
                    :price="price" 
                    :payments="payments"
                    :variantsData="variantsData" 
                    :provinces="provinces" 
                    :fieldsData="getFieldsData">
                </slot>
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
        provinces: Array,
        payments: Array,
        seller_id: Number,
    },
    
    data() {
        return {
            
            info: {
                name : '',
                description: '',
                restricted_age: true,
                ratings : 'allow',
                details: [],
                videos: [],
            },

            price: {
                mergedVariants  : [],
                price            : '0',
                shipping         : 'logistic',
                shipping_aviable : [],
                currency: 'USD',
                payments: [],
            },
            
            listening: {
                category_id    : "",
                brand_id       : "0",
                brand_model_id : "0",
            },

            variantsData : {
                cates       : [],
                variants    : [],
                mainVariant : uuidv4(),
            },

            selectedCate    : 0,
            loadingCategory : false,
            isLoading       : false,

            brands: [],
            required: [],
            fetchVideo: '',


            models: [],
            fieldsData : [],

            navegationTabs: {
                actualTab: 'info',
                prevTab: null,
                nextTab: 'variantes',
            },

            tabsInfo: [
                {
                    num : 0,
                    key: 'info',
                    passed: false,
                },
                {
                    num: 1,
                    key: 'variantes',
                    passed: false,
                },
                {
                    num: 2,
                    key: 'money',
                    passed: false,
                }
            ],
        };
    },

    mounted() {

        this.provinces.forEach(element => {
            this.price.shipping_aviable.push({
                id: element.id,
                municipalities: element.municipalities.map((e) => {
                    return {
                        id : e.id,
                        price : e.price,
                        value : true,
                    };
                }),
            });
        });

        this.payments.forEach(element => {
            this.price.payments.push({
                key: element.key,
                value: true,
            });
        });
        
        this.addVariant({
            cate: this.variantsData.mainVariant,
            name: 'Main variante',
        });

    },

    watch: {

        'listening.category_id': function (newValue) {
            this.fetchRequiredDataFromCategory(newValue);
        },
        
    },

    computed: {

        isDisableUpdateProduct: function () {

            if (this.fieldsData.filter(e => { return e.error }).length > 0) 
                return true;

            return false;
        }
        
    },

    methods: {
        ...mapActions(useMainStore, ['addNewPageNotification']),


        setFetchedData: function (data) {
            console.log(data);
            this.models = data;
        },

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
        generateCrossCateVsVariantModel: function () {

            if (this.variantsData.cates.length == 0) {
                this.price.mergedVariants = [];
                return false;
            }

            let variants = [];

            this.variantsData.cates.forEach((element) => {
                variants.push(
                    this.variantsData.variants
                    .filter(e => { return e.cate == element.id })
                    .map(e => { return e.id })
                );
            });

            let newMergeVariants = this.mergeCateWithVariant(variants, this.variantsData.cates.length);

            this.price.mergedVariants = [];
            newMergeVariants.forEach(element => {

                this.price.mergedVariants.push({
                    id: uuidv4(),
                    price : this.price.price,
                    merged: (!isArray(element)? [element] : element),
                });

            });

        },

        /**
         * A recursive method to permutate the variants
         */
        mergeCateWithVariant: function (arr, total) {

            let returnArr = [];
            let length = arr.length;

            if (total < 0 || total > length)
                return returnArr;

            for (let i = 0; i < length; i++) {
                let t = arr[i];
                if (total == 1) {
                    return t;
                } else {
                    let b = this.mergeCateWithVariant(arr.slice(i + 1), total - 1);
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

        varificateIfThereIsAnyError: function () {

            this.fieldsData = this.fieldsData.filter(e => { return !e.deleted });

            this.fieldsData.forEach(e => {
                if (typeof e.validate() == 'function')
                    e.validate();
            });

            if (this.fieldsData.filter(e => { return e.error }).length > 0) 
                return true;

            return false;
        },

        /**
         * it update the tabs and validate the current tab
         */
        updateTab: function (newTab) {

            if (!this.tabsInfo.map((e) => {return e.key}).includes(newTab))
                return false;

            if (this.varificateIfThereIsAnyError())
                return false;

            let actualTab = this.tabsInfo.find((e) => { return this.navegationTabs.actualTab === e.key });
            let nextTab   = this.tabsInfo.find((e) => { return newTab === e.key });

            if (nextTab.num < 0 || nextTab.num > this.tabsInfo.length - 1)
                return false;

            if (nextTab.num > actualTab.num) {
                if (nextTab.num - actualTab.num > 1) {
                    if (!this.tabsInfo.find((e) => { return e.num == actualTab.num + 1 }).passed)
                        return false;
                }
            }

            actualTab.passed = true;


            if (nextTab.num == 0) {
                this.navegationTabs.prevTab = null;
            } else {
                this.navegationTabs.prevTab = this.tabsInfo.find((e) => { return e.num == nextTab.num-1 }).key;
            }

            if (nextTab.num == this.tabsInfo.length - 1) {
                this.navegationTabs.nextTab = null;
            } else {
                this.navegationTabs.nextTab = this.tabsInfo.find((e) => { return e.num == nextTab.num+1 }).key;
            }

            this.navegationTabs.actualTab = newTab;
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
                'category_id' : value,
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

        addVariantCate: function () {

            var idCate = uuidv4();

            this.variantsData.cates.push({
                id: idCate,
                value: '',
                with_images: false,
            });

            this.addVariant({cate:idCate});

            if (this.variantsData.cates.length == 1) {
                this.setCateToHaveImages(idCate);
            }
            
            this.selectVariantCate(idCate);
        },

        setCateToHaveImages: function (idCate) {
            this.variantsData.cates = this.variantsData.cates.map((element) => { 

                element.with_images = false;
                if (element.id == idCate)
                    element.with_images = true;

                return element;
             });
        },

        selectVariantCate: function (id) {
            this.selectedCate = id;
        },
        
        addVariant: function (variant) {

            let newVariant = Object.assign({
                id: uuidv4(),
                image: '',
                images: [],
                name: '',
                des: '',
            }, variant);

            this.variantsData.variants.push(newVariant);

            this.generateCrossCateVsVariantModel();
        },

        deleteVariantCate: function (id) {

            let with_images = this.variantsData.cates.some((element) => { return element.id == id && element.with_images });

            this.variantsData.cates = this.variantsData.cates.filter((element) => { return element.id != id });
            this.variantsData.variants = this.variantsData.variants.filter((element) => { return element.cate != id });

            this.generateCrossCateVsVariantModel();
            
            if (!with_images && this.selectedCate != id)
                return true;

            var selectedCate = JSON.parse(JSON.stringify(this.variantsData.cates)).shift();

            if (selectedCate == undefined)
                return false;
            
            this.selectedCate = selectedCate.id;

            if (with_images)
                this.setCateToHaveImages(selectedCate.id);

            this.selectVariantCate(selectedCate.id);
        },

        deleteVariant: function (id) {

            var variant = this.variantsData.variants.find((element) => { return element.id == id });

            if (variant == undefined)
                return false;

            if (this.variantsData.variants.filter((element) => {return element.cate == variant.cate}).length == 1)
                return false;
            
            this.variantsData.variants = this.variantsData.variants.filter((element) => { return element.id != id });
        },


        updateProduct: function () {

            if (this.varificateIfThereIsAnyError())
                return false;

            let fd = {
                'seller_id' : this.seller_id,
                ...this.info,
                ...this.listening,
                ...this.variantsData,
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