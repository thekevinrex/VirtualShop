<template lang="">
    <div :key="key">
        
        <slot :image="image" :images="images" :deleteImage="deleteImage" :data="data"></slot>

        <input  class="hidden" aria-label="Upload the selected/s images to the app" aria-hidden="true" :multiple="isMultiple" type="file" :accept="accept" :name="name" :id="id" @change="change">

        <div class="flex flex-col bg-red-700 rounded-md mb-5 w-full py-1 px-3 my-1 mx-1" v-if="isError">
            <div class="text-sm text-white">
                {{ error }}
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
    emits : ['update:value', 'fieldData'],
    props: {
        value: [String, Array, Object],
        name: String,
        id: String,
        accept: String,
        required: Boolean,
        multiple : [Boolean, String],
    },
    data() {
        return {
            key : uuidv4 (),
            file: '',
            files: [],

            image: '',
            images: [],

            error: '',
            data : {},
        }
    },

    created() {
        
        if (this.isMultiple) {
            if (this.value != undefined)
                this.images = this.value;
        } else {
            if (this.value.path != undefined && this.value.path != '') {
                this.image = '<img src="' + this.value.path + '" class="w-full h-full">';
            }
        }

        var _this = this;
        this.data = {
            error: false,
            image: '',
            images: [],
            deleted: false,
            key : this.key,
            validate: function () {
                _this.validate();
            },
        };

        this.$emit('fieldData', this.data);

    },

    unmounted() {
        this.data.deleted = true;
    },

    computed: {
        isError: function () { return this.error != ''; },
        isMultiple: function () { return Boolean(this.multiple); },
        isRequired : function () { return (this.required) }
    },
    methods: {

        ...mapActions(useMainStore, ['addNewPageNotification']),

        validate: function () {

            if (!this.isRequired)
                return false;

            this.data.error = false;
            if (this.isMultiple) {
                if (this.images.length == 0)
                    this.data.error = true;
            } else {
                if (this.image == '')
                    this.data.error = true;
            }
        },

        change: function (e) {

            if (e.target.value == '')
                return false;

            if (this.isMultiple) {
                for (var i = 0; i < e.target.files.length; i++) {
                    this.files[i] = e.target.files[i];
                }
            } else {
                this.file = e.target.files[0];
            }

            e.target.value = '';

            this.upload();
        },

        upload: function() {

            let fd = new FormData();

            fd.append('multiple', this.isMultiple);
            fd.append('type', 'images');
            if (this.isMultiple) {
                for (var i = 0; i < this.files.length; i++) {
                    fd.append('file[' + i + ']', this.files[i]);
                }
            }
            else {
                fd.append('file', this.file);
            }

            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }

            this.error = '';
            var _this = this;

            axios.post('/api/upload', fd, config)
                .then(function (res) {
                    _this.saveChanges(res.data);
                })
                .catch(function (err) {
                    _this.handleTheResponseError(err);
                });
        },
        saveChanges: function (res) {

            if (this.isMultiple) {
                var files = res.map((element) => { return element });

                this.images = [
                    files,
                    ...this.images,
                ].flat();

                // this.data.images = this.images.map((element) => { return element.image });
                this.$emit('update:value', this.images);

            } else {
                this.data.image = res;
                this.$emit('update:value', res);
                this.image = '<img src="' + res.path + '" class="w-full h-full">';
            }

            this.validate();
        },

        deleteImage: function (image) {

            this.images = this.images.filter((element) => { return element.image != image });
            this.$emit('update:value', this.images.map((element) => { return element.image }));
        },

        handleTheResponseError: function (res) {
            this.error = res.response.data.message;

            this.addNewPageNotification({
                message: prepateAxiosErrorToDisplay(res.response.data.message),
                type: 'error',
                autoDismiss: true,
            });
        }
    }
    
}
</script>