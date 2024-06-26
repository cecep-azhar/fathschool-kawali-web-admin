<template>
    <a-calendar v-model:value="value" mode="month | year" @panelChange="onPanelChange" />
</template>

<script>
import dayjs from 'dayjs';
import { Calendar } from 'ant-design-vue';

export default ({
    components: {
        'a-calendar': Calendar
    },
    props: {
        value: Date
    },
    data() {
        return {
            value: dayjs(this.value)
        }
    }
});
</script>
<style>
.ant-picker-calendar-full .ant-picker-panel .ant-picker-calendar-date {
    height: 40px !important;
    border-top: 2px solid transparent !important;
}
</style>
