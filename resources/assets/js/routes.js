import Home from './components/Home.vue';
import MainApp from './components/MainApp.vue';
//Auth routes
import Login from './components/auth/Login.vue';
import Register from './components/auth/Register.vue';
import UsersList from './components/auth/ListUsers.vue';
import User from './components/auth/ViewUser.vue';


import CustomersMain from './components/customers/Main.vue';
import CustomersList from './components/customers/List.vue';
import NewCustomer from './components/customers/New.vue';
import EditCustomer from './components/customers/Edit.vue';
import Customer from './components/customers/View.vue';


export const routes=[
    {
        path: '/',
        component: Home,
    },
    {
        path:'/login', 
        component: Login
    },
    // {
    //     path:'/dashboard', 
    //     component: CustomersList,
    //     meta: {
    //         requiresAuth:true
    //     }
    // },
        {
        path:'/listar-clientes', 
        component: CustomersList,
        meta: {
            requiresAuth:true
        }
    },
    {
        path:'/registar-utilizador', 
        component: Register,
        meta: {
            requiresAuth:true
        }
    },
    {
        path:'/listar-utilizadores', 
        component: UsersList,
        meta: {
            requiresAuth:true
        }
    },
    {
        path:'/ver-utilizador/:id', 
        component: User,
        meta: {
            requiresAuth:true
        }
    },
    {
        path: '/customers',
        component: CustomersMain,
        meta: {
            requiresAuth: true
        },
        children: [
            {
                path: '/',
                component: CustomersList
            },
            {
                path: 'new',
                component: NewCustomer
            },
            {
                path: ':id',
                component: Customer
            },
            {
                path: 'edit/:id',
                component: EditCustomer
            }
            
        ]
    }
    

];