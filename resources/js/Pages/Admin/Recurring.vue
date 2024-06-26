<template>
    <AppLayout :title="__('Event')">
        <Breadcrumb>
            <BreadcrumbLink :title="__('Event')"/>
        </Breadcrumb>

        <div class="pb-12">
            <page-header >
                <div class="dark:text-gray-400">
                    {{ __('Event') }}
                </div>
            </page-header>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- calendar -->
                <div class="col-span-2 bg-white rounded-lg overflow-x-auto dark:bg-gray-800 p-6">
                    <FullCalendar :options="calendarOptions" class="min-w-[991px]" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import '@fullcalendar/core/vdom'
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import listPlugin from '@fullcalendar/list'
import interactionPlugin, { Draggable } from "@fullcalendar/interaction";
import dayjs, { Dayjs } from 'dayjs';

export default {
    props:{
        schedules:{
            type: Array
        }
    },
    components: {
        AppLayout,
        FullCalendar
    },
    data() {
        return {
            calendarOptions: {
                locale: this.$page.props.locale,
                plugins: [ dayGridPlugin, timeGridPlugin, listPlugin, interactionPlugin],
                initialView: 'timeGridWeek',
                selectable: true,
                editable: true,
                buttonText: {
                    prev: this.__('prev'),
                    next: this.__('next'),
                    today: this.__('today'),
                    month: this.__('month'),
                    week: this.__('week'),
                    day: this.__('day'),
                    list: this.__('list'),
                },
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,dayGridWeek,timeGridWeek,timeGridDay'
                },
                // firstDay: this.$page.props.start_day_of_week,
                events: this.schedules,
                eventContent: function(arg) {
                    return {
                        html: arg.event.title.replace(/<br>/g, '<br>')
                    }
                },
                eventDrop: this.eventDropped,
                eventResize: this.eventResized,
            },

            form: this.$inertia.form({
                id: '',
                weekday: '',
                start_time: '',
                end_time: '',
                type: '',
            }),
        }
    },
    methods: {
        eventDropped(arg){
            let event = arg.event
            let startTime = event.startStr
            let endTime = event.endStr

            this.form.id = event.id
            this.form.weekday = dayjs(startTime).format('d')
            this.form.start_time = dayjs(startTime).format('HH:mm:ss')
            this.form.end_time = dayjs(endTime).format('HH:mm:ss')
            this.form.type = 'api'
            this.updateData()
        },
        eventResized(arg){
            let event = arg.event
            let startTime = event.startStr
            let endTime = event.endStr

            this.form.id = event.id
            this.form.weekday = dayjs(startTime).format('d')
            this.form.start_time = dayjs(startTime).format('HH:mm:ss')
            this.form.end_time = dayjs(endTime).format('HH:mm:ss')
            this.form.type = 'api'
            this.updateData()
        },
        async updateData(){
            let response = await axios.put(route('routine.update', this.form.id), this.form)
        }
    }
}
</script>
