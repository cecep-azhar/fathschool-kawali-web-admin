<template>
    <form @submit.prevent="submit">
        <div class="w-full b p-4 dark:border-gray-700">
            <div>
                <global-label for="income" :value="__('Select Role Type')" :required="false" />
                <div class="flex gap-6">
                    <div class="w-full rounded-lg flex items-center pl-4 border border-gray-200 dark:border-gray-700">
                        <input value="student" checked id="student" v-model="form.role_type" type="radio" name="role_type"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:text-gray-400 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                        <global-label for="student"
                            class="py-2 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300" value="Student"
                            :required="false" />
                    </div>
                    <div class="w-full rounded-lg flex items-center pl-4 border border-gray-200 dark:border-gray-700">
                        <input value="staff" id="staff" type="radio" v-model="form.role_type" name="role_type"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                        <global-label for="staff"
                            class="py-2 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300" value="Staff"
                            :required="false" />
                    </div>
                    <div class="w-full rounded-lg flex items-center pl-4 border border-gray-200 dark:border-gray-700">
                        <input value="teacher" id="teacher" type="radio" v-model="form.role_type" name="role_type"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                        <global-label for="teacher"
                            class="py-2 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300" value="Teacher"
                            :required="false" />
                    </div>
                </div>
                <input-error :error="$page.props.errors.role_type" />
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
        update_data: Boolean,
    },
    data() {
        return {
            form: useForm({
                name: this.data.name,
                role_type: this.data.role_type ?? 'student',
                _method: "",
            }),
        };
    },
    watch: {
        data: {
            deep: true,
            handler(val, oldVal) {
                this.form.name = val.name;
                this.form.role_type = val.role_type;
            },
        },
        update_data: {
            deep: true,
            handler(val, oldVal) {
                this.form._method = val ? "PUT" : "POST";
            },
        },
    },
    methods: {
        submit() {
            if (this.update_data) {
                this.$inertia.post(
                    this.route("leave-type.update", this.data.id),
                    this.form,
                    {
                        onSuccess: () => {
                            this.form.name = "";
                            this.$emit("updateFunction");
                        },
                    }
                );
            } else {
                this.$inertia.post(this.route("leave-type.store"), this.form, {
                    onSuccess: () => {
                        this.form.name = "";
                    },
                });
            }
        },
    },
};
</script>
