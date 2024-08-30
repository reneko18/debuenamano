import AdminView from '../views/AdminView.vue';
import PostAdminTable from '../components/Post/PostAdminTable.vue';
import CreatePost from '../components/Post/CreatePost.vue';
import CreateAuthor from '../components/Post/CreateAuthor.vue'
import AuthorAdminTable from '../components/Post/AuthorAdminTable.vue'
import CategoriesAdminTable from '../components/Post/CategoriesAdminTable.vue'
import CreateCategory from '../components/Post/CreateCategory.vue'

export const NodeService = {
    getTreeNodesData() {
        return [
            {
                key: '0',
                label: 'Usuarios',     
                icon: 'pi pi-fw pi-inbox',
                children: [
                    {
                        key: '0-0',
                        label: 'Ver Usuarios',              
                        icon: 'pi pi-fw pi-cog',
                    },
                    {
                        key: '0-1',
                        label: 'Crear Usuario',                       
                        icon: 'pi pi-fw pi-home',  
                    },
                    {
                        key: '0-2',
                        label: 'Editar Usuario',            
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
                    { key: '1-0', label: 'Ver Productos', icon: 'pi pi-fw pi-calendar-plus' },
                    { key: '1-1', label: 'Crear Producto', icon: 'pi pi-fw pi-calendar-plus' },
                    { key: '1-2', label: 'Editar Producto', icon: 'pi pi-fw pi-calendar-plus' },
                    { key: '1-3', label: 'Estados de Producto', icon: 'pi pi-fw pi-calendar-plus', component: AdminView},
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
                        component: PostAdminTable,
                    },
                    {
                        key: '2-1',
                        label: 'Crear Post',
                        icon: 'pi pi-fw pi-star-fill',                 
                        component: CreatePost,
                    },
                    {
                        key: '2-2',
                        label: 'Ver Autores',
                        icon: 'pi pi-fw pi-star-fill',
                        component: AuthorAdminTable,               
                    },
                    {
                        key: '2-3',
                        label: 'Crear Autor',
                        icon: 'pi pi-fw pi-star-fill',
                        component: CreateAuthor,              
                    },
                    {
                        key: '2-4',
                        icon: 'pi pi-fw pi-star-fill',
                        label: 'Ver Categorias',  
                        component: CategoriesAdminTable,           
                    },
                    {
                        key: '2-5',
                        icon: 'pi pi-fw pi-star-fill',
                        label: 'Crear Categoria', 
                        component: CreateCategory,             
                    },
                ]
            },
            {
                key: '3',
                label: 'Cerrar sesión', 
                icon: 'pi pi-fw pi-sign-out',
                isLogout: true
            },
        ];
    },
    
    getTreeNodes() {
        return Promise.resolve(this.getTreeNodesData());
    },

    logout() {
        return axios.post('/logout'); // Assuming this is your logout route in Laravel
    }
};
