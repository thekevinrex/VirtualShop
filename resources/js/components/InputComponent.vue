<template lang="">
    <div :key="key" class="border rounded-md flex bg-white dark:bg-neutral-700 w-full mb-5 last:mb-0" :class="[borderClass]">
        <div class="flex flex-col items-start w-full relative">

            <label :for="id" class="flex py-1 pt-2 px-4 dark:text-white w-full" v-if="inputData.isHeader">
                <div class="text-xs">
                    {{ inputData.placeholder }}
                </div>
            </label>

            <div class="flex flex-row w-full shadow-md dark:text-white dark:fill-white">

                <div class="flex-none h-10 w-10 p-1" v-if="inputData.front_icon">
                    <slot name="front-icon"></slot>
                </div>

                <div class="w-full flex-initial">

                    <input 
                        v-if="type == 'text'" 
                        v-model="fieldValue" 
                        @blur="unFocusInput" 
                        @focus="focusInput" 
                        :name="inputData.name" 
                        type="text" 
                        :id="id" 
                        :aria-labelledby="ariaLabelledby" 
                        :aria-describedby="inputData.ariaDescribedby" 
                        :required="isRequired" 
                        :placeholder="placeholder" 
                        class="
                            dark:bg-neutral-700 dark:text-gray-200 
                            h-10 w-full 
                            appearance-none rounded-md 
                            border-none px-3 py-2 
                            text-gray-900 
                            focus:outline-none focus:border-none focus:shadow-none focus:ring-0 
                            sm:text-sm" 
                    />

                    <input 
                        v-if="type == 'password'" 
                        v-model="fieldValue" 
                        @blur="unFocusInput" 
                        @focus="focusInput" 
                        :name="inputData.name" 
                        type="password" 
                        :id="id" 
                        :aria-labelledby="ariaLabelledby" 
                        :aria-describedby="inputData.ariaDescribedby" 
                        :required="isRequired" 
                        :placeholder="placeholder" 
                        class="
                            dark:bg-neutral-700 dark:text-gray-200 
                            h-10 w-full appearance-none 
                            rounded-md border-none 
                            px-3 py-2 
                            text-gray-900 
                            focus:outline-none focus:border-none focus:shadow-none focus:ring-0 
                            sm:text-sm" 
                    />

                    <textarea 
                        v-if="type == 'textarea'" 
                        v-model="fieldValue" 
                        @blur="unFocusInput" 
                        @focus="focusInput" 
                        :name="inputData.name" 
                        :id="id" 
                        :aria-labelledby="ariaLabelledby" 
                        :aria-describedby="inputData.ariaDescribedby" 
                        :required="isRequired" 
                        :placeholder="placeholder" 
                        class="
                            dark:bg-neutral-700 dark:text-gray-200 
                            h-28 w-full 
                            appearance-none rounded-md 
                            border-none 
                            px-3 py-2 
                            text-gray-900 
                            focus:outline-none focus:border-none focus:shadow-none focus:ring-0 
                            sm:text-sm">
                    </textarea>
                    
                </div>

            </div>
            

        </div>

    </div>

    <slot name="description"></slot>
    
    <div 
        class="-mt-4 flex flex-col mb-5 last:mb-0 font-semibold text-red-500" 
        v-if="DisplayErrors"
    >
        <slot 
            name="errors" 
            :errorsType="errorType">
        </slot>
    </div>

</template>

<script>

import { v4 as uuidv4 } from 'uuid';
import { validateFieldData } from '../functions/validate';

export default {
    emits: ['update:value', 'update:formData', 'update:validation', 'fieldData'],
    
    props: {
        initialValue: String,
        inputData : Object,
        type : String,
        value : [String, Number],
        confirm : String,
        formData: [String, Object],
        validation: Array,
    },

    data () {
        return {
            key : uuidv4 (),
            id : '',
            data : {},
            focused : false,
            error: false,
            fieldValue : '',
            errorType: [],
            ariaLabelledby: '',
            placeholder :'',
        }
    },
    mounted () {
        
        if (this.inputData == undefined){
            this.inputData = {
                name : 'Field',
                placeholder : 'Unknow Field'
            }
        }

        if (!this.inputData.id)
            this.id = this.key;

        if (!this.inputData.ariaLabelledby)
            this.ariaLabelledby = this.id;

        var _this = this;
        this.data = {
            key: this.key,
            value: '',
            error: false,
            errorType: [],
            deleted : false,
            validate: function () {
                _this.validateInput();
            },
            updateFieldValue: function (value) {
                _this.fieldValue = value;
                _this.updateFieldValue(value);
            },
        };

        if (!this.inputData.isHeader) {
            this.placeholder = this.inputData.placeholder;
        }

        if (typeof this.value != undefined && this.value != '')
            this.fieldValue = this.value;
        else {
            if (this.initialValue != undefined) {
                this.fieldValue = this.initialValue;
            }
        }

        this.$emit('fieldData', this.data);
    },
    unmounted() {
        this.data.deleted = true;
    },
    computed: {
        
        borderClass() {
            return this.isFocused
                ? 'border-primary'
                : (this.isError
                    ? 'border-red-600'
                    : 'border-gray-300 dark:border-neutral-500'
                );
        },
        isError : { 
            get () {
                return this.error;
            }, 
            set (newValue) {
                this.error = newValue.error;
                this.errorType = newValue.errorType;

                this.data.error = newValue.error;
                this.data.errorType = newValue.errorType;
            }
        },

        isFocused () { return (this.focused && !this.isError) },
        isRequired() {
            return (this.inputData.validate != undefined)
                ? this.inputData.validate.includes('Required')
                : false;
        },
        DisplayErrors() {
            
            if (this.isError) {

                if (this.errorType.length == 1 && this.errorType.includes('Required')) {
                    return false;
                }

                return true;
            }

            return false;
        },
    },
    watch: {
        
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
        },

        fieldValue: function (newValue, oldValue) {
            this.updateFieldValue(newValue);
        }
    },
    methods : {
        validateInput : function () {
            if (this.isRequired) {
                this.isError = validateFieldData (this.fieldValue, this.inputData.validate);

                if (this.inputData.validate.includes('Confirm')) {
                    if (this.confirm != undefined) {
                        if (this.fieldValue != this.confirm) {
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
                
                this.emitValidationError();
            }
        },
        focusInput : function () {
            this.focused = true;
        },
        unFocusInput : function () {
            this.focused = false;

            this.validateInput ();
        },
        updateFieldValue : function (value) {
            
            // Update the external value 
            this.data.value = value;
            this.$emit('update:value', value);

            // validate the field
            this.validateInput ();

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
