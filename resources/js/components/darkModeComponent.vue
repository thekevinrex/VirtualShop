<template>
<div>
    <Switch
        v-model="enabled"
        :class="enabled ? 'bg-slate-700' : 'bg-gray-200'"
        class="relative inline-flex h-7 w-12 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75"
    >
        <span
            aria-hidden="true"
            :class="enabled ? 'translate-x-5 bg-slate-800 text-white' : 'translate-x-0'"
            class="pointer-events-none inline-block h-6 w-6 transform rounded-full bg-white shadow-lg ring-0 transition duration-200 ease-in-out"
        >
            <div class="w-6 h-6 flex items-center justify-center">
                <svg v-if="!enabled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                    <path d="M12 2.25a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM7.5 12a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM18.894 6.166a.75.75 0 00-1.06-1.06l-1.591 1.59a.75.75 0 101.06 1.061l1.591-1.59zM21.75 12a.75.75 0 01-.75.75h-2.25a.75.75 0 010-1.5H21a.75.75 0 01.75.75zM17.834 18.894a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 10-1.061 1.06l1.59 1.591zM12 18a.75.75 0 01.75.75V21a.75.75 0 01-1.5 0v-2.25A.75.75 0 0112 18zM7.758 17.303a.75.75 0 00-1.061-1.06l-1.591 1.59a.75.75 0 001.06 1.061l1.591-1.59zM6 12a.75.75 0 01-.75.75H3a.75.75 0 010-1.5h2.25A.75.75 0 016 12zM6.697 7.757a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 00-1.061 1.06l1.59 1.591z" />
                </svg>
                <svg v-if="enabled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                    <path fill-rule="evenodd" d="M9.528 1.718a.75.75 0 01.162.819A8.97 8.97 0 009 6a9 9 0 009 9 8.97 8.97 0 003.463-.69.75.75 0 01.981.98 10.503 10.503 0 01-9.694 6.46c-5.799 0-10.5-4.701-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 01.818.162z" clip-rule="evenodd" />
                </svg>
            </div>
        </span>
        
    </Switch>
</div>
</template>
  
<script>
import { Switch } from '@headlessui/vue';
import { useMainStore } from '../store/mainStore';
import { mapActions, mapState } from 'pinia';

export default {
    components: {
        Switch,
    },

    data() {
        return {
            enabled : false,
        };
    },
    mounted() {
        console.log(this.initialDarkMode);
        this.enabled = (this.initialDarkMode == 'dark')? true : false;
    },

    watch: {
        enabled: function (newValue) {
            this.updateTheme((newValue? 'dark' : 'ligth' ) );
        }
    },

    computed: {
        ...mapState(useMainStore, {
            initialDarkMode: 'theme',
        }),
    },  
    methods: {
        ...mapActions(useMainStore, ['updateTheme']),
    }
}
</script>
  