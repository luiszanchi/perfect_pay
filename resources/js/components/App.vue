<template>
    <div>
        <NavBar class="navbar"></NavBar>
        <router-view />
    </div>
</template>

<script setup>
import NavBar from './templates/NavBar/NavBar.vue';
</script>

<style scoped>
.navbar {
    margin-top: 10px;
    margin-bottom: 10px;
}
</style>
