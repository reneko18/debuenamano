import AdminView from '../views/AdminView.vue';
import PostAdminTable from '../components/Post/PostAdminTable.vue';
import CreatePost from '../components/Post/CreatePost.vue';

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
                        label: 'Crear Usuario',
                        data: 'Home Folder',
                        icon: 'pi pi-fw pi-home',  
                    },
                    {
                        key: '0-2',
                        label: 'Editar Usuario',
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
                    { key: '1-1', label: 'Crear Producto', icon: 'pi pi-fw pi-calendar-plus', data: 'Product Launch' },
                    { key: '1-2', label: 'Editar Producto', icon: 'pi pi-fw pi-calendar-plus', data: 'Report Review' },
                    { key: '1-3', label: 'Estados de Producto', icon: 'pi pi-fw pi-calendar-plus', data: 'Estados de Producto' , component: AdminView},
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
                        component: PostAdminTable,
                    },
                    {
                        key: '2-1',
                        label: 'Crear Post',
                        icon: 'pi pi-fw pi-star-fill',
                        data: 'De Niro Movies',
                        component: CreatePost,
                    },
                    {
                        key: '2-2',
                        label: 'Ver Autores',
                        icon: 'pi pi-fw pi-star-fill',
                        data: 'De Niro Movies',
                    },
                    {
                        key: '2-3',
                        icon: 'pi pi-fw pi-star-fill',
                        label: 'Ver Categorias',
                        data: 'Pacino Movies',
                    },
                    {
                        key: '2-3',
                        icon: 'pi pi-fw pi-star-fill',
                        label: 'Crear Categoria',
                        data: 'Pacino Movies',
                    },
                ]
            },
        ];
    },
    
    getTreeNodes() {
        return Promise.resolve(this.getTreeNodesData());
    }
};
