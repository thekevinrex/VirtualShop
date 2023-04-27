<script>
export default {
    data() {
        return {

        };
    },

    methods: {
        addNewModule(type, close) {
            this.$splade.emit('add-new-module', { 'type': type });

            if (typeof close == 'function')
                close();
        }
    },

    render() {
        return this.$slots.default({
            'addModule' : this.addNewModule,
        });
    }
}
</script>