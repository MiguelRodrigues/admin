<template>
    <div>
        <div class="btn-wrapper">
            <router-link to="/customers/new" class="btn btn-primary btn-sm">New</router-link>
        </div>
        <table class="table">
            <thead>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </thead>
            <tbody>
                <template v-if="!customers.length">
                    <tr>
                        <td colspan="4" class="text-center">No Customers Available</td>
                    </tr>
                </template>
                <template v-else>
                    <tr v-for="customer in customers" :key="customer.id">
                        <td>{{ customer.name }}</td>
                        <td>{{ customer.email }}</td>
                        <td>{{ customer.phone }}</td>
                        <td>
                            <router-link :to="`/customers/${customer.id}`">Ver</router-link>
                        </td>
                        <td>
                            <router-link :to="`/customers/edit/${customer.id}`">Editar</router-link>
                        </td>
                        <td>
                           <button @click="apagar(customer.id)" class="btn btn-danger">Apagar</button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: 'list',
        data() {
            return {
                customer: {
                    id:'',
                }
            };
        },
        mounted() {
            if (this.customers.length) {
                return;
            }
            this.$store.dispatch('getCustomers');
        },
        computed: {
            customers() {
                return this.$store.getters.customers;
            }
        },
        methods:{
            apagar($customerId){
               //validações em falta
               axios.post(`/api/customers/delete/${$customerId}`,$customerId)
                    .then((response) => {
                        this.$store.dispatch('getCustomers');
                        this.$router.push('/dashboard');
                    });
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