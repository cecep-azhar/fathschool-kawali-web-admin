<template>
    <div>
        <SettingSidebar/>
        <slot/>
    </div>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import SettingSidebar from '@/Layouts/Sidebar/SettingSidebar.vue'

export default {
    components: {
        AppLayout,
        SettingSidebar
    }
}
</script>
