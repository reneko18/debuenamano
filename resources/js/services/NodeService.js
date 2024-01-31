import AdminView from '../views/AdminView.vue';

export const NodeService = {
    getTreeNodesData() {
        return [
            {
                key: '0',
                label: 'Usuarios',
                data: 'Documents Folder',
                icon: 'pi pi-fw pi-inbox',
                children: [
                    {
                        key: '0-0',
                        label: 'Ver Usuarios',
                        data: 'Work Folder',
                        icon: 'pi pi-fw pi-cog',
                    },
                    {
                        key: '0-1',
                        label: 'Crear',
                        data: 'Home Folder',
                        icon: 'pi pi-fw pi-home',  
                    },
                    {
                        key: '0-2',
                        label: 'Editar',
                        data: 'Home Folder',
                        icon: 'pi pi-fw pi-home',  
                    }
                ]
            },
            {
                key: '1',
                label: 'Productos',
                data: 'Events Folder',
                icon: 'pi pi-fw pi-calendar',
                children: [
                    { key: '1-0', label: 'Ver Productos', icon: 'pi pi-fw pi-calendar-plus', data: 'Meeting' },
                    { key: '1-1', label: 'Crear', icon: 'pi pi-fw pi-calendar-plus', data: 'Product Launch' },
                    { key: '1-2', label: 'Editar', icon: 'pi pi-fw pi-calendar-plus', data: 'Report Review' }
                ]
            },
            {
                key: '2',
                label: 'Posts',
                data: 'Movies Folder',
                icon: 'pi pi-fw pi-star-fill',
                children: [
                    {
                        key: '2-0',
                        icon: 'pi pi-fw pi-star-fill',
                        label: 'Ver Posts',
                        data: 'Pacino Movies',
                    },
                    {
                        key: '2-1',
                        label: 'Crear',
                        icon: 'pi pi-fw pi-star-fill',
                        data: 'De Niro Movies',
                    }
                ]
            },
            {
                key: '3',
                label: 'Ver Autores',
                data: 'Movies Folder',
                icon: 'pi pi-fw pi-star-fill',
                children: [
                    {
                        key: '3-0',
                        icon: 'pi pi-fw pi-star-fill',
                        label: 'Ver Posts',
                        data: 'Pacino Movies',
                    },
                ]
            },
            {
                key: '4',
                label: 'Categorias de post',
                data: 'Movies Folder',
                icon: 'pi pi-fw pi-star-fill',
                children: [
                    {
                        key: '4-0',
                        icon: 'pi pi-fw pi-star-fill',
                        label: 'Ver Categorias',
                        data: 'Pacino Movies',
                    },
                    {
                        key: '4-1',
                        label: 'Crear',
                        icon: 'pi pi-fw pi-star-fill',
                        data: 'De Niro Movies',
                    }
                ]
            },
            {
                key: '5',
                label: 'Estados de Productos',
                data: 'Estados de Productos',
                icon: 'pi pi-fw pi-star-fill',
                children: [
                    {
                        key: '5-0',
                        icon: 'pi pi-fw pi-star-fill',
                        label: 'Ver Estados',
                        data: 'Ver Estados',
                        component: AdminView,
                    },
                ]
            },
        ];
    },
    
    getTreeNodes() {
        return Promise.resolve(this.getTreeNodesData());
    }
};
