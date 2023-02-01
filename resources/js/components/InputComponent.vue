<template lang="">
    <div class="border-1 border-gray-300 rounded-sm flex">
        <div>

        </div>
    </div>
</template>

<script>

import {useMainStore} from '../store/mainStore'
import { mapActions, mapState } from 'pinia';

export default {
    data () {
        return {
            hola : 'sda',
        }
    },
    computed : {
        ...mapState(useMainStore, ['msg', 'isSidebarOpen'])
    },
    methods : {
        ...mapActions(useMainStore, ['act']),
    }
}
</script>
