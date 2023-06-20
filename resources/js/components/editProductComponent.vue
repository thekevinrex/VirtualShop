<script>

import { mapActions } from 'pinia';
import { useMainStore } from '../store/mainStore';

import { v4 as uuidv4 } from 'uuid';
import { prepateAxiosErrorToDisplay } from '../functions/axios.js';

export default {

    props: {
        sendProductDataTo: String,
        provinces: Array,
        product: Object,
        seller_id: Number,
    },

    data() {
        return {
            info: {
                name: '',
                description: '',
                restricted_age: true,
                ratings: '',

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

            isLoading : false,
            fetch_video: '',
            fieldsData : [],
        };
    },

    beforeMount() {

        this.info = Object.assign(
            this.info,
            {
                name: this.product.name,
                description: this.product.description,
                restric_age: this.product.restric_age,
                ratings: this.product.ratings,
            }
        );

        this.info.details = this.product.details.map(e => {
            return {
                ...e,
                keyUuid: uuidv4(),
            };
        });

        this.price = Object.assign(
            this.price,
            {
                price: this.product.price + "",
                shipping: this.product.shipping,
                currency: this.product.currency,
            }
        );

        if (this.product.inventories.length > 0) {
            this.price.mergedVariants = this.product.inventories.map((e) => {
                return {
                    ...e,
                    id : uuidv4(),
                }
            });
        }

        this.provinces.forEach(element => {
            this.price.shipping_aviable.push({
                id: element.id,
                municipalities: element.municipalities.map((e) => {
                    if (Object.values(this.product.shipping_aviable).some(ship => { return ship.id == e.id })) {
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
                'seller_id' : this.seller_id,
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
            provinces: this.provinces,

            isDisabled: this.isDisableUpdateProduct,
            updateProduct: this.updateProduct,
        });
    }
    
}
</script>