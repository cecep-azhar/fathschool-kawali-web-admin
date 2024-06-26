<template>

    <Head :title="__('Event List')" />
    <AppLayout>
        <Breadcrumb>
            <BreadcrumbLink :title="__('Event')"/>
        </Breadcrumb>

        <div class="mx-auto pb-12">
            <page-header >
                <div class="dark:text-gray-400 font-semibold">
                    {{ __('Event') }}
                </div>
            </page-header>
            <div class="grid grid-cols-1 items-start xl:grid-cols-3 gap-6">
                <!-- calendar -->
                <div class="xl:col-span-2 rounded-lg bg-white overflow-x-auto dark:bg-gray-800">
                    <full-calendar class="p-6" :data="all_events.data" />
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg">
                    <template v-if="index">
                        <div
                            class="flex justify-between px-6 items-center pt-6 text-gray-900 dark:text-gray-400 text-base font-bold">
                            <div>
                                {{ __('Event List') }}
                            </div>
                            <global-button v-if="can('event.create')" :loading="false" @click="setDate" type="button"
                             theme="primary">
                                {{ __('Create Event') }}
                            </global-button>
                        </div>
                    </template>
                    <template v-if="create">
                        <h2
                            class="p-3 flex justify-between items-center mt-2 text-gray-900 dark:text-gray-400 text-base font-bold mb-0">
                            <div>{{ __('Create New Event') }}</div>
                            <Link preserve-scroll :href="route('event.index')" class="hover:text-gray-500">
                            <back-button />
                            </Link>
                        </h2>
                    </template>
                    <template v-if="update">
                        <h2
                            class="px-6 pt-6 flex justify-between mt-2 text-gray-900 dark:text-gray-400 text-base font-bold mb-0">
                            <div>
                                {{ __('Update Event') }}
                            </div>
                        </h2>
                    </template>
                    <!-- Second Hap => Create|Update|Index  -->
                    <template v-if="index">
                        <table-data @edit="edit" :all_events="all_events" />
                    </template>
                    <template v-if="create">
                        <create-form @update="dataUpdate" :data="form" />
                    </template>
                    <template v-if="update">
                        <update-form @update="dataUpdate" :data="form" />
                    </template>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import CreateForm from './Create.vue'
import UpdateForm from './Update.vue'
import TableData from './Table.vue';
import FullCalendar from "@/Shared/Components/FullCalendar.vue";

export default {
    props: {
        all_events: Object
    },
    data() {
        return {
            index: true,
            create: false,
            update: false,
            form: {
                id: '',
                title: '',
                start: '',
                end: '',
                color: '',
            },
        }
    },
    components: {
        AppLayout, FullCalendar, CreateForm, UpdateForm, TableData
    },
    methods: {
        setDate(start, end) {
            var data_type = typeof (start);
            if (data_type == 'string') {
                this.form.start = start;
                this.form.end = end;
            }

            this.form.title = '';
            this.index = false;
            this.update = false;
            this.create = true;
        },
        edit(event) {
            this.all_events.data.forEach((value, index) => {
                if (value.id == event) {
                    this.form.id = event;
                    this.form.title = value.title;
                    this.form.start = value.start;
                    this.form.end = value.end;
                    this.form.color = value.color;

                    this.index = false;
                    this.update = true;
                    this.create = false;
                }
            });
        },
        dataUpdate() {
            this.update = false;
            this.create = false;
            this.index = true;
        }
    }
};
</script>
