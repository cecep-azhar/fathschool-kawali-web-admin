<template>
</template>

<script>
export default {
    watch: {
        wToast: {
            deep: true,
            handler(val, oldVal) {
                if (val != undefined || val != null) {
                    this.showFlash(val);
                }
            },
        },
    },
    computed: {
        wToast() {
            let value = this.$page.props.warning ? this.$page.props.warning : null;
            return value;
        },
    },
    methods: {
        showFlash(val) {
            this.$snackbar.add({
                type: 'warning',
                text: val
            })
        }
    }
}
</script>

<style>

</style>
