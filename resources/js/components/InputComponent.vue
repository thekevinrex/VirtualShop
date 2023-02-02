<template lang="">
    <div :id="id" class="border rounded-md flex bg-white w-full mb-5 last:mb-0 overflow-hidden" :class="[borderClass]">
        <div class="flex flex-col items-start w-full relative">
            
            <div class="flex py-1 pt-2 px-4" v-if="inputData.isHeader">
                <div class="text-xs">
                    {{ inputData.placeholder }}
                </div>
            </div>

            <div class="flex flex-row w-full">

                <div class="flex-none h-10 w-10 p-1" v-if="inputData.front_icon">
                    <slot name="front-icon"></slot>
                </div>

                <div class="w-full flex-initial">

                    <input v-if="type == 'text'" :value="value" @input="updateInput" @blur="unFocusInput" @focus="focusInput" :name="inputData.name" type="text" required="isRequired" class="h-10 w-full appearance-none rounded-none border-none px-3 py-2 text-gray-900 focus:outline-none focus:border-none focus:shadow-none focus:ring-0 sm:text-sm" :placeholder="inputData.placeholder" />

                    <input v-if="type == 'password'" :value="value" @input="updateInput" @blur="unFocusInput" @focus="focusInput" :name="inputData.name" type="password" required="isRequired" class="h-10 w-full appearance-none rounded-none border-none px-3 py-2 text-gray-900 focus:outline-none focus:border-none focus:shadow-none focus:ring-0 sm:text-sm" :placeholder="inputData.placeholder" />
                    
                </div>

            </div>
            

        </div>
    </div>
    
    <div class="-mt-4 flex flex-col mb-5 last:mb-0 font-semibold text-red-500" v-if="DisplayErrors">
        <slot name="errors" :errorsType="errorType"></slot>
    </div>
    
</template>

<script>

// import {useMainStore} from '../store/mainStore'
// import { mapActions, mapState } from 'pinia';
import { v4 as uuidv4 } from 'uuid';
import { validateFieldData } from '../functions/validate';

export default {
    emits : ['update:value', 'update:formData'],
    props : {
        inputData : Object,
        type : String,
        value : String,
        confirm : String,
        formData : [String, Object],
    },
    data () {
        return {
            id : uuidv4 (),
            data : {},
            focused : false,
            error : false,
            errorType : [],
        }
    },
    created () {
        
        if (this.inputData == undefined){
            this.inputData = {
                name : 'Field',
                placeholder : 'Unknow Field'
            }
        }
        
        this.data = {
            id : this.id,
            value : '',
            error : false,
        }

    },
    computed : {
        borderClass () { return this.isFocused ? 'border-primary' : (this.isError? 'border-red-600' : 'border-gray-300') },
        isError : { 
            get () {
                return this.error;
            }, 
            set (newValue) {
                this.error = newValue.error;
                this.errorType = newValue.errorType;

                this.data.error = newValue.error;
            }
         },
        isFocused () { return (this.focused && !this.isError) },
        isRequired () { return (this.inputData.validate != undefined)? this.inputData.validate.includes('Required') : false },
        DisplayErrors () {
            if (this.isError) {
                if (this.errorType.length == 1 && this.errorType.includes ('Required')) {
                    return false;
                }

                return true;
            }

            return false;
        }
    },
    watch : {
        data : {
            handler (newValue, oldValue) {
                
                var value = {};

                if (typeof this.formData != 'object') {
                    value[this.id] = this.data;
                } else {
                    value = this.formData;
                    value[this.id] = this.data;
                }

                this.$emit('update:formData', value);
            },
            deep : true,
        },
        confirm (updateConfirm, oldConfirm) {
            if (this.isRequired && this.inputData.validate.includes('Confirm')) {

                this.isError = validateFieldData (this.value, this.inputData.validate);

                if (this.value != updateConfirm) {
                    this.isError = {
                        error : true,
                        errorType : [
                            ...this.errorType,
                            'Confirm',
                        ]
                    }
                }
            }
        }
    },
    methods : {
        validateInput : function () {
            if (this.isRequired) {
                this.isError = validateFieldData (this.value, this.inputData.validate);

                if (this.inputData.validate.includes('Confirm')) {
                    if (this.confirm != undefined) {
                        if (this.value != this.confirm) {
                            this.isError = {
                                error : true,
                                errorType : [
                                    ...this.errorType,
                                    'Confirm',
                                ]
                            }
                        }
                    }
                }
            }
        },
        updateInput : function ($event) {
            
            var value = ($event.target.value).trim ();

            // Update the external value 
            this.data.value = value;
            this.$emit('update:value', value);

            // validate the field
            this.validateInput ();

        },
        focusInput : function () {
            this.focused = true;
        },
        unFocusInput : function () {
            this.focused = false;

            this.validateInput ();
        }
    }
}
</script>
