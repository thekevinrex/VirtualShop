<template>
    <div :key="notification.id" class="p-4 pointer-events-auto border-l-4 shadow-md min-w-[240px] flex z-10" :class="[getNotificationType()]">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            </div>
            <div class="ml-3 break-words">
                <h3 class="text-sm font-medium" v-html="getNotificationMessage()"></h3>
            </div>
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button type="button" class="inline-flex rounded-md p-1.5 focus:outline-none focus:ring-2 focus:ring-offset-2" :class="getButtonColor()">
                        <span class="sr-only">Dismiss Notification</span>
                        <svg @click="deletePageNotification()" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        notification: Object,
    },

    emits: ['deletePageNotification'],

    methods: {
        getNotificationMessage: function () {
            if (Array.isArray(this.notification.message)) {
                return this.notification.message.flat().map((e) => { return e + "<br>" });
            } else {
                return this.notification.message;
            }
        },

        getNotificationType: function () {
            return (!this.notification.type || this.notification.type == 'success')
                ? 'bg-green-50 border-green-400 text-green-800 fill-green-400'
                : 'bg-red-50 border-red-400 text-red-800 fill-red-400';
        },

        getButtonColor: function () {
            return (!this.notification.type || this.notification.type == 'success')
                ? 'bg-green-50 text-green-500 hover:bg-green-100 focus:ring-offset-green-50 focus:ring-green-600'
                : 'bg-red-50 text-red-500 hover:bg-red-100 focus:ring-offset-red-50 focus:ring-red-600';
        },

        deletePageNotification: function () {
            this.$emit('deletePageNotification', this.notification.id);
        }
    }
}
</script>