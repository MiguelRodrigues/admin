<template>
  <div class="container">
      <!-- <header/> -->
      <div class="row justify-content-center">
                    <div class ="col-md-12" style ="text-align: center;">
                         <img src= "img/honey.png" >
                        <h2>{{ title }}</h2>
                        <h3>Home.vue</h3>
                    </div>
      </div>
      <div>
        <button @click="redirectLogin">Login</button>
      </div>

  </div>
</template>


<script>
    import Header from './Header.vue';
    import SideBar from './admin/SideBarAdmin.vue';
    import TopBar from './admin/TopBarAdmin.vue';
export default {

      components: {
          Header, 
          SideBar, 
          TopBar 
          },
      name: 'home',
      computed: {
            title() {
                return this.$store.getters.title;
            }
        },
        methods: {
            redirectLogin(){
                this.$router.push({path: '/login'});
            }
        }
  }
</script>