<template>
    <Head :title="__('Holiday List')" />
    <AppLayout>
        <Breadcrumb>
            <BreadcrumbLink :title="__('Holiday')"/>
        </Breadcrumb>

        <div class="mx-auto pb-12">
            <page-header>
                {{ __('Holiday List') }}
            </page-header>
            <div class="grid grid-cols-1 items-start md:grid-cols-3 gap-6">
                <!-- calendar -->
                <div class="col-span-2 bg-white rounded-lg overflow-x-auto dark:bg-gray-800">
                    <FullCalendar ref="calendar" class="p-6 min-w-[991px]" :options="calendarOptions" />
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg">
                    <template v-if="index">
                        <div
                            class="flex justify-between px-6 items-center pt-6 text-gray-900 dark:text-gray-400 text-base font-bold">
                            <div>
                                {{ __('Holiday List') }}
                            </div>
                            <global-button v-if="can('holiday.create')" :loading="false" @click="setDate" type="button"
                             theme="primary">
                                {{ __('Create') }}
                            </global-button>
                        </div>
                    </template>
                    <template v-if="create">
                        <h2 class="p-3 flex justify-between items-center mt-2 text-gray-900 dark:text-gray-400 text-base font-bold mb-0">
                            <div>{{ __('Create New Holiday') }}</div>
                            <Link preserve-scroll :href="route('holiday.index')" class="hover:text-gray-500">
                            <back-button />
                            </Link>
                        </h2>
                    </template>
                    <template v-if="update">
                        <h2
                            class="px-6 pt-6 flex justify-between mt-2 text-gray-900 dark:text-gray-400 text-base font-bold mb-0">
                            <div>{{ __('Update') }}</div>
                        </h2>
                    </template>
                    <!-- Second Hap => Create|Update|Index  -->
                    <template v-if="index">
                        <table-data @edit="edit" :holidays="holidays" />
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
import '@fullcalendar/core/vdom'
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import listPlugin from '@fullcalendar/list'
import interactionPlugin from '@fullcalendar/interaction'
import CreateForm from './Create.vue'
import UpdateForm from './Update.vue'
import TableData from './Table.vue';

export default {
    props: {
        holidays: Array
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
            },
            calendarOptions: {
                locale: this.$page.props.locale,
                plugins: [
                    dayGridPlugin,
                    timeGridPlugin,
                    listPlugin,
                    interactionPlugin
                ],
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,dayGridWeek'
                },
                buttonText: {
                    prev: this.__('prev'),
                    next: this.__('next'),
                    today: this.__('today'),
                    month: this.__('month'),
                    week: this.__('week'),
                    day: this.__('day'),
                    list: this.__('list'),
                },
                // firstDay: this.$page.props.start_day_of_week,
                editable: true,
                selectable: true,
                weekends: true,
                select: (arg) => {
                    this.setDate(arg.startStr, arg.endStr);
                },
                eventClick: (arg) => {
                    this.edit(arg.event._def.publicId);
                },
                initialView: 'dayGridMonth',
                events: this.holidays,
                eventDrop: this.eventDropped,
                eventResize: this.eventResized,
            }
        }
    },
    components: {
        AppLayout, FullCalendar, CreateForm, UpdateForm, TableData
    },
    watch: {
        holidays: {
            handler(val, oldVal) {
                this.calendarOptions.events = val;
            },
            deep: true,
            immediate: true,
        },
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
            this.holidays.forEach((value, index) => {
                if (value.id == event) {
                    this.form.id = event;
                    this.form.title = value.title;
                    this.form.start = value.start;
                    this.form.end = value.end;
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
        },
          eventDropped(arg){
            let event = arg.event
            this.form.id = event.id
            this.form.title = event.title
            this.form.start = event.startStr
            this.form.end = event.endStr
            this.updateEvent();
        },
        eventResized(arg){
            let event = arg.event
            this.form.id = event.id
            this.form.title = event.title
            this.form.start = event.startStr
            this.form.end = event.endStr
            this.updateEvent();
        },
        async updateEvent(){
            await axios.put(route('holiday.resized', this.form.id), this.form)
            window.location.reload();
        }
    }
};
</script>
