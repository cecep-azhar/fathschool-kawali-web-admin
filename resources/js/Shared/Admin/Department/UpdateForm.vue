<template>
    <form @submit.prevent="submit">
        <div class="w-full p-4 dark:bg-gray-800 dark:border-gray-700">
            <div >
                <global-label for="name" value="Name" :required="false" />
                <global-input type="text" id="name" v-model="form.name" name="name"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                    :placeholder="__('Name')" :error="$page.props.errors.name" />
                <input-error :error="$page.props.errors.name" />
            </div>
            <div class="mt-3">
                <global-label for="study_program_id" value="Select Study Program " :required="false" />
                    <a-select :class="$page.props.errors.study_program_id ? 'border-custom ' : ''" size="large"
                    class="width-100" v-model:value="form.study_program_id" show-search :placeholder="__('Select Study Program')"
                        :options="options" :filter-option="filterOption" @focus="handleFocus" @blur="handleBlur"
                        @change="handleChange">
                    </a-select>
                <input-error :error="$page.props.errors.class" />
            </div>
        </div>
        <div class="flex gap-2 ml-5">
            <global-button :loading="loading" type="submit" theme="primary" class="mr-2">
                {{ __('Update') }}
            </global-button>

            <Link preserve-scroll :href="route('departments.index')">
                <global-button :loading="false" type="button" theme="outline-danger">
                    {{ __('Cancel') }}
                </global-button>
            </Link>
        </div>
        <br>
    </form>
</template>

<script>
export default {
    props: {
        department: Object,
        study_programs: Object,
    },
    data() {
        return {
            loading: false,
            options: [],
            form: {
                name: this.department.name,
                study_program_id: this.department.study_program_id,
                _method: "PUT",
            },
        };
    },
    created() {
        // for study programs
        for (const [key, value] of Object.entries(this.study_programs)) {
                this.options.push({
                    value: value.id,
                    label: value.name,
                });
            }
    },
    watch: {
        department: {
            deep: true,
            handler(val, oldVal) {
                this.form.name = val.name;
            },
        },
    },
    methods: {
        submit() {
            this.loading = true;
            this.$inertia.post(
                this.route("departments.update", this.department.id),
                this.form,
                {
                    onSuccess: () => {
                        this.$inertia.get(this.route("departments.index"));
                    },
                    onFinish: visit => { this.loading = false },
                }
            );
        },
    },
};
</script>
