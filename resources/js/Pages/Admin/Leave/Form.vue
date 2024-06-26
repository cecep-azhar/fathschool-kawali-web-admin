<template>
    <a-modal ref="invoicemodal" width="500px" v-model:visible="visible" :wrap-style="{ overflow: 'auto' }"
        @ok="handleOk">
        <!-- Content -->
        <div class="w-full p-4 dark:bg-gray-800 dark:border-gray-700 rounded-lg">
            <div class="mb-3">
                <global-label for="user" value="Select User" :required="false" />
                <a-select :class="$page.props.errors.user ? 'border-custom ' : ''"  size="large"
                    class="width-100" v-model:value="form.user" show-search :placeholder="__('Select a user')" :options="options"
                    :filter-option="filterOption" @focus="handleFocus" @blur="handleBlur" @change="handleChange">
                </a-select>
                <input-error :error="$page.props.errors.user" />
            </div>
            <div class="mb-3">
                <global-label for="date" value="Date" :required="true" />
                <a-range-picker :class="$page.props.errors.date ? 'border-custom' : ''" name="date"
                    class="custom-input dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400"
                    :disabled-date="disabledDate" :disabled-time="disabledRangeTime" v-model:value="form.date"
                    :format="customDateFormat" />
                <input-error :error="$page.props.errors.date" />
            </div>
            <div class="mb-3">
                <global-label for="status" value="Select Status" :required="false" />
                <a-select :class="$page.props.errors.status ? 'border-custom ' : ''"  size="large"
                    class="width-100" v-model:value="form.status" show-search :placeholder="__('Select a user')" :options="options2"
                    :filter-option="filterOption" @focus="handleFocus" @blur="handleBlur" @change="handleChange">
                </a-select>
                <input-error :error="$page.props.errors.status" />
            </div>
            <div class="mb-1">
                <global-label for="description" value="Description" :required="false" />
                <textarea :placeholder="__('Description')" id="description" v-model="form.description"
                    :class="$page.props.errors.description ? 'border-red-500' : ''"
                    class="pl-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 rounded-lg dark:text-gray-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                <input-error :error="$page.props.errors.description" />
            </div>
        </div>
        <!-- COntent ENd-->
        <template #title>
            <div ref="editmodal" class="width-100">{{__('Edit Leave')}}</div>
        </template>
        <template #footer>
            <global-button :loading="loading" type="button" @click="submit()"
                cssClass="ml-5" theme="primary" id="updateButton">
                {{ __('Edit') }}
            </global-button>
        </template>
    </a-modal>
</template>

<script>
import dayjs, { Dayjs } from 'dayjs';
export default {
    props: {
        users: Object,
        leave: Object,
    },
    data() {
        return {
            loading: false,
            options: [],
            options2: [
                {
                    value: 'pending',
                    label: 'Pending'
                },
                {
                    value: 'accepted',
                    label: 'Accepted'
                },
                {
                    label: 'Rejected',
                    value: 'rejected'
                }
            ],
            customDateFormat: 'DD-MM-YYYY',
            visible: false,
            form: {
                date: [
                    this.leave.start ? dayjs(this.leave.start, this.customDateFormat) : '',
                    this.leave.end ? dayjs(this.leave.end, this.customDateFormat) : '',
                ],
                user: this.leave.user_id,
                status: this.leave.status,
                description: this.leave.description,
                _method: "PUT",
            },
        };
    },
    watch: {
        leave: {
            deep: true,
            handler(val, oldVal) {
                this.form.user = val.user_id;
                this.form.date = [
                    dayjs(val.start),
                    dayjs(val.end),
                ]
                this.form.status = val.status;
                this.form.description = val.description;
            },
        },
    },
    created() {
        for (const [key, value] of Object.entries(this.users)) {
            this.options.push({
                value: value.id,
                label: value.name,
            });
        }
    },
    methods: {
        showModal() {
            this.visible = true;
        },
        handleOk(e) {
            this.visible = false;
        },
        submit(action) {
            this.loading = true;
            this.$inertia.post(this.route("manage-leave.update", this.leave.id), this.form, {
                preserveScroll: true,
                onSuccess: (page) => {
                    this.visible = false;
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
