<template>
    <AppLayout :title="__('Language Edit')">
        <Breadcrumb>
            <BreadcrumbLink :title=" __('Language Edit')"/>
        </Breadcrumb>

        <div class="pb-12">
            <page-header>
                {{ __('Language Edit') }}
                <template #content>
                    <global-button preserve-scroll :url="route('languages.index')" type="link" theme="primary">
                        {{ __('All Language') }}
                    </global-button>
                </template>
            </page-header>
            <form class="mt-2" @submit.prevent="submit()">
                <div class="grid sm:grid-cols-1 md:grid-cols-2 sm:gap-1 md:gap-4">
                    <div
                        class="w-full bg-white rounded-lg border border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700">
                        <div class="mb-3">
                            <global-label for="name" value="Name" :required="false" />
                            <a-select :class="$page.props.errors.name ? 'border-custom ' : ''"
                                size="large" class="width-100" v-model:value="form.name" show-search
                                :placeholder="__('Select Language Name')" :options="options" :filter-option="filterOption"
                                @focus="handleFocus" @blur="handleBlur" @change="selectedCounty($event)">
                            </a-select>
                            <input-error :error="$page.props.errors.name" />
                        </div>
                        <div class="mb-1">
                            <global-label for="code" value="Code" :required="false" />
                            <a-select :class="$page.props.errors.code ? 'border-custom ' : ''"
                                size="large" class="width-100" v-model:value="form.code" show-search
                                :placeholder="__('Select Language Code')" :options="options2" :filter-option="filterOption"
                                @focus="handleFocus" @blur="handleBlur">
                            </a-select>
                            <input-error :error="$page.props.errors.code" />
                        </div>
                    </div>
                    <div
                        class="w-full bg-white rounded-lg border border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700">
                        <div class="mb-3">
                            <global-label for="direction" value="Direction" :required="false" />
                            <div class="flex items-center pl-4 rounded border border-gray-200 dark:border-gray-700">
                                <input id="direction" type="radio" value="ltr" v-model="form.direction"
                                    name="bordered-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="bordered-radio-1"
                                    class="py-4 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">
                                    {{ __('Left To Right') }}
                                </label>
                            </div>
                            <div
                                class="flex items-center mt-2 pl-4 rounded border border-gray-200 dark:border-gray-700">
                                <input id="bordered-radio-2" type="radio" value="rtl" v-model="form.direction"
                                    name="bordered-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="bordered-radio-2"
                                    class="py-4 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">
                                    {{ __('Right To Left') }}
                                </label>
                            </div>
                            <input-error :error="$page.props.errors.direction" />
                        </div>
                    </div>
                </div>
                <global-button :loading="loading" type="submit"
                    class="text-white bg-blue-500 dark:bg-blue-500  hover:bg-blue-500 active:bg-blue-600 dark:active:bg-blue-600 focus:border-blue-600 dark:focus:border-blue-600 focus:ring focus:ring-blue-300 w-full mt-3 dark:focus:ring-blue-300">
                    {{ __('Save') }}
                </global-button>
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
        errors: Object,
        translations: Object,
        language: Object
    },
    data() {
        return {
            loading: false,
            options: [],
            options2: [],
            form: {
                name: this.language.name,
                code: this.language.code,
                direction: this.language.direction,
                _method: 'PUT'
            },
        };
    },
    created() {
        for (const [key, value] of Object.entries(this.translations)) {
            this.options.push({
                value: key,
                label: value['name'],
            });
        }

        for (const [key, value] of Object.entries(this.translations)) {
            this.options2.push({
                value: key,
                label: key,
            });
        }
    },
    methods: {
        submit() {
            this.loading = true;
            this.$inertia.post(this.route("languages.update", this.language.id), this.form, {
                preserveScroll: true,
                onSuccess: () => {
                },
                onFinish: visit => { this.loading = false },
            });
        },
        selectedCounty(event) {
            this.form.code = event.target.options[event.target.options.selectedIndex].getAttribute('code');
        }
    },
};
</script>

<style lang="scss" scoped>

</style>
