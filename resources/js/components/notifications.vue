<template lang="">
    <div class="fixed inset-0 bg-black/70 flex z-1024" v-if="notifications.length > 0">
        
        <div class="w-1/3 h-full flex flex-col items-start justify-end px-2 pl-5 py-5 space-y-4">
            <notificationItem @delete-page-notification="deletePageNotification" v-for="notification in notifications.filter((e) => {return ['left-bottom'].includes(e.position)})" :notification="notification"></notificationItem>
        </div>

        <div class="w-1/3 h-full flex flex-col items-center justify-start px-2 py-5 space-y-4">
            <notificationItem @delete-page-notification="deletePageNotification" v-for="notification in notifications.filter((e) => {return ['center-top'].includes(e.position)})" :notification="notification"></notificationItem>
        </div>
        
        <div class="w-1/3 h-full flex flex-col items-end justify-start px-2 pr-5 py-5 space-y-4">
            <notificationItem @delete-page-notification="deletePageNotification" v-for="notification in notifications.filter((e) => {return ['rigth-top'].includes(e.position)})" :notification="notification"></notificationItem>
        </div>
        
    </div>
</template>

<script>
import { mapActions, mapState } from 'pinia';
import { useMainStore } from '../store/mainStore';
import notificationItem from './Page/notificationItem.vue';

export default {
    components: {
        notificationItem,
    },

    computed: {
        ...mapState(useMainStore, ['notifications']),
    },

    data() {
        return {

        };
    },

    methods: {
        ...mapActions(useMainStore, ['deletePageNotification']),
    }
}
</script>