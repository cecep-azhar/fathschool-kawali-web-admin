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
        <div class="flex gap-2 px-4 pb-4">
            <global-button :loading="loading" type="submit" class="mr-2">
                {{ __('Save') }}
            </global-button>

            <Link preserve-scroll :href="route('settings.currency')">
                <global-button :loading="false" type="button" theme="outline-danger">
                    {{ __('Cancel') }}
                </global-button>
            </Link>
        </div>
    </form>
</template>

<script>
export default {
    props:{
        currency: Object,
    },
    data() {
        return {
            loading: false,
            form: this.$inertia.form({
                name: this.currency.name,
                code: this.currency.code,
                symbol: this.currency.symbol,
                rate: this.currency.rate,
            }),
        }
    },
    watch: {
        currency: {
            deep: true,
            handler(val) {
                this.form.name = val.name;
                this.form.code = val.code;
                this.form.symbol = val.symbol;
                this.form.rate = val.rate;
            },
        },
    },
    methods: {
        submit() {
            try {
                this.loading = true;
                this.form.put(route("settings.currency.update", this.currency.id), {
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
