<template>
    <div class="customer-new">
        <form @submit.prevent="register">
            CRIA USERS
            <table class="table">
                <tr>
                    <th>Nome</th>
                    <td>
                        <input type="text" class="form-control" v-model="user.name" />
                    </td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>
                        <input type="email" class="form-control" v-model="user.email" />
                    </td>
                </tr>
                <tr>
                    <th>Password</th>
                    <td>
                        <input type="password" class="form-control" v-model="user.password"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <router-link to="/dashboard" class="btn">Cancel</router-link>
                    </td>
                    <td class="text-right">
                        <input type="submit" value="Create" class="btn btn-primary">
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
        name: 'new',
        data() {
            return {
                user: {
                    name: '',
                    email: '',
                    password: '',
                },
                errors: null
            };
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser;
            }
        },
        methods: {
            register() {
                this.errors = null;
                const constraints = this.getConstraints();
                const errors = validate(this.$data.user, constraints);
                if(errors) {
                    this.errors = errors;
                    return;
                }
                axios.post('/api/register', this.$data.user)
                    .then((response) => {
                        this.$router.push('/dashboard');
                    });
            },
            getConstraints() {
                return {
                    name: {
                        presence: true,
                        length: {
                            minimum: 3,
                            message: 'O nome tem de ter pelo menos 3 letras'
                        }
                    },
                    email: {
                        presence: true,
                        email: true
                    },
                    password: {
                        presence: true,
                        length: {
                            minimum: 6,
                            message: 'A password tem de ter pelo menos 6 caracteres'
                        }
                    }
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