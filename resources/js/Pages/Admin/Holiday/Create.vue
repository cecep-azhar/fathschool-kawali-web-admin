<template>
    <form @submit.prevent="submit()" class="p-6 dark:bg-gray-800 dark:text-gray-400">
        <div class="w-full">
            <div class="mb-3">
                <global-label for="name" value="Holiday Name" :required="false" />
                <global-input v-model="form.name" id="name" type="text"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                    :placeholder="__('Name')" :error="$page.props.errors.name" />
                <input-error :error="$page.props.errors.name" />
            </div>
            <div class="mb-3">
                <global-label for="end_date" value="Date" :required="false" />
                <a-range-picker :class="$page.props.errors.date ? 'border-custom' : ''" name="date"
                    class="custom-input dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400"
                    :disabled-date="disabledDate" :disabled-time="disabledRangeTime" v-model:value="form.date"
                    :format="customDateFormat" />
                <input-error :error="$page.props.errors.date" />
            </div>
        </div>
        <global-button :loading="loading" type="submit"
            cssClass="w-full mr-2 mb-2 mt-2" theme="primary">
            {{ __('Save') }}
        </global-button>
    </form>
</template>

<script>
import dayjs, { Dayjs } from 'dayjs';
export default {
    props: {
        data: Object,
    },
    data() {
        return {
            loading: false,
            customDateFormat: 'DD-MM-YYYY',
            form: this.$inertia.form({
                name: '',
                date: [
                    this.data.start ? dayjs(this.data.start, this.customDateFormat) : null,
                    this.data.end ? dayjs(this.data.end, this.customDateFormat) : null,
                ],
            }),
        };
    },
    watch: {
        data: {
            deep: true,
            handler(val, oldVal) {
                this.form.date = [
                    dayjs(val.start),
                    dayjs(val.end),
                ]
            },
        },
    },
    methods: {
        submit() {
            this.loading = true;
            this.form.post(this.route("holiday.store"), {
                onSuccess: (page) => {
                    this.form.reset();
                    this.$emit("update");
                },
                onFinish: visit => { this.loading = false },
            });
        },
    },
};
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
