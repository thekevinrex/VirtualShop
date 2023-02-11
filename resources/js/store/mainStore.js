import { defineStore } from "pinia";

export const useMainStore = defineStore('MainStore',{
    state : () => {
        return {
            sideBarOpen : false,
            msg : 'Kevin',
        }
    },
    getters : {
        isSidebarOpen : function () {
            return this.isSidebarOpen;
        }
    },
    actions : {
        act : function () {
            alert ("sada");
        }
    },
});
