<template>
    <FullCalendar ref="calendar" class="p-6 min-w-[991px]" :options="calendarOptions" />
</template>

<script>
import "@fullcalendar/core/vdom";
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import listPlugin from "@fullcalendar/list";
import interactionPlugin from "@fullcalendar/interaction";
export default {
    props: {
        data: Object
    },
    components: {
        FullCalendar,
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
                height: 800,
                initialView: 'dayGridMonth',
                events: this.data,
                eventContent: function(arg) {
                    return {
                        html: arg.event.title.replace(/<br>/g, '<br>')
                    }
                },
            },
        }
    }
}
</script>

<style>

</style>
