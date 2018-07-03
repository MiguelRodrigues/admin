<template>
    <div class="customer-new">
        <form @submit.prevent="edit">
            <table class="table">
                <tr>
                    <th>Nome</th>
                    <td>
                        <input type="text" class="form-control" v-model="customer.name" placeholder="Customer Name"/>
                    </td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>
                        <input type="email" class="form-control" v-model="customer.email" placeholder="Customer Email"/>
                    </td>
                </tr>
                <tr>
                    <th>Telemovel</th>
                    <td>
                        <input type="text" class="form-control" v-model="customer.phone" />
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
        name: 'new',
        created() {
                if (this.customers.length) {
                this.customer = this.customers.find((customer) => customer.id == this.$route.params.id);
                }
                axios.get(`/api/customers/${this.$route.params.id}`)
                    .then((response) => {
                        this.customer = response.data.customer
                });   
        },
        data() {
            return {
                customer: {
                    name: '',
                    email: '',
                    phone: '',
                },
                errors: null
            };
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser;
            },
            customers() {
                return this.$store.getters.customers;
            }
        },
        methods: {
            
            edit() {
                this.errors = null;
                const constraints = this.getConstraints();
                const errors = validate(this.$data.customer, constraints);
                if(errors) {
                    this.errors = errors;
                    return;
                }
                axios.post(`/api/customers/edit/${this.$route.params.id}`, this.$data.customer,this.$route.params.id)
                    .then((response) => {
                        this.$store.dispatch('getCustomers');
                        this.$router.push('/listar-clientes');
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
                    phone: {
                        presence: true,
                        numericality: true,
                        length: {
                            minimum: 9,
                            message: 'Tem de ter no minimo 9 digitos'
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