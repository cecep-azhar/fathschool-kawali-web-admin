<template>
    <vue3-snackbar top right :duration="4000"></vue3-snackbar>
</template>

<script>
export default {
    watch: {
        toast: {
            deep: true,
            handler(val, oldVal) {
                if (val != undefined || val != null) {
                    this.showFlash(val);
                }
            },
        },
    },
    computed: {
        toast() {
            let value = this.$page.props.success ? this.$page.props.success : null;
            return value;
        },
    },
    methods: {
        showFlash(val) {
            this.$snackbar.add({
                type: 'success',
                text: val
            })
        }
    }
}
</script>

<style>

</style>
