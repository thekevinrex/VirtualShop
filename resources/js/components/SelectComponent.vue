<template lang="">

    <div :id="id" class="border rounded-md flex bg-white dark:bg-neutral-700 dark:border-neutral-700 w-full mb-5 last:mb-0" :class="[borderClass]">
        <div class="flex flex-col items-start w-full relative">
            
            <div class="flex py-1 pt-2 px-4" v-if="inputData.isHeader">
                <div class="text-xs">
                    {{ inputData.placeholder }}
                </div>
            </div>
            
            <div class="dropdown relative w-full">
                <div class="w-full px-3 h-10 shadow-md rounded-md dropdown-toggle flex flex-row" data-bs-toggle="dropdown" aria-expanded="false" data-mdb-ripple="true" data-mdb-ripple-color="dark">

                    <div class="flex-none h-10 w-10 p-1" v-if="inputData.front_icon || loading">

                        <slot v-if="inputData.front_icon && !loading" name="front-icon"></slot>
                        <div v-if="loading" class="flex items-center justify-center">
                            <slot name="loader"></slot>
                        </div>
                    </div>
    
                    <div class="w-full flex-initial flex items-center" v-text="selected"></div>

                    <select :name="inputData.name" @change="changeValue" v-model="selectValue" class="hidden">
                        <option v-for="i in data" :value="i.id">{{ i.name }}</option>
                    </select>

                </div>
            
                <ul class=" dropdown-menu min-w-max w-full absolute hidden bg-white dark:bg-dark text-base z-50 float-left py-3 list-none text-left rounded-lg shadow-2xl mt-1 m-0 bg-clip-padding border-none left-auto right-0" aria-labelledby="id" >
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

export default {

    emits: ['update:value'],
    props: {
        initialData: [Array, String],
        inputData: Object,
        value: [String, Number],
        fetchDataWithValue: [String, Number],
        fetchDataFrom : String,
    },

    data() {
        return {
            id: uuidv4(),
            selected: '',
            selectValue: '',
            data: [],
            loading : false,
        }
    },

    mounted() {

        if (this.inputData.defaultMessage) {
            this.selected = this.inputData.defaultMessage;
        }
        console.log(typeof this.initialData);
        if (Array.isArray(this.initialData)) {
            this.data = this.initialData;
        } else if (typeof this.initialData == 'string' && this.initialData == 'fetch') {
            
        }

        this.selectValue = this.value;
    },

    computed: {
        borderClass: function () { return (this.isError ? 'border-red-600' : 'border-gray-300') },
        isError : function () { return false }
    },
    watch: {
        fetchDataWithValue: function (newValue, oldValue) {

            this.data = [];
            this.updateValue('');

            this.fetchData(newValue, this.fetchDataFrom);

        },
        selectValue: function (newValue, oldValue) {

            var element = this.data.find((element) => { return element.id == newValue });

            if (!element) {
                if (this.inputData.defaultMessage) {
                    this.selected = this.inputData.defaultMessage;
                }
                return false;
            }

            this.selected = element.name;
            this.$emit('update:value', newValue);
        }
    },
    methods: {
        changeValue: function (e) {
            
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
                    console.log(err);
                });
                
        },
        setFetchData: function (data) {
            this.loading = false;
            this.data = data;
        }
    }

}
</script>