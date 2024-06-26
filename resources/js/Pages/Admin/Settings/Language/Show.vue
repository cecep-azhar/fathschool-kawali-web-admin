<template>
    <AppLayout :title="__('Language | Settings')">
        <Breadcrumb>
            <BreadcrumbLink :title="__('Language Settings')" />
        </Breadcrumb>

        <div class="pb-12">
            <page-header>
                {{ language.name }} - {{ __('Translate Language') }} ( {{ __('Total') }} : {{ amount }} )
                <template #content>
                    <!-- <global-button @click="autoTranslate()" :loading="loading" theme="primary">
                        {{ __('All translate') }}
                    </global-button> -->
                </template>
            </page-header>
            <page-header v-if="loading">
                <div class="text-center">{{ __('It can take up to 2 minutes to translate those, so please wait.') }}</div>
            </page-header>
            <SettingLayout>
                <div
                    class="divide-y divide-gray-200 dark:divide-gray-600 overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow pb-6">
                    <div class="py-6 px-4 sm:p-6 lg:pb-8">
                        <div class="grid grid-cols-12 divide-y-0 divide-x  dark:divide-gray-600 gap-8">
                            <div class="col-span-12">
                                <form @submit.prevent="submit">
                                    <div>
                                        <div v-for="(translation, key) in translations" :key="key"
                                            class="grid grid-cols-1 md:grid-cols-11 gap-2 p-4 md:p-0">

                                            <div
                                                class="pl-4 mt-2 bg-gray-200 col-span-5 md:col-span-5 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                {{ replace(key) }}
                                            </div>

                                            <global-input type="text" v-model="form.translations[key]" :id="generateId(key)"
                                                class="col-span-5 md:col-span-5 mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                                :placeholder="__('Enter Name')" />

                                            <global-button class="bg-blue-500 text-white active:bg-blue-600 font-bold text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button"
                                                @click="translateText(key)" :loading="loading">
                                                {{ __('Translate') }}
                                            </global-button>

                                        </div>

                                    </div>
                                    <div class="flex mt-3 justify-center">
                                        <global-button :loading="loading" type="submit" cssClass="w-full" theme="primary">
                                            {{ __('Update') }}
                                        </global-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </SettingLayout>

        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import SettingLayout from '@/Layouts/SettingLayout.vue';
import { Cog6ToothIcon } from "@heroicons/vue/24/outline";

export default {
    components: {
        AppLayout,
        Cog6ToothIcon,
        SettingLayout,
    },
    props: {
        translations: Array,
        language: Object,
        amount: Number
    },
    data() {
        return {
            loading: false,
            form: {
                translations: this.translations
            },
        }
    },
    methods: {
        submit() {
            this.loading = true;
            this.$inertia.post(route('translation.update', this.language.code), this.form, {
                onFinish: visit => { this.loading = false },
            });
        },
        replace(string) {
            const str = string.replaceAll('_', ' ');
            const final = str.charAt(0).toUpperCase() + str.slice(1);
            return final;
        },
        generateId(key) {
            // Remove spaces and convert to lowercase
            const id = key.replace(/ /g, '').toLowerCase();
            return id;
        },
        autoTranslate() {
            this.loading = true;

            this.$inertia.post(this.route('api.translate'), this.language, {
                preserveScroll: true,
                onSuccess: () => {
                    this.loading = false;
                },
                onFinish: (visit) => {
                    this.loading = false;
                },
            });
        },
        translateText(key) {
            this.loading = true;
            axios({
                url: this.route('single.translate'),
                method: "POST",
                data: {
                    translation: key,
                    code: this.language.code,
                },
            }).then((response) => {
                this.loading = false;
                this.form.translations = response.data;
            }).catch((e) => {
                this.loading = false;
            });
        },
    },
};
</script>
