import { defineStore } from "pinia";

let theme = document.head.querySelector('meta[name="app-theme"]');

export const useMainStore = defineStore('MainStore',{
    state : () => {
        return {
            sideBarOpen: false,
            theme : theme.attributes.content.value,
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
        },
        updateTheme: function (value) {
            this.theme = value;

            this.setTheme();
        },

        setTheme: function () {
            if (this.theme == 'dark') {
                document.documentElement.classList.add('dark')
            } else {
                document.documentElement.classList.remove('dark')
            }
        } 

    },
});
