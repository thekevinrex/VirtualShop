<template lang="">

    <div :key="key" class="border rounded-md flex bg-white dark:bg-neutral-700 w-full mb-5 last:mb-0" :class="[borderClass]">
        <div class="flex flex-col items-start w-full relative">
            
            <label :for="id" class="flex py-1 pt-2 px-4" v-if="inputData.isHeader">
                <div class="text-xs">
                    {{ inputData.placeholder }}
                </div>
            </label>
            
            <div class="dropdown relative w-full">
                <div class="w-full px-3 h-10 shadow-md rounded-md dropdown-toggle flex flex-row" data-bs-toggle="dropdown" aria-expanded="false" data-mdb-ripple="true" data-mdb-ripple-color="dark">

                    <div class="flex-none h-10 w-10 p-1" v-if="inputData.front_icon || isLoading">

                        <slot v-if="inputData.front_icon && !isLoading" name="front-icon"></slot>
                        <div v-if="isLoading" class="flex items-center justify-center">
                            <slot name="loader"></slot>
                        </div>
                    </div>
    
                    <div class="w-full flex-initial flex items-center" v-text="selected"></div>

                    <select aria-hidden="true" :aria-labelledby="ariaLabelledby" :aria-describedby="inputData.ariaDescribedby" :id="id" :name="inputData.name" v-model="selectValue" class="hidden">
                        <option v-for="i in data" :value="i.id">{{ i.name }}</option>
                    </select>

                </div>
            
                <ul class=" dropdown-menu min-w-max w-full absolute hidden bg-white dark:bg-dark text-base z-50 float-left py-3 list-none text-left rounded-lg shadow-2xl mt-1 m-0 bg-clip-padding border-none left-auto right-0">
                    <li v-for="i in data">
                        <div @click="updateValue(i.id)" class="dropdown-item cursor-pointer py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 dark:text-white dark:hover:bg-neutral-800 hover:bg-gray-100">
                            {{ i.name }}
                        </div>
                    </li>
                </ul>
            </div>


        </div>
    </div>
    
</template>

<script>
import { v4 as uuidv4 } from 'uuid';
import { useMainStore } from '../store/mainStore.js';
import { prepateAxiosErrorToDisplay } from '../functions/axios.js';
import { mapActions } from 'pinia';

export default {

    emits: ['update:value', 'update:validation', 'fieldData', 'fetchedData'],
    props: {
        initialData: [Array, String],
        inputData: Object,
        value: [String, Number],
        fetchDataWithValue: [String, Number],
        fetchDataFrom: String,
        setLoading: Boolean,
        validation : [String, Array],
    },

    data() {
        return {
            key: uuidv4(),
            id: '',
            selected: '',
            selectValue: '',

            data: [],
            loading: false,

            error: false,
            ariaLabelledby: '',
            selectData : {},
        }
    },

    created() {

        if (typeof this.value != undefined)
            this.selectValue = this.value;
        
        if (Array.isArray(this.initialData)) {
            this.data = this.initialData;
        } else if (typeof this.initialData == 'string' && this.initialData == 'fetch') {
            
        }

        if (!this.inputData.id) {
            this.id = this.key;
        }

        if (!this.inputData.ariaLabelledby) {
            this.ariaLabelledby = this.id;
        }

        var _this = this;
        this.selectData = {
            key: this.key,
            data: this.data,
            value: '',
            error: false,
            deleted: false,
            validate: function () {
                _this.validateInput();
            },
            setData: function (data) {
                _this.setFetchData(data);
            }
        };

        this.showSelectedValue(this.selectValue);
        this.$emit('fieldData', this.selectData);
    },

    unmounted() {
        this.selectData.deleted = true;
    },

    computed: {
        borderClass: function () { return (this.isError ? 'border-red-600' : 'border-gray-300 dark:border-neutral-700') },
        isRequired: function () {return (this.inputData.required? true : false)},
        isError: function () { return this.error },
        isLoading: function () { return this.loading || (this.setLoading) }
    },

    watch: {
        fetchDataWithValue: function (newValue, oldValue) {

            this.data = [];
            this.updateValue('');

            this.fetchData(newValue, this.fetchDataFrom);

        },
        selectValue: function (newValue, oldValue) {

            this.showSelectedValue(newValue);

            this.selectData.value = newValue;
            this.$emit('update:value', newValue);
            
            this.validateInput();
        }
    },
    methods: {

        ...mapActions(useMainStore, ['addNewPageNotification']),

        validateInput: function () {
            if (this.isRequired) {
                this.error = false;
                this.selectData.error = false;
                if (!this.data.find(element => { return element.id == this.selectValue })) {
                    this.error = true;
                    this.selectData.error = true;
                }

                this.emitValidationError();
            }
        },

        showSelectedValue: function (value) {

            var element = this.data.find((element) => { return element.id == value });

            if (!element) {
                if (this.inputData.defaultMessage) {
                    this.selected = this.inputData.defaultMessage;
                }
                return false;
            }

            this.selected = element.name;
        },
        
        updateValue: function (value) {
            this.selectValue = value;
        },

        fetchData: function (value, from) {

            let fd = {
                'id': value,
            };

            var _this = this;
            this.loading = true;

            axios.post(from, fd)
                .then(function (res) {
                    _this.setFetchData(res.data.data);
                })
                .catch(function (err) {
                    _this.loading = false;
                    _this.addNewPageNotification({
                        message: prepateAxiosErrorToDisplay(err),
                        type: 'error',
                        autoDismiss: true,
                    });
                });
                
        },
        setFetchData: function (data) {
            this.loading = false;
            this.data = data;

            this.$emit('fetchedData', data);
        },

        emitValidationError: function () {

            if (!this.validation)
                return false;

            let errors = JSON.parse(JSON.stringify(this.validation));

            if (!errors.find(e => { return e.key == this.key })) {
                errors = [
                    ...errors,
                    {
                        'key': this.key,
                        error: this.isError,
                    }
                ];
            } else {
                errors.find(e => { return e.key == this.key }).error = this.isError;
            }

            this.$emit('update:validation', errors);
        }
    }

}
</script>