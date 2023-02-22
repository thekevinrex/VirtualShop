import { defineStore } from "pinia";

let theme = document.head.querySelector('meta[name="app-theme"]');

export const useMainStore = defineStore('MainStore',{
    state : () => {
        return {
            sideBarOpen: ( localStorage.sideBarOpen != undefined? localStorage.sideBarOpen == 'true' : true),
            sideBarFixed: ( localStorage.sideBarFixed != undefined? localStorage.sideBarFixed == 'true' : true),
            theme : theme.attributes.content.value,
            msg : 'Kevin',
        }
    },
    getters : {
        isSidebarOpen : function () {
            return this.sideBarOpen;
        },
        isSidebarFixed: function () {
            return this.sideBarFixed;
        }
    },
    actions: {
        
        updateSidebar: function (value) {
            this.sideBarOpen = value;

            localStorage.sideBarOpen = value;
        },
        
        updateFixedSidebar: function (value) {
            this.sideBarFixed = value;

            localStorage.sideBarFixed = value;
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
