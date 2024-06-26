<template>
    <footer class="text-center">
        Templatecookie.com © {{ getDateYear() }} Created by <a href="https://templatecookie.com" target="_blank">Templatecookie</a>
    </footer>
</template>

<script>
export default {
    methods: {
        getDateYear() {
            const date = new Date();
            return date.getFullYear();
        }
    }
}
</script>
