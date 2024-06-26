<template>
    <form @submit.prevent="submit">
        <div class="w-full b p-4 dark:border-gray-700">
            <div>
                <global-label for="income" :value="__('Select type')" :required="false" />
                <div class="flex xl:flex-row lg:flex-col sm:flex-row flex-col gap-6">
                    <div class="w-full rounded-lg flex gap-2 items-center pl-4 border border-gray-200 dark:border-gray-700">
                        <input value="income" id="income" v-model="form.type" type="radio" name="badge"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:text-gray-400 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                        <global-label for="income"
                            class="py-2 w-full mt-1 text-sm font-medium text-gray-900 dark:text-gray-300" value="Income"
                            :required="false" />
                    </div>
                    <div class="w-full rounded-lg flex gap-2 items-center pl-4 border border-gray-200 dark:border-gray-700">
                        <input value="expense" id="expense" type="radio" v-model="form.type" name="badge"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                        <global-label for="expense"
                            class="py-2 w-full mt-1 text-sm font-medium text-gray-900 dark:text-gray-300" value="Expense"
                            :required="false" />
                    </div>
                </div>
                <input-error :error="$page.props.errors.type" />
            </div>
            <div class="mt-3">
                <global-label for="name" value="Name" :required="false" />
                <global-input type="text" id="name" v-model="form.name" name="name"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                    :placeholder="__('Name')" :error="$page.props.errors.name" />
                <input-error :error="$page.props.errors.name" />
            </div>
        </div>
        <global-button :loading="form.processing" type="submit"
            class="text-white bg-blue-500 dark:bg-blue-500  hover:bg-blue-500 active:bg-blue-600 dark:active:bg-blue-600 focus:border-blue-600 dark:focus:border-blue-600 focus:ring focus:ring-blue-300 ml-5 mb-4 dark:focus:ring-blue-300">
            {{ __('Save') }}
        </global-button>
    </form>
</template>

<script>
import { useForm } from '@inertiajs/inertia-vue3'

export default {
    props: {
        data: Object,
        update_value: Boolean,
    },
    data() {
        return {
            form: useForm({
                name: this.data.name,
                type: this.data.type ?? 'income',
                _method: "",
            }),
        };
    },
    watch: {
        data: {
            deep: true,
            handler(val, oldVal) {
                this.form.name = val.name;
                this.form.type = val.type;
            },
        },
        update_value: {
            deep: true,
            handler(val, oldVal) {
                this.form._method = val ? "PUT" : "POST";
            },
        },
    },
    methods: {
        submit() {
            if (this.update_value) {
                this.form.post(
                    this.route("transaction-type.update", this.data.id),
                    {
                        onSuccess: () => {
                            this.form.reset('name', 'type');
                            this.$emit("update");
                        },
                    }
                );
            } else {
                this.form.post(this.route("transaction-type.store"), {
                    onSuccess: () => {
                        this.form.reset('name', 'type');
                        this.$emit("update");
                    },
                });
            }
        },
    },
};
</script>
