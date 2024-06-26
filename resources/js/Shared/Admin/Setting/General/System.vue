<template>
    <div
        class="divide-y divide-gray-200 dark:divide-gray-600 overflow-hidden rounded-lg bg-white dark:bg-gray-800 shadow pb-6 mt-5">
        <form class="mt-2" @submit.prevent="submit()" enctype="multipart/form-data">
            <div class="py-6 px-4 sm:p-6 lg:pb-8">
                <div>
                    <h2 class="text-lg font-medium dark:text-gray-400 leading-6 text-gray-900">
                        {{ __('System Setting') }}
                    </h2>
                </div>
                <div class="grid sm:grid-cols-1 md:grid-cols-2 sm:gap-1 md:gap-4">
                    <div class="w-full bg-white rounded-lg dark:bg-gray-800 dark:border-gray-700">
                        <div class="mb-3">
                            <global-label for="phone" value="App Debug Mode" :required="false" />
                            <div class="flex gap-2 mt-1">
                                <div
                                    class="w-full rounded flex items-center pl-4 rtl:pl-0 rtl:pr-4 border border-gray-200 dark:border-gray-700">
                                    <input value="1" id="app_mode_true" v-model="form.app_debug_mode" type="radio"
                                        name="app_debug_mode" :checked="form.app_debug_mode"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                                    <global-label for="app_mode_true"
                                        class="py-1.5 ml-2 rtl:ml-0 rtl:mr-2 w-full mt-1 text-sm font-medium text-gray-900 dark:text-gray-400"
                                        value="On" :required="false" />
                                </div>
                                <div
                                    class="w-full rounded flex items-center pl-4 rtl:pl-0 rtl:pr-4 border border-gray-200 dark:border-gray-700">
                                    <input value="0" id="app_mode_false" type="radio" v-model="form.app_debug_mode"
                                        name="app_debug_mode" :checked="!form.app_debug_mode"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                                    <global-label for="app_mode_false"
                                        class="py-1.5 ml-2 rtl:ml-0 rtl:mr-2 w-full mt-1 text-sm font-medium text-gray-900 dark:text-gray-400"
                                        value="Off" :required="false" />
                                </div>
                            </div>
                            <input-error :error="$page.props.errors.app_debug_mode" />
                        </div>
                        <div class="mb-3">
                            <global-label for="language" :value="__('Set Default Language')" :required="true" />
                            <Multiselect id="language" :close-on-select="true" :can-clear="false" :searchable="true"
                                v-model="form.language" :create-option="false" :placeholder="__('Select a language')"
                                :options="languages.map(item => ({
                                    label: item.name,
                                    value: item.code,
                                }))" autocomplete="off" />

                            <input-error :error="$page.props.errors.language" />
                        </div>
                        <div class="mb-3">
                            <global-label for="currency" :value="__('Set Default Currency')" :required="true" />
                            <Multiselect id="currency" :close-on-select="true" :can-clear="false" :searchable="true"
                                v-model="form.currency" :create-option="true" :placeholder="__('Select a currency')"
                                :options="currencies.map(item => ({
                                    label: item.name,
                                    value: item.code,
                                }))" autocomplete="off" />
                            <input-error :error="$page.props.errors.currency" />
                        </div>
                        <div class="mb-3">
                            <global-label for="date_format" :value="__('Date Format')" :required="true" />
                            <Multiselect id="date_format" :close-on-select="true" :can-clear="false" :searchable="true"
                                v-model="form.date_format" :create-option="false" :placeholder="__('Select a date format')"
                                :options="date_formate.map(item => ({
                                    label: item.label,
                                    value: item.value,
                                }))" autocomplete="off" />
                            <input-error :error="$page.props.errors.date_format" />
                        </div>
                    </div>
                    <div class="w-full bg-white rounded-lg dark:bg-gray-800 dark:border-gray-700">
                        <div class="mb-3">
                            <global-label for="timezone" :value="__('Timezone')" :required="true" />
                            <Multiselect id="timezone" :close-on-select="true" :can-clear="false" :searchable="true"
                                v-model="form.timezone" :create-option="false" :placeholder="__('Select a timezone')"
                                :options="timezones.map(item => ({
                                    label: item.label,
                                    value: item.value,
                                }))" autocomplete="off" />
                            <input-error :error="$page.props.errors.timezone" />
                        </div>
                        <div class="mb-3">
                            <global-label for="currency" :value="__('Currency Format')" :required="true" />
                            <Multiselect id="currency" :close-on-select="true" :can-clear="false" :searchable="true"
                                v-model="form.currency_format" :create-option="false"
                                :placeholder="__('Select a currency format')" :options="currency_formate.map(item => ({
                                    label: item.label,
                                    value: item.value,
                                }))" autocomplete="off" />
                            <input-error :error="$page.props.errors.currency_format" />
                        </div>

                        <div class="mb-3">
                            <global-label for="start_week" :value="__('Start Day Of Week')" :required="true" />
                            <Multiselect id="start_week" :close-on-select="true" :can-clear="false" :searchable="true"
                                v-model="form.start_day_of_week" :create-option="false" :placeholder="__('Select a week')"
                                :options="start_week.map(item => ({
                                    label: item.label,
                                    value: item.value,
                                }))" autocomplete="off" />
                            <input-error :error="$page.props.errors.start_day_of_week" />
                        </div>
                        <div class="mb-3">
                            <div class="flex items-center">
                                <global-label for="email" :value="__('Overdue After (Days)')" :required="true" />
                                <!-- Dark style tooltip -->
                                <div class="hs-tooltip inline-block">
                                    <button type="button">
                                        <ExclamationTriangleIcon class="text-red-400 w-4 h-4 ml-2 rtl:ml-0 rtl:mr-2" />
                                        <div class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-2 px-4 bg-gray-900 text-sm font-medium text-white rounded-md shadow-sm dark:bg-slate-700"
                                            role="tooltip">
                                            {{ __('How many days after the due date will the transaction become overdue') }}
                                        </div>
                                    </button>
                                </div>
                            </div>
                            <global-input type="number" :class="$page.props.errors.overdue ? 'border-custom ' : ''"
                                class="w-full dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400"
                                v-model="form.overdue" placeholder="Days">
                            </global-input>
                            <input-error :error="$page.props.errors.overdue" />
                        </div>
                    </div>
                </div>
            </div>
            <div class=" border-gray-700 mb-1">
                <div class="flex justify-end py-4 gap-4 px-4 sm:px-6">
                    <global-button :loading="form.processing" type="submit" cssClass="w-full mt-3" theme="primary">
                        {{ __('Save Changes') }}
                    </global-button>
                </div>
            </div>
        </form>
    </div>
</template>


<script>
import { useForm } from '@inertiajs/inertia-vue3';
import { ExclamationTriangleIcon } from '@heroicons/vue/24/outline';
import ToolTip from '@/Shared/ToolTip.vue';
import Multiselect from '@vueform/multiselect'
import '@vueform/multiselect/themes/default.css';

export default {
    components: {
        ExclamationTriangleIcon,
        ToolTip,
        Multiselect
    },
    props: {
        timezones: {
            type: Array,
            required: true
        },
        languages: {
            type: Array,
            required: true
        },
        currencies: {
            type: Array,
            required: true
        },
        system: {
            type: Object,
            required: true
        },
        setting: {
            type: Object,
            required: true
        },
    },
    data() {
        return {
            form: useForm({
                timezone: this.system.timezone,
                app_debug_mode: this.system.app_debug_mode,
                language: this.system.language,
                currency: this.system.currency,
                currency_format: this.system.currency_format,
                overdue: this.setting.over_due_days,
                date_format: this.system.date_format,
                start_day_of_week: this.system.start_day_of_week,
                _method: 'PUT'
            }),

            date_formate: [
                {
                    label: 'dd-mm-yyyy',
                    value: 'd_m_Y'
                },
                {
                    label: 'dd-mmm-yyyy',
                    value: 'd_M_Y'
                },
                {
                    label: 'dd/mm/yyyy',
                    value: 'd__m__Y'
                },
                {
                    label: 'mm-dd-yyyy',
                    value: 'm_d_Y'
                },
                {
                    label: 'mm/dd/yyyy',
                    value: 'm__d__Y'
                },
                {
                    label: 'yyyy/mm/dd',
                    value: 'Y__m__d'
                }
            ],

            start_week: [
                {
                    label: "Sunday",
                    value: 0
                },
                {
                    label: "Monday",
                    value: 1
                },
                {
                    label: "Tuesday",
                    value: 2
                },
                {
                    label: "Wednesday",
                    value: 3
                },
                {
                    label: "Thursday",
                    value: 4
                },
                {
                    label: "Friday",
                    value: 5
                },
                {
                    label: "Saturday",
                    value: 6
                },
            ],

            currency_formate: [
                {
                    label: '12345678.00',
                    value: '12345678.00'
                },
                {
                    label: '12,345,678.00',
                    value: '12,345,678.00'
                },
                {
                    label: '1,23,45,678.00',
                    value: '1,23,45,678.00'
                },
                {
                    label: '12.345.678.00',
                    value: '12.345.678.00'
                },
                {
                    label: '12.345.678,00',
                    value: '12.345.678,00'
                },
            ]
        }

    },
    methods: {
        submit() {
            this.form.post(this.route('settings.system.update'), {
                preserveScroll: true,
            })
        }
    }
}
</script>
