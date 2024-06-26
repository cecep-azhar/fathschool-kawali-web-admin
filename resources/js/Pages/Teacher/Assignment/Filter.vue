<template>
    <div class="mb-4">
        <form class="grid gap-6 w-full" :class="$page.props.auth.role == 'Teacher'? 'xl:grid-cols-4 md:grid-cols-2':'xl:grid-cols-5 md:grid-cols-2'"
            @submit.prevent="filterDataSet()">
            <div >
                <global-input id="search" v-model="filter.keyword" type="search"
                    class="block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                    :placeholder="__('Assignment Title')" :error="$page.props.errors.keyword" />
            </div>
            <Multiselect id="subject" :close-on-select="true" :can-clear="true" :searchable="true"
                v-model="filter.subject_id" :create-option="false" :placeholder="__('Select Subject')"
                :options="subjects && subjects.map(item => ({ value: item.id, label: item.name }))"
                autocomplete="off" />
            <template v-if="$page.props.auth.role == 'Teacher'">
                <tab-filter
                    @setTabData="setTabValue"
                    :filterData="filter_data ? filter_data.status : ''"
                    filter_column="status"
                    :tab_data="[
                            { title: 'All', id: 'all2', value: 'all' },
                            { title: 'Due', id: 'Due', value: 'Due' },
                            { title: 'Expired', id: 'Expired', value: 'Expired' },
                    ]" />
            </template>
            <div v-if="$page.props.auth.role == 'Teacher'">
                <global-button :loading="loading" type="submit" theme="primary">
                    {{ __('Search') }}
                </global-button>
            </div>
            <template v-if="$page.props.auth.role != 'Teacher'">
                <tab-filter
                    @setTabData="setTabValue"
                    :filterData="filter_data ? filter_data.status : ''"
                    filter_column="status"
                    css="xl:col-span-2 flex items-center md:mt-0"
                    :tab_data="[
                            { title: 'All', id: 'all2', value: 'all' },
                            { title: 'Due', id: 'Due', value: 'Due' },
                            { title: 'Expired', id: 'Expired', value: 'Expired' },
                            { title: 'Submitted', id: 'submitted', value: 'submitted' },
                            { title: 'Not Submitted', id: 'unsubmitted', value: 'unsubmitted' },
                    ]" />
            </template>
            <div v-if="$page.props.auth.role != 'Teacher'">
                <global-button :loading="loading" type="submit" theme="primary">
                    {{ __('Search') }}
                </global-button>
            </div>
        </form>
    </div>
</template>

<script>
    import Multiselect from '@vueform/multiselect'
    import '@vueform/multiselect/themes/default.css';
    import { useForm } from '@inertiajs/inertia-vue3';

    export default {
        props: {
            subjects: Object,
            filter_data: Object,
            loading: Boolean
        },
        components: { Multiselect },
        data() {
            return {
                filter: useForm({
                    keyword: this.filter_data.keyword ?? '',
                    status: this.filter_data.status ?? '',
                    subject_id: this.filter_data.subject_id ?? '',
                }),
                tab: this.filter_data.status ?? 'all',
            }
        },
        methods: {
            filterDataSet() {
                this.$emit('filterDataSet', this.filter)
            },
            setTabValue(arg){
                let column = arg['filter_column_data'] ?? '';
                let value = arg['value'] ?? '';

                this.filter[column] =  value;
            },
        }
    };
</script>
<style scoped>
</style>
