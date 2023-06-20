<template lang="">
    <div class="w-full p-20 flex flex-col">

        <div class="w-full flex justify-center flex-col items-center min-h-[300px] space-y-3" ref="upload">
            <slot name="add-upload"></slot>
        </div>

        

        <input id="upload-video" type="file" @change="videoChange" class="hidden" aria-label="Upload the video to the app" aria-hidden="true" accept="video/*" >

        
    </div>
</template>

<script>

import { useMainStore } from '../store/mainStore.js';
import { prepateAxiosErrorToDisplay } from '../functions/axios.js';
import { mapActions } from 'pinia';

export default {
    data() {
        return {
            mouseOver: false,
            fileData: [],
            error: '',
        };
    },

    mounted() {
        
        var _this = this;
        var upload_front = this.$refs.upload;
        
        if (typeof (window.FileReader)) {
            upload_front.addEventListener("dragenter", function (event) {
				event.stopPropagation();
				event.preventDefault();

                _this.mouseOver = true;
            });

            upload_front.addEventListener("dragover", function (event) {
				event.stopPropagation();
				event.preventDefault();

                _this.mouseOver = true;
            });
            
			upload_front.addEventListener ("dragleave", function (event){
				event.stopPropagation();
				event.preventDefault();

                _this.mouseOver = false;
            });
            
			upload_front.addEventListener ("drop", function (event){
                event.preventDefault();

                _this.mouseOver = false;
                _this.fileData = event.dataTransfer.files[0];

			});
		}
    },

    watch : {
        fileData : function (fileData) {
            if (this.validate)
                this.uploadVideo(fileData);
        }
    },

    methods : {

        saveChanges: function () {

        },

        validate: function () {
            
            if (typeof this.fileData != 'object')
                return false;

            return true;
        },

        videoChange: function (e) {
            
            if (e.target.value == '')
                return false;

            this.fileData = e.target.files[0];

        },

        uploadVideo: function (file) {

            let fd = new FormData();
            
            fd.append('file', file);

            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }

            this.error = '';
            var _this = this;

            axios.post('/api/upload/video', fd, config)
                .then(function (res) {
                    _this.saveChanges(res.data);
                })
                .catch(function (err) {
                    _this.handleTheResponseError(err);
                });
        },

        handleTheResponseError: function (res) {
            this.error = res.response.data.message;

            this.addNewPageNotification({
                message: prepateAxiosErrorToDisplay(res.response.data.message),
                type: 'error',
                autoDismiss: true,
            });
        }
    },
}
</script>