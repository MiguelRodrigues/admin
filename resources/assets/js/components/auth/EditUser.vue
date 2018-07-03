<template>
    <div class="customer-new">
        <form @submit.prevent="edit">
            <table class="table">
                <tr>
                    <th>Nome</th>
                    <td>
                        <input type="text" class="form-control" v-model="user.name" placeholder="User Name"/>
                    </td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>
                        <input type="email" class="form-control" v-model="user.email" placeholder="User Email"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <router-link to="/listar-clientes" class="btn">Cancelar</router-link>
                    </td>
                    <td class="text-right">
                        <input type="submit" value="Editar" class="btn btn-primary">
                    </td>
                </tr>
            </table>
        </form>
        <div class="errors" v-if="errors">
            <ul>
                <li v-for="(fieldsError, fieldName) in errors" :key="fieldName">
                    <strong>{{ fieldName }}</strong> {{ fieldsError.join('\n') }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import validate from 'validate.js';
    export default {
        created() {
                if (this.users.length) {
                    console.log("OLA")
                this.user = this.users.find((user) => user.id == this.$route.params.id);
                }  
        },
        data() {
            return {
                user: {
                    name: '',
                    email: '',
                },
                errors: null
            };
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser;
            },
            users() {
                return this.$store.getters.users;
            }
        },
        methods: {
            
            edit() {
                this.errors = null;
                const constraints = this.getConstraints();
                const errors = validate(this.$data.user, constraints);
                if(errors) {
                    this.errors = errors;
                    return;
                }
                axios.post(`/api/users/edit/${this.$route.params.id}`, this.$data.user,this.$route.params.id)
                    .then((response) => {
                        this.$store.dispatch('getUsers');
                        this.$router.push('/listar-utilizadores');
                    });
            },
            getConstraints() {
                return {
                    name: {
                        presence: true,
                        length: {
                            minimum: 3,
                            message: 'Tem de ter pelo menos 3 caracteres'
                        }
                    },
                    email: {
                        presence: true,
                        email: true
                    },
                };
            }
        }
    }
</script>

<style>
.errors {
    background: lightcoral;
    border-radius:5px;
    padding: 21px 0 2px 0;
}
</style>