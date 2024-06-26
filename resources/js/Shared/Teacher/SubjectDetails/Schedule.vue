
<template>
    <div class="dark:text-gray-400 px-6 py-4 rounded-lg bg-white dark:bg-gray-800 font-semibold text-base mb-5">
        {{ __('Course Schedule') }}
    </div>
    <div class="overflow-x-auto relative rounded-lg">
        <div class="col-span-2 bg-white overflow-x-auto rounded-lg dark:bg-gray-800 p-6">
            <FullCalendar :options="calendarOptions" class="min-w-[991px]" />
        </div>
    </div>
</template>

<script>
import '@fullcalendar/core/vdom'
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import listPlugin from '@fullcalendar/list'
import interactionPlugin, { Draggable } from "@fullcalendar/interaction";

export default {
    props: {
        schedules: Object,
    },
    components: { FullCalendar, },
    data() {
        return {
            calendarOptions: {
                locale: this.$page.props.locale,
                plugins: [dayGridPlugin, timeGridPlugin, listPlugin, interactionPlugin],
                initialView: 'timeGridWeek',
                selectable: false,
                editable: false,
                height: 800,
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
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                // firstDay: this.$page.props.start_day_of_week,
                events: this.schedules,
                eventContent: function (arg) {
                    return {
                        html: arg.event.title.replace(/<br>/g, '<br>')
                    }
                },
            },
        };
    },
    methods: {
    }
};
</script>
<style scoped>
</style>
