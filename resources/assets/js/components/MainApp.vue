<template>
    <div id="main">
        <template v-if= false>
            <Header/>
        </template>

        <div class="wrapper">
            <SideBar></SideBar>
            <TopBar></TopBar>
        </div>
        
        <div class="content">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    import Header from './Header.vue';
    import SideBar from './admin/SideBarAdmin.vue';
    import TopBar from './admin/TopBarAdmin.vue';
    

    export default {
        name: 'main-app',
        components: {Header, SideBar, TopBar, }
    }
</script>
