<template>

    <Head :title="__('Schedule List')" />
    <AppLayout>
        <Breadcrumb>
            <BreadcrumbLink :title=" __('Schedule')"/>
        </Breadcrumb>

        <div class="pb-12">
            <page-header >
                <div class="dark:text-gray-400">
                    {{ __('Schedule') }}
                </div>
            </page-header>
            <div class="w-full">
                <!-- calendar -->
                <div class=" bg-white overflow-x-auto rounded-lg dark:bg-gray-800 p-6">
                    <FullCalendar ref="calendar" class="p-6 min-w-[991px]" :options="calendarOptions" />
                </div>
            </div>
        </div>
        <create-update-form :data="form" ref="form" />
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
import CreateUpdateForm from './Form.vue'

export default {
    props: {
        schedules: Object,
    },
    data() {
        return {
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
                    this.create('', arg.startStr, arg.endStr)
                },
                eventClick: (arg) => {
                    this.form.update = true;
                    this.form.id = arg.event.id;
                    this.create(arg.event.title, arg.event.startStr, arg.event.endStr)
                },
                weekends: true,
                initialView: 'dayGridMonth',
                events: this.schedules
            },
            form: {
                update: false,
                id: '',
                title: '',
                start: '',
                end: '',
            }
        }
    },
    watch: {
        schedules: {
            handler(val, oldVal) {
                this.calendarOptions.events = val;
            },
            deep: true,
            immediate: true,
        },
    },
    components: {
        AppLayout,
        FullCalendar,
        CreateUpdateForm,
    },
    methods: {
        create(title, start, end) {
            this.form.title = title;
            this.form.start = start;
            this.form.end = end;
            this.$refs.form.showModal();
        },

    }
};
</script>
