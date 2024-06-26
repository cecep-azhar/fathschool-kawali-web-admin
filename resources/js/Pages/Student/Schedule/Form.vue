<template>
    <a-modal v-model:visible="visible" :title="update ? 'Schedule Update' : 'Schedule Create'" @ok="hide">
        <template #footer>
            <a-button key="back" @click="hide">{{ __('Close') }}</a-button>
        </template>
        <form @submit.prevent="submit()" class="p-6 dark:bg-gray-800 dark:text-gray-400">
            <div class="w-full">
                <div class="mb-3">
                    <global-label for="title" value="Schedule Title" :required="false" />
                    <global-input v-model="form.title" type="text" id="title" name="title"
                        class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                        :placeholder="__('Title')" :error="$page.props.errors.title" />
                    <input-error :error="$page.props.errors.title" />
                </div>
                <div class="mb-3">
                    <global-label for="end_date" value="Date Day-Month-Year" :required="false" />
                    <a-range-picker style="" :class="$page.props.errors.date ? 'border-custom' : ''" name="date"
                        class="custom-input dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400"
                        :disabled-date="disabledDate" :disabled-time="disabledRangeTime" v-model:value="form.date"
                        :format="customDateFormat" />
                    <input-error :error="$page.props.errors.date" />
                </div>
            </div>
            <global-button :loading="loading" type="submit"
                cssClass="w-full" theme="primary">
                {{ update ? 'Update' : 'Create' }}
            </global-button>
            <button v-if="update" @click="destroy()" type="button"
                class="text-red-500 mt-2 border border-red-400 hover:bg-red-200 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                {{ __('Delete') }}
            </button>
        </form>
    </a-modal>
</template>

<script>
import dayjs, { Dayjs } from 'dayjs';

export default {
    props: {
        data: Object
    },
    data() {
        return {
            loading: false,
            visible: false,
            update: false,
            customDateFormat: 'DD-MM-YYYY',
            form: {
                title: '',
                date: '',
                date2: '',
                _method: '',
            }
        }
    },
    watch: {
        data: {
            deep: true,
            handler(val, oldVal) {
                this.update = val.update;
                this.form._method = val.update ? 'PUT' : 'POST';
                this.form.title = val.title;
                this.form.date = [
                    dayjs(val.start),
                    dayjs(val.end),
                ]
            },
        },
    },
    methods: {
        showModal() {
            this.visible = true;
        },
        hide() {
            this.form.title = '';
            this.form.date = '';
            this.visible = false
        },
        submit() {
            this.loading = true;
            let start = dayjs(this.form.date[0]).format('YYYY-MM-DD');
            let end = dayjs(this.form.date[1]).format('YYYY-MM-DD');

            this.form.date2 = [
                start,
                end
            ];

            if (this.update) {
                this.$inertia.post(this.route('schedules.update', this.data.id), this.form, {
                    preserveScroll: true,
                    onSuccess: (page) => {
                        this.hide();
                    },
                    onFinish: visit => { this.loading = false },
                })
            } else {
                this.$inertia.post(this.route('schedules.store'), this.form, {
                    preserveScroll: true,
                    onSuccess: (page) => {
                        this.hide();
                    },
                    onFinish: visit => { this.loading = false },
                })
            }
        },
        destroy() {
            if (confirm('Are you sure ?')) {
                this.$inertia.delete(this.route('schedules.destroy', this.data.id), {
                    preserveScroll: true,
                    onSuccess: (page) => {
                        this.hide();
                    }
                })
            } else {
                return false;
            }
        }
    }

}
</script>
<style scoped>
.custom-input {
    font-size: 0.875rem;
    line-height: 1.25rem;
    padding-top: 0.625rem;
    padding-bottom: 0.625rem;
    padding-right: 0.625rem;
    padding-left: 1rem;
    border-radius: 0.5rem;
    width: 100%;
}

.border-custom {
    border-color: red;
    border-right-width: 1px !important;
}
</style>

