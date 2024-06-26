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

export default {
    props:{
        holidays:{
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
                initialView: 'dayGridMonth',
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
                    right: 'dayGridMonth,dayGridWeek,timeGridDay'
                },
                events:
                    this.holidays
                ,
                // firstDay: this.$page.props.start_day_of_week,
                eventDrop: this.eventDropped,
                eventResize: this.eventResized,
            },

            form: this.$inertia.form({
                id: '',
                title: '',
                start: '',
                end: '',
            }),
        }
    },
    methods: {
        handleDateClick: function(arg) {
            alert('date click! ' + arg.dateStr)
        },
        eventClick: function(arg) {
            alert('date click! ' + arg.dateStr)
        },
        select(arg){
            const cal = arg.view.calendar
            cal.unselect()
            cal.Event({
                id: `${id.value}`,
                title: `New event ${id.value}`,
                start: arg.start,
                end: arg.end,
            })
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
            await axios.put(route('holiday.update', this.form.id), this.form)
        }
    }
}
</script>
