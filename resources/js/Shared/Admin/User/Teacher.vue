<template>
    <div class="w-full bg-white rounded-lg border border-gray-200 p-4 dark:bg-gray-800 dark:border-gray-700">
        <div class="mb-3">
            <global-label for="department" value="Select Department" :required="true" />
            <a-select :class="$page.props.errors.department ? 'border-custom ' : ''" size="large"
            class="width-100" v-model:value="form.department" show-search :placeholder="__('Select Department')" :options="options"
                :filter-option="filterOption" @focus="handleFocus" @blur="handleBlur" @change="dataPush">
            </a-select>
            <input-error :error="$page.props.errors.department" />
        </div>
    </div>
</template>

<script>
export default {
    props: {
        departments: Object,
        user: Object
    },
    data() {
        return {
            options: [],
            options2: [],
            form: {
                department: this.user ? this.user.department_id : '',
            }
        }
    },
    created() {
        // for department
        for (const [key, value] of Object.entries(this.departments)) {
            this.options.push({
                value: value.id,
                label: value.name,
            });
        }
        if (!this.user) {
            this.form.department = null;
        }
    },
    methods: {
        dataPush(e) {
            this.$emit('child-form', this.form);
        },
        filterOption(input, option) {
            return option.label.toLowerCase().indexOf(input.toLowerCase()) >= 0;
        },
    }
}
</script>

<style>

</style>
