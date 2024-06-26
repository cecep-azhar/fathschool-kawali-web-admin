<template>
    <AppLayout :title="__('Language Settings')">
        <Breadcrumb>
            <BreadcrumbLink :title=" __('Language Settings')"/>
        </Breadcrumb>

        <div class="pb-12">
            <page-header>
                {{ language.name }} - {{ __('Translate Language') }} ( {{ __('Total') }} : {{ amount }} )
                <template #content>
                    <global-button preserve-scroll :url="route('languages.index')" type="link" theme="primary">
                        {{ __('All Language') }}
                    </global-button>
                </template>
            </page-header>
            <form @submit.prevent="submit">
                <div>
                    <div v-for="(translation, key) in translations" :key="key"
                        class="grid grid-cols-1 md:grid-cols-2 gap-2 p-4 md:p-0">

                        <div
                            class="pl-4 mt-2 bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            {{ replace(key) }}
                        </div>
                        <global-input type="text" v-model="form.translations[key]"
                            class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                            :placeholder="__('Enter Name')" />
                    </div>
                </div>
                <div class="flex mt-3 justify-center">
                    <global-button :loading="loading" type="submit" cssClass="w-full" theme="primary">
                        {{ __('Update') }}
                    </global-button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
    components: {
        AppLayout,
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
    },
};
</script>
