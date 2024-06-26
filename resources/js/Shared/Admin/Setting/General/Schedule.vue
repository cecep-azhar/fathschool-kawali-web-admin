<template>
    <div
        class="divide-y divide-gray-200 dark:divide-gray-600 overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow pb-6 mt-5">
        <form class="mt-2" @submit.prevent="submit()" enctype="multipart/form-data">
            <div class="py-6 px-4 sm:p-6 lg:pb-8">
                <div>
                    <h2 class="text-lg font-medium dark:text-gray-400 leading-6 text-gray-900">{{ __('Working Days Setting') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('Please select the working days of the Institution') }}</p>
                </div>
                <div class="w-full bg-white rounded-lg dark:bg-gray-800 dark:border-gray-700 flex flex-wrap">
                    <div class="relative flex items-start w-1/2 mb-2">
                        <div class="flex h-5 items-center">
                            <input v-model="form.sunday" :checked="form.sunday" id="sunday" type="checkbox"
                                class="h-4 w-4 rounded border-gray-300 text-blue-600">
                        </div>
                        <div class="ml-3 rtl:ml-0 rtl:mr-3 text-sm">
                            <label for="sunday" class="font-medium text-gray-700 dark:text-gray-400">{{ __('Sunday') }}</label>
                        </div>
                    </div>
                    <div class="relative flex items-start w-1/2 mb-2">
                        <div class="flex h-5 items-center">
                            <input v-model="form.monday" :checked="form.monday" id="monday" type="checkbox"
                                class="h-4 w-4 rounded border-gray-300 text-blue-600">
                        </div>
                        <div class="ml-3 rtl:ml-0 rtl:mr-3 text-sm">
                            <label for="monday" class="font-medium text-gray-700 dark:text-gray-400">{{ __('Monday') }}</label>
                        </div>
                    </div>
                    <div class="relative flex items-start w-1/2 mb-2">
                        <div class="flex h-5 items-center">
                            <input v-model="form.tuesday" :checked="form.tuesday" id="tuesday" type="checkbox"
                                class="h-4 w-4 rounded border-gray-300 text-blue-600">
                        </div>
                        <div class="ml-3 rtl:ml-0 rtl:mr-3 text-sm">
                            <label for="tuesday" class="font-medium text-gray-700 dark:text-gray-400">{{ __('Tuesday') }}</label>
                        </div>
                    </div>
                    <div class="relative flex items-start w-1/2 mb-2">
                        <div class="flex h-5 items-center">
                            <input v-model="form.wednesday" :checked="form.wednesday" id="wednesday" type="checkbox"
                                class="h-4 w-4 rounded border-gray-300 text-blue-600">
                        </div>
                        <div class="ml-3 rtl:ml-0 rtl:mr-3 text-sm">
                            <label for="wednesday" class="font-medium text-gray-700 dark:text-gray-400">{{ __('Wednesday') }}</label>
                        </div>
                    </div>
                    <div class="relative flex items-start w-1/2 mb-2">
                        <div class="flex h-5 items-center">
                            <input v-model="form.thursday" :checked="form.thursday" id="thursday" type="checkbox"
                                class="h-4 w-4 rounded border-gray-300 text-blue-600">
                        </div>
                        <div class="ml-3 rtl:ml-0 rtl:mr-3 text-sm">
                            <label for="thursday" class="font-medium text-gray-700 dark:text-gray-400">{{ __('Thursday') }}</label>
                        </div>
                    </div>
                    <div class="relative flex items-start w-1/2 mb-2">
                        <div class="flex h-5 items-center">
                            <input v-model="form.friday" :checked="form.friday" id="friday" type="checkbox"
                                class="h-4 w-4 rounded border-gray-300 text-blue-600">
                        </div>
                        <div class="ml-3 rtl:ml-0 rtl:mr-3 text-sm">
                            <label for="friday" class="font-medium text-gray-700 dark:text-gray-400">{{ __('Friday') }}</label>
                        </div>
                    </div>
                    <div class="relative flex items-start w-1/2 mb-2">
                        <div class="flex h-5 items-center">
                            <input v-model="form.saturday" :checked="form.saturday" id="saturday" type="checkbox"
                                class="h-4 w-4 rounded border-gray-300 text-blue-600">
                        </div>
                        <div class="ml-3 rtl:ml-0 rtl:mr-3 text-sm">
                            <label for="saturday" class="font-medium text-gray-700 dark:text-gray-400">{{ __('Saturday') }}</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class=" border-gray-700 mb-1">
                <div class="flex justify-end py-4 gap-4 px-4 sm:px-6">
                    <global-button :loading="form.processing" type="submit" cssClass="w-full mt-3" theme="primary" id="wSave">
                        {{ __('Save Changes') }}
                    </global-button>
                </div>
            </div>
        </form>
    </div>
</template>


<script>
import { useForm } from '@inertiajs/inertia-vue3';

export default {
    props: {
        working_days: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            form: useForm({
                sunday: this.working_days.sunday ? true : false,
                monday: this.working_days.monday ? true : false,
                tuesday: this.working_days.tuesday ? true : false,
                wednesday: this.working_days.wednesday ? true : false,
                thursday: this.working_days.thursday ? true : false,
                friday: this.working_days.friday ? true : false,
                saturday: this.working_days.saturday ? true : false,
            }),
        }

    },
    methods: {
        submit() {
            this.form.put(this.route('settings.schedule.update'), {
                preserveScroll: true,
            })
        }
    },
    created() {

    },
}
</script>
