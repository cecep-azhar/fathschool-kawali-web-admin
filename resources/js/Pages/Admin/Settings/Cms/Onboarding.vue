<template>
    <div class="">
        <form @submit.prevent="submit()">
            <div class="rounded-b-lg -mt-2 dark:bg-gray-800 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
                <div v-for="content in onboarding_contents" :key="content.id" class="mt-3">
                    <div class="bg-gray-100 dark:bg-gray-700 rounded-lg pt-1 pb-5">
                        <div class="w-full">
                            <div class="">
                                <div class="focus:outline-none mt-4 bg-gray-100 dark:bg-gray-700 px-6 rounded-lg">
                                    <div class="text-md dark:text-gray-400 font-semibold">
                                        {{ content.menu_slug_text }}
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="focus:outline-none mt-2 bg-gray-100 dark:bg-gray-700 px-6 rounded-lg">
                                    <div class="flex justify-between justify-items-center">
                                        <global-label for="title" value="Title" :required="false" />
                                    </div>
                                    <global-input v-model="form.titles[content.id]" type="text" id="title" name="title"
                                        class="block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                        :placeholder="__('Title')" :error="$page.props.errors.title" />
                                    <input-error :error="$page.props.errors.title" />
                                </div>
                            </div>
                            <div class="mt-2">
                                <div class="focus:outline-none bg-gray-100 dark:bg-gray-700 px-6 rounded-lg">
                                    <div class="flex justify-between justify-items-center">
                                        <global-label for="description" value="Description" :required="false" />
                                    </div>
                                    <global-textarea v-model="form.descriptions[content.id]" type="text" id="description"
                                        name="description"
                                        class="block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                                        :placeholder="__('Description')" :error="$page.props.errors.description" />
                                    <input-error :error="$page.props.errors.description" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="focus:outline-none w-full mt-2">
                <div class="lg:flex justify-center w-full">
                    <global-button :loading="form.processing" type="submit" cssClass="w-full mb-4" theme="primary">
                        {{ __('Update') }}
                    </global-button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import { useForm } from '@inertiajs/inertia-vue3';

export default {
    props: ['onboarding_contents'],
    data() {
        return {
            form: useForm({
                titles: {},
                descriptions: {},
                _method: 'PUT'
            })
        };
    },
    components: {
    },
    mounted() {
        this.organizeTitles();
        this.organizeDescriptions();
    },
    methods: {
        submit() {
            this.form.post(this.route('cms.onboarding.update'), {
                preserveScroll: true
            });
        },
        organizeTitles() {
            const updatedTitles = {};
            for (const content of this.onboarding_contents) {
                updatedTitles[content.id] = content.title;
            }
            this.form.titles = updatedTitles;
        },
        organizeDescriptions() {
            const updatedDescriptions = {};
            for (const content of this.onboarding_contents) {
                updatedDescriptions[content.id] = content.description;
            }
            this.form.descriptions = updatedDescriptions;
        }
    },
};
</script>
