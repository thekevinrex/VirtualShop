<template lang="">
    <div>
        <div v-if="isError" class="w-full py-4 px-8 text-base bg-red-500">asdas</div>

        <slot :image="image"></slot>

        <input  class="hidden" :multiple="isMultiple" type="file" :accept="accept" :name="name" :id="id" @change="change">
    </div>
</template>

<script>
export default {
    emits : ['update:value'],
    props: {
        value: String,
        name: String,
        id: String,
        accept: String,
        multiple : [Boolean, String],
    },
    data() {
        return {
            file: '',
            files: [],
            image: '',
            error: '',
        }
    },
    computed: {
        isError: function () {
            return false;
        },
        isMultiple: function () {
            return Boolean(this.multiple);
        }
    },
    methods: {
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
            var _this = this;
            axios.post('/upload', fd, config)
                .then(function (res) {
                    _this.saveChanges(res.data);
                })
                .catch(function (err) {
                    console.log(err);
                });
        },
        saveChanges: function (res) {
            this.$emit('update:value', res.image);
            this.image = '<img src="'+ res.path +'" class="w-full h-full">';
        }
    }
    
}
</script>