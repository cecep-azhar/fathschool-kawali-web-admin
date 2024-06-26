<template>
    <form @submit.prevent="submit" enctype="multipart/form-data">
        <div class="w-full p-4">
            <div class="mb-2">
                <global-label for="name" value="Name" :required="false" />
                <global-input type="text" id="name" v-model="form.name"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400 testSocialName" placeholder="Name"
                    :error="$page.props.errors.name" />
                <input-error :error="$page.props.errors.name" />
            </div>
            <div class="my-2">
                <global-label for="url" :value="__('URL')" :required="false" />
                <global-input type="url" id="url" v-model="form.url"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400" placeholder="URL"
                    :error="$page.props.errors.url" />
                <input-error :error="$page.props.errors.url" />
            </div>
            <div class="my-2">
                <global-label for="icon" :value="__('Icon')" :required="false" />
                <global-input type="file" class="mt-1 block w-full dark:bg-gray-700 testFile" @change="onFileChange" />
                <input-error :error="$page.props.errors.icon" />
            </div>
            <div class="flex gap-2 mt-5">
                <global-button :loading="form.processing" type="submit">
                    {{ __('Save') }} {{ __('Social Media') }}
                </global-button>

                <Link preserve-scroll :href="route('settings.website')" class="hover:text-gray-500">
                <global-button :loading="false" type="button" theme="outline-danger">
                    {{ __('Cancel') }}
                </global-button>
                </Link>
            </div>
        </div>
    </form>
</template>

<script>
import { useForm } from "@inertiajs/inertia-vue3";

export default {
    props: {
        socialLink: Object,
        errors: Object,
    },
    data() {
        return {
            loading: false,
            img: this.socialLink.image_icon,
            form: useForm({
                name: this.socialLink.name,
                url: this.socialLink.url,
                icon: '',
                _method: "PUT",
            }),
        };
    },
    watch: {
        socialLink: {
            deep: true,
            handler(newVal, oldVal) {
                this.form.name = newVal.name;
                this.form.url = newVal.url;
                this.form._method = "PUT";
            },
        },
    },
    methods: {
        submit() {
            this.form.post(this.route("settings.social.update", this.socialLink.id), {
                preserveScroll: true,
                onSuccess: () => {
                    this.$inertia.get(route('settings.website'));
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
