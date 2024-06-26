<template>
    <form @submit.prevent="submit">
        <div class="w-full px-4 pb-4">
            <div class="mb-2">
                <global-label for="name" value="Name" :required="false" />
                <global-input type="text" id="name" v-model="form.name"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                    :placeholder="__('Name')" :error="$page.props.errors.name" />
                <input-error :error="$page.props.errors.name" />
            </div>
            <div class="my-2">
                <global-label for="code" value="Code" :required="false" />
                <global-input type="text" id="code" v-model="form.code"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                    :placeholder="__('Code')" :error="$page.props.errors.code" />
                <input-error :error="$page.props.errors.code" />
            </div>
            <div class="my-2">
                <global-label for="symbol" :value="__('Symbol')" :required="false" />
                <global-input type="text" id="symbol" v-model="form.symbol"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                    :placeholder="__('Symbol')" :error="$page.props.errors.symbol" />
                <input-error :error="$page.props.errors.symbol" />
            </div>
            <div class="my-2">
                <global-label for="rate" :value="__('Rate')" :required="false" />
                <global-input type="text" id="rate" v-model="form.rate"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                    :placeholder="__('Rate')" :error="$page.props.errors.rate" />
                <input-error :error="$page.props.errors.rate" />
            </div>
        </div>
        <global-button :loading="loading" type="submit"
            class="text-white bg-blue-500 dark:bg-blue-500  hover:bg-blue-500 active:bg-blue-600 dark:active:bg-blue-600 focus:border-blue-600 dark:focus:border-blue-600 focus:ring focus:ring-blue-300 ml-5 mb-6 dark:focus:ring-blue-300">
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
            form: this.$inertia.form({
                name: "",
                code: "",
                symbol: "",
                rate: "",
            }),
        }
    },
    methods: {
        submit() {
            try {
                this.loading = true;
                this.form.post(route("settings.currency.store"), {
                    onSuccess: () => {
                        this.form.reset(),
                        this.loading = false
                    },
                    onError: () => {
                        this.loading = false
                    },
                });
            } catch (error) {
                this.loading = false;
            }
        },
    }
}
</script>
