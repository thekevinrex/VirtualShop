<script>

import { mapActions } from 'pinia';
import { useMainStore } from '../store/mainStore';

import { v4 as uuidv4 } from 'uuid';
import { prepateAxiosErrorToDisplay } from '../functions/axios.js';

export default {

    props: {
        sendProductDataTo: String,
        provincias: Object,
        product: Object,
    },

    data() {
        return {
            info: {},
            price: {},

            isLoading : false,
            fetch_video: '',
            fieldsData : [],
        };
    },

    beforeMount() {

        this.info = {
            name: this.product.name,
            description: this.product.description,
            restric_age: this.product.restric_age,
            ratings: this.product.ratings,
            
            details: [],
            videos: [],
        };

        this.info.details = this.product.details.map(e => {
            return {
                ...e,
                keyUuid: uuidv4(),
            };
        });

        this.price = {
            price: this.product.price + "",
            delivery: this.product.shipping,
            delivery_data: [],
            mergedVariantes : [],
            currency: this.product.currency,
        };

        if (this.product.inventories.length > 0) {
            this.price.mergedVariantes = this.product.inventories.map((e) => {
                return {
                    ...e,
                    id : uuidv4(),
                }
            });
        }
        
        this.provincias.forEach(element => {
            this.price.delivery_data.push({
                id: element.id,
                municipios: element.municipios.map((e) => {
                    if (Object.values(this.product.shipping_aviable).find(ship => { return ship.id == e.id }) != undefined) {
                        return Object.values(this.product.shipping_aviable).find(ship => { return ship.id == e.id });
                    } else
                        return {
                            id : e.id,
                            price : e.price,
                            value : false,
                        };
                }),
            });
        });

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

        getFieldsData: function (data) {
            if (!this.fieldsData.find(e => { return e.key == data.key })) {
                this.fieldsData = [
                    ...this.fieldsData,
                    data,
                ];
            }
        },

        addInfo: function () {
            this.info.details.push({
                value: '',
                key: '',
                keyUuid: uuidv4 (),
            });
        },

        deleteInfo: function (id) {
            this.info.details = this.info.details.filter((element) => { return element.keyUuid != id });
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
                ...this.price,
            };

            let _this = this;
            _this.isLoading = true;

            axios.put(this.sendProductDataTo, fd)
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
    },

    render (){
        return this.$slots.default({
            isLoading: this.isLoading,
            info: this.info,
            price: this.price,
            fetch_video: this.fetch_video,
            fieldsData: this.getFieldsData,
            addInfo: this.addInfo,
            deleteInfo: this.deleteInfo,
            provincias: this.provincias,

            isDisabled: this.isDisableUpdateProduct,
            updateProduct: this.updateProduct,
        });
    }
    
}
</script>