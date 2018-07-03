<template>
    <div id="main">
        <template v-if="!currentUser">
            <Header/>
            <!-- MAIN CONTENT -->
            <router-view></router-view>
        </template>

        <template v-else>
            <div class="wrapper">
                <SideBar></SideBar>

                <!-- Page Content  -->
                <div id="content">
                    <TopBar></TopBar>

                    <!-- MAIN CONTENT -->
                    <router-view></router-view>

                </div>
                <!-- FIM Page Content  -->


            </div>
        </template>
        
        <!-- <div class="content"> -->
            
        <!-- </div> -->

    </div>
</template>

<script>
    import Header from './Header.vue';
    import SideBar from './admin/SideBarAdmin.vue';
    import TopBar from './admin/TopBarAdmin.vue';
    

    export default {
        name: 'MainApp',
        components: {Header, SideBar, TopBar },

        computed: {
            currentUser() {
                return this.$store.getters.currentUser
            }
        }
    }
</script>
