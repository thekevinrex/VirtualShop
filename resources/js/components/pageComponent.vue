<script>
import { mapActions, mapState } from 'pinia';
import { useMainStore } from '../store/mainStore';

export default {

    data() {
        return {
            prueba : '',
        };
    },

    watch: {
        
    },

    computed: {
        ...mapState(useMainStore, ['isSidebarOpen', 'isSidebarFixed']),
    },

    methods: {
        ...mapActions(useMainStore, ['updateSidebar', 'updateFixedSidebar']),

        toggleSidebar: function () {
            this.updateSidebar(!this.isSidebarOpen);
        },
        toggleSidebarFixed: function () {
            this.updateFixedSidebar(!this.isSidebarFixed);
        }
    },

    mounted() {
        console.log(this.isSidebarOpen);
    },

    render (){
        return this.$slots.default({
            'isSidebarOpen': this.isSidebarOpen,
            'isSidebarFixed': this.isSidebarFixed,
            'toggleSidebarFixed': this.toggleSidebarFixed,
            'toggleSidebar' : this.toggleSidebar,
        });
    }
    
}
</script>