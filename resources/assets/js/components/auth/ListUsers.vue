<template>
    <div>
        <div class="btn-wrapper">
            <router-link to="/registar-utilizador" class="btn btn-primary btn-sm">Novo Utilizador</router-link>
        </div>
        <table class="table">
            <thead>
                <th>Nome</th>
                <th>Email</th>
                <th></th>
                <th></th>
                <th></th>


            </thead>
            <tbody>
                <template v-if="!users.length">
                    <tr>
                        <td colspan="4" class="text-center">Sem utilizadores</td>
                    </tr>
                </template>
                <template v-else>
                    <tr v-for="user in users" :key="user.id">
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td>
                            <router-link :to="`/ver-utilizador/${user.id}`" class="btn btn-success">Ver</router-link>
                        </td>
                        <td>
                            <router-link :to="`/ver-utilizador/edit/${user.id}`" class="btn btn-success">Editar</router-link>
                        </td>
                        <td>
                           <button @click="apagar()" class="btn btn-danger">Apagar</button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: 'userList',
        data() {
            return {
                user: {
                    id:'',
                    name:'',
                    email:'',
                   
                }
            };
        },
        mounted() {
            if (this.users.length) {
                return;
            }
            this.$store.dispatch('getUsers');
        },
        computed: {
            users() {
                return this.$store.getters.users;
            }
        },
        methods:{
            apagar(){
            }
        }
    }
</script>

<style scoped>
.btn-wrapper {
    text-align: right;
    margin-bottom: 20px;
}
</style>