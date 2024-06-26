<template>
    <AppLayout :title="__('Class Schedule')">
        <Breadcrumb>
            <BreadcrumbLink :title=" __('Class Schedule')"/>
        </Breadcrumb>

        <div >
            <page-header class="flex items-center justify-between">
                {{ __('Class Schedule') }}
            </page-header>
            <div class="col-span-2 bg-white overflow-x-auto rounded-lg dark:bg-gray-800 p-6">
                <FullCalendar :options="calendarOptions" class="min-w-[991px]" />
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from '@/Shared/Admin/Pagination.vue';
import ToolTip from '@/Shared/ToolTip.vue';
import '@fullcalendar/core/vdom'
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'

export default {
    components: {
        AppLayout,
        ToolTip,
        Pagination,
        ToolTip,
        FullCalendar,
    },
    props: {
        routines: Object,
        schedules:Array,
    },
    data() {
        return {
            calendarOptions: {
                locale: this.$page.props.locale,
                plugins: [ dayGridPlugin, timeGridPlugin],
                initialView: 'timeGridDay',
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
                    right: 'dayGridMonth,timeGridWeek,timeGridDay' // dayGridMonth,timeGridWeek,dayGridDay
                },
                // firstDay: this.$page.props.start_day_of_week,
                events: this.schedules,
                eventContent: function(arg) {
                    return {
                        html: arg.event.title.replace(/<br>/g, '<br>')
                    }
                },
            }
        };
    }
};
</script>

