<template>
    <form @submit.prevent="submit">
        <div class="w-full p-4 dark:bg-gray-800 dark:border-gray-700">
            <div >
                <global-label for="name" value="Name" :required="false" />
                <global-input type="text" id="name" v-model="form.name" name="name"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                    :placeholder="__('Name')" :error="$page.props.errors.name" />
                <input-error :error="$page.props.errors.name" />
            </div>
        </div>
        <global-button :loading="loading" type="submit"
            class="text-white bg-blue-500 dark:bg-blue-500  hover:bg-blue-500 active:bg-blue-600 dark:active:bg-blue-600 focus:border-blue-600 dark:focus:border-blue-600 focus:ring focus:ring-blue-300 rtl:ml-0 rtl:mr-5 ml-5 mb-6 dark:focus:ring-blue-300">
            {{ __('Save') }}
        </global-button>
        <br>
    </form>
</template>

<script>
export default {
    data() {
        return {
            loading: false,
            form: {
                name: ''
            }
        }
    },
    methods: {
        submit() {
            this.loading = true;
            this.$inertia.post(this.route('departments.store'), this.form, {
                onSuccess: () => {
                    this.form.name = ''
                },
                onFinish: visit => { this.loading = false },
            })
        }
    }
}
</script>

<style>

</style>
