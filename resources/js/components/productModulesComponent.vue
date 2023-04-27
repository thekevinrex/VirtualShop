<script>

import { v4 as uuidv4 } from 'uuid';
import { prepateAxiosErrorToDisplay } from '../functions/axios.js';

export default {

    props : ['modulesData', 'modulesInfo'],

    data() {
        return {
            modules: [],
            editModule: '',
        }
    },

    mounted() {

        var _this = this;
        this.$splade.on('add-new-module', function (module) {
            _this.addNewModule(module.type);
        });

        if (this.modulesInfo.length > 0) {
            for (let i in this.modulesInfo) {

                let module = this.modulesInfo[i];
                let moduleData = {
                    key: uuidv4(),
                    id: module.id,
                    order: module.order,
                    type: module.type,
                };

                if (module.title != null) {
                    moduleData.title = module.title;
                }

                if (module.des != null) {
                    moduleData.des = module.des;
                }

                if (module.image != null) {
                    moduleData.image = module.image;
                }

                this.modules.push(moduleData);
            }

            this.modules = this.modules.sort((a, b) => { return (a.order >= b.order? 1 : -1) });
        }

    },

    methods: {

        addNewModule: function (module) {

            if (!Object.keys(this.modulesData).includes(module)) {
                return false;
            }

            let moduleData = {
                key: uuidv4(),
                type: module,
                order: this.modules.length + 1,
            };

            if (this.modulesData[module].includes('title')) {
                moduleData.title = 'module ' + moduleData.order;
            }

            if (this.modulesData[module].includes('des')) {
                moduleData.des = '';
            }

            if (this.modulesData[module].includes('left-image') || this.modulesData[module].includes('right-image')) {
                moduleData.image = '';
            }

            this.modules = [
                ...this.modules,
                moduleData,
            ];

            this.editModule = moduleData.key;
            this.modules = this.modules.sort((a, b) => { return (a.order >= b.order? 1 : -1) });
        },

        setEditModule: function (key) {
            this.editModule = key;
        },

        deleteModule: function (key) {

            let module = this.modules.find(e => { return e.key == key });

            this.modules = this.modules.filter(e => { return e.key != key });

            this.modules.filter(e => { return e.order > module.order }).map(e => { e.order = e.order - 1; return e; });
            
        },

        orderModule: function (where, key) {

            let module = this.modules.find(e => { return e.key == key });
            
            if (where == 'up') {
                let moduleMove = this.modules.find(e => { return e.order == module.order - 1 });

                if (moduleMove != null) {
                    moduleMove.order = moduleMove.order + 1;
                    module.order = module.order - 1;
                }
            } else {

                let moduleMove = this.modules.find(e => { return e.order == module.order + 1 });

                if (moduleMove != null) {
                    moduleMove.order = moduleMove.order - 1;
                    module.order = module.order + 1;
                }
            }

            this.modules = this.modules.sort((a, b) => { return (a.order >= b.order? 1 : -1) });
        },

        handleSubmit: function (form) {
            form.$put('modules', this.modules);
            form.submit();
        }
    },

    render (){
        return this.$slots.default({
            'modules': this.modules,
            'isEditModule': this.editModule,
            'editModule': this.setEditModule,
            'deleteModule': this.deleteModule,
            'orderModule': this.orderModule,
            'handleSubmit' : this.handleSubmit,
        });
    }
}
</script>