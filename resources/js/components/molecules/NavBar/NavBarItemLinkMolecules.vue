<template>
    <NavBarItemAtom>
        <NavBarLinkAtom
            :href="href"
            :active="active"
            :disabled="disabled"
        >
            <slot></slot>
        </NavBarLinkAtom>
    </NavBarItemAtom>
</template>

<script setup>
import NavBarItemAtom from '../../atoms/NavBar/NavBarItemAtom.vue';
import NavBarLinkAtom from '../../atoms/NavBar/NavBarLinkAtom.vue';
const props = defineProps({
    href: String,
    active: Boolean,
    disabled: Boolean
})
</script>
