<template>
    <nav class="nav justify-content-center nav-pills">
        <NavBarItemLinkMolecules
            href="#"
            :active="true"
            :disabled="false"
        >
            Home
        </NavBarItemLinkMolecules>

        <NavBarItemLinkMolecules
            href="#"
            :active="false"
            :disabled="true"
        >
            About
        </NavBarItemLinkMolecules>
    </nav>
</template>

<script setup>
import NavBarItemLinkMolecules from '../../molecules/NavBar/NavBarItemLinkMolecules.vue';
</script>
