import { defineStore } from "pinia";
import { v4 as uuidv4 } from 'uuid';

let theme = document.head.querySelector('meta[name="app-theme"]');

export const useMainStore = defineStore('MainStore',{
    state : () => {
        return {
            sideBarOpen: ( localStorage.sideBarOpen != undefined? localStorage.sideBarOpen == 'true' : true),
            sideBarFixed: ( localStorage.sideBarFixed != undefined? localStorage.sideBarFixed == 'true' : true),
            theme : ( !localStorage.theme? theme.attributes.content.value : localStorage.theme),
            msg: 'Kevin',
            notifications : [],
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
            localStorage.theme = value;
            this.setTheme();
        },

        setTheme: function () {
            if (this.theme == 'dark') {
                document.documentElement.classList.add('dark')
            } else {
                document.documentElement.classList.remove('dark')
            }
        },

        addNewPageNotification: function (notification) {
            
            let id = uuidv4();
            let _this = this;
            let timeout = undefined;
            if (notification.autoDismiss) {
                timeout = setTimeout(function () {
                    _this.deletePageNotification(id);
                }, (1000 * (notification.timeout ? notification.timeout : 5)));
            }

            if (!notification.position) {
                notification.position = 'left-bottom';
            }

            this.notifications.push({
                ...notification,
                id: id,
                timeout : timeout,
            });

        },

        deletePageNotification: function (id) {
            clearTimeout(this.notifications.find((e) => { return e.id == id }).timeout);
            this.notifications = this.notifications.filter((e) => { return e.id != id });
        },

    },
});
