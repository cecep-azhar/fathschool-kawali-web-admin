<template>
    <form @submit.prevent="submit" enctype="multipart/form-data">
        <div class="w-full p-4">
            <div class="mb-2">
                <global-label for="name" value="Name" :required="true" />
                <global-input type="text" id="name" v-model="form.name"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400 testSocialName" placeholder="Name"
                    :error="$page.props.errors.name" />
                <input-error :error="$page.props.errors.name" />
            </div>
            <div class="my-2">
                <global-label for="url" :value="__('URL')" :required="true" />
                <global-input type="url" id="url" v-model="form.url"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400" placeholder="URL"
                    :error="$page.props.errors.url" />
                <input-error :error="$page.props.errors.url" />
            </div>
            <div class="my-2">
                <global-label for="icon" :value="__('Icon')" :required="true" />
                <global-input type="file" class="mt-1 block w-full dark:bg-gray-700 testFile" @change="onFileChange" />
                <input-error :error="$page.props.errors.icon" />
            </div>
            <global-button :loading="form.processing" type="submit"
                class="text-white bg-blue-500 dark:bg-blue-500 hover:bg-blue-500 active:bg-blue-600 dark:active:bg-blue-600 focus:border-blue-600 dark:focus:border-blue-600 focus:ring focus:ring-blue-300 mt-6 dark:focus:ring-blue-300">
                {{ __('Save') }} {{ __('Social Media') }}
            </global-button>
        </div>
        <br />
    </form>
</template>

<script>
import { useForm } from "@inertiajs/inertia-vue3";
export default {
    data() {
        return {
            form: useForm({
                name: "",
                url: "",
                icon: "",
            }),
        };
    },
    methods: {
        submit() {
            this.form.post(route("settings.social.store"), {
                preserveScroll: true,
                onSuccess: () => {
                    this.form.reset('title', 'url')
                }
            });
        },
        onFileChange(e) {
            const file = e.target.files[0];
            this.form.icon = file;
        },
    },
};
</script>
