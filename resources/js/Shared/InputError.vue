<template>
    <div class="text-red-500" v-if="error">
        {{ error }}
    </div>
</template>

<script>
export default {
    props: {
        error: String
    }
}
</script>

<style>

</style>
