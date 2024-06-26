<template>
    <form @submit.prevent="submit()" class="p-6 dark:bg-gray-800 dark:text-gray-400">
        <div class="w-full">
            <div class="mb-3">
                <global-label for="name" value="Holiday Name" :required="false" />
                <global-input v-model="form.name" type="text" id="name"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                    :placeholder="__('Name')" :error="$page.props.errors.name" />
                <input-error :error="$page.props.errors.name" />
            </div>
            <div class="mb-3">
                <global-label for="name" value="Date" :required="false" />
                <a-range-picker :class="$page.props.errors.date ? 'border-custom' : ''" name="date"
                    class="custom-input dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400"
                    :disabled-date="disabledDate" :disabled-time="disabledRangeTime" v-model:value="form.date"
                    :format="customDateFormat" />
                <input-error :error="$page.props.errors.date" />
            </div>
        </div>
        <div class="flex gap-2">
            <global-button :loading="loading" type="submit"
             theme="primary">
                {{ __('Update') }}
            </global-button>
            <global-button :loading="loading" type="button" @click.prevent="deleteData"
             theme="danger">
                {{ __('Delete') }}
            </global-button>
            <Link preserve-scroll :href="route('holiday.index')" class="hover:text-gray-500">
            <back-button />
            </Link>
        </div>
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
            customDateFormat: 'DD-MM-YYYY',
            form: this.$inertia.form({
                name: this.data.title,
                date: [
                    this.data.start ? dayjs(this.data.start, this.customDateFormat) : '',
                    this.data.end ? dayjs(this.data.end, this.customDateFormat) : '',
                ],
                _method: "PUT",
            }),
        };
    },
    watch: {
        data: {
            deep: true,
            handler(val, oldVal) {
                this.form.name = this.data.title;
                this.form.date = [
                    dayjs(val.start),
                    dayjs(val.end),
                ]
            },
        },
    },
    methods: {
        submit() {
            this.form.post(this.route("holiday.update", this.data.id), {
                onSuccess: (page) => {
                    this.form.reset();
                    this.$emit("update");
                },
            });
        },
        deleteData(){
            if (confirm('Are you sure ?')) {
                this.$inertia.delete(this.route('holiday.destroy', this.data.id), {
                    preserveScroll: true,
                    onSuccess: () => {
                        window.location.reload();
                    },
                });
            }
        }
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
