<template>
    <div>
        <Sidebar/>
        <router-view></router-view>
    </div>
</template>

<script>
    import Sidebar from "./Sidebar";
    export default {
        components: {
            Sidebar
        }
    }
</script>

<style>

</style>
