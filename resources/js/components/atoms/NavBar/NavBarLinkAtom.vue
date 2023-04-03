<template>
    <a
        class="nav-link"
        :class="{
            active: active,
            disabled: disabled
        }"
        aria-current="page"
        :href="href"
    >
        <slot></slot>
    </a>
</template>

<script setup>
const props = defineProps({
    href: String,
    active: Boolean,
    disabled: Boolean
})
</script>
