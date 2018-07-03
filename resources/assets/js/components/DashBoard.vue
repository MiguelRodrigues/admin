<template>
  <div class="container"> 
     
        <div class="row justify-content-center">
                    <div class ="col-md-12" style ="text-align: center;">
                      DASHBOARD
                    </div>
        </div>

      <p>
        <button @click="showCustomers">Clientes</button>
      </p>

        <template v-if="mostra">
              <CostumersList></CostumersList>
        </template>
    </div>
</template>

<script>
import CostumersList from './customers/List.vue';;
export default {
  
      name: 'DashBoard2',
      components: {CostumersList},
      data() {
        
        return { 
		      	mostra: this.$store.getters.componentOpen 
			      }
	  	},

      methods:{
        
        showCustomers(){
          this.$store.dispatch('toogleComponent');
          this.mostra = this.$store.getters.componentOpen;
          }
        }
}
</script>