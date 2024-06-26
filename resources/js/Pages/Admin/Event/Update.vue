<template>
    <form @submit.prevent="submit()" class="p-6 dark:bg-gray-800 dark:text-gray-400">
        <div class="w-full">
            <div class="mb-3">
                <global-label for="name" value="Event Name" :required="false" />
                <global-input v-model="form.name" type="text" id="name"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                    :placeholder="__('Name')" :error="$page.props.errors.name" />
                <input-error :error="$page.props.errors.name" />
            </div>
            <div class="mb-3">
                <global-label for="name" value="Date" :required="false" />
                <a-range-picker :class="$page.props.errors.date ? 'border-custom' : ''" name="date"
                    class="custom-input dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400"
                    :disabled-date="disabledDate" :disabled-time="disabledRangeTime" v-model:value="form.date"
                    :format="customDateFormat" />
                <input-error :error="$page.props.errors.date" />
            </div>
            <div class="flex items-center mb-3">
                <div class="w-full relative">
                    <global-input type="text" id="color" v-model="form.color"
                        class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                        :placeholder="__('Name')" :error="$page.props.errors.color" />
                    <div class="w-10 h-[42px] rounded-r absolute top-1 right-0"
                        :style="`background: ${form.color}; color: white`"></div>
                </div>
                <div class="relative ml-3">
                    <button type="button" @click="isOpenColorPicker = !isOpenColorPicker"
                        class="w-10 h-10 rounded-full focus:outline-none focus:shadow-outline inline-flex p-2 shadow"
                        :style="`background: ${form.color}; color: white`">
                        <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path fill="none" d="M15.584 10.001L13.998 8.417 5.903 16.512 5.374 18.626 7.488 18.097z" />
                            <path
                                d="M4.03,15.758l-1,4c-0.086,0.341,0.015,0.701,0.263,0.949C3.482,20.896,3.738,21,4,21c0.081,0,0.162-0.01,0.242-0.03l4-1 c0.176-0.044,0.337-0.135,0.465-0.263l8.292-8.292l1.294,1.292l1.414-1.414l-1.294-1.292L21,7.414 c0.378-0.378,0.586-0.88,0.586-1.414S21.378,4.964,21,4.586L19.414,3c-0.756-0.756-2.072-0.756-2.828,0l-2.589,2.589l-1.298-1.296 l-1.414,1.414l1.298,1.296l-8.29,8.29C4.165,15.421,4.074,15.582,4.03,15.758z M5.903,16.512l8.095-8.095l1.586,1.584 l-8.096,8.096l-2.114,0.529L5.903,16.512z" />
                        </svg>
                    </button>

                    <div v-if="isOpenColorPicker" v-click-outside="() => (isOpenColorPicker = false)"
                        class="origin-top-right absolute right-16 mt-2 w-40 rounded-md shadow-lg">
                        <div class="rounded-md bg-white shadow-xs px-4 py-3">
                            <div class="flex flex-wrap -mx-2">
                                <ColorPicker theme="dark" :color="form.color" :sucker-hide="true" @changeColor="changeColor"
                                    @openSucker="openSucker" :colors-default="swatches" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex gap-2">
            <global-button :loading="loading" type="submit" theme="primary">
                Update
            </global-button>
            <Link preserve-scroll :href="route('event.index')" class="hover:text-gray-500">
            <back-button />
            </Link>
        </div>
    </form>
</template>

<script>
import dayjs, { Dayjs } from 'dayjs';
import { ColorPicker } from "vue-color-kit";
import "vue-color-kit/dist/vue-color-kit.css";
export default {
    props: {
        data: Object,
    },
    components: {
        ColorPicker,
    },
    data() {
        return {
            customDateFormat: 'DD-MM-YYYY',
            form: this.$inertia.form({
                name: this.data.title,
                color: this.data.color,
                date: [
                    this.data.start ? dayjs(this.data.start, this.customDateFormat) : '',
                    this.data.end ? dayjs(this.data.end, this.customDateFormat) : '',
                ],
                _method: "PUT",
            }),
            isOpenColorPicker: false,
            isSucking: true,
            swatches: [
                "#1A535C",
                "#C93737",
                "#E5940E",
                "#9F9F0F",
                "#588157",
                "#00A300",
                "#169494",
                "#1E68B1",
                "#0E0E96",
                "#6717B7",
                "#AE14AE",
                "#D00053",
                "#283618",
                "#5E6D81",
            ],
        };
    },
    watch: {
        data: {
            deep: true,
            handler(val, oldVal) {
                this.form.name = this.data.title;
                this.form.date = [
                    dayjs(val.start),
                    dayjs(val.end),
                ]
            },
        },
    },
    methods: {
        submit() {
            this.form.post(this.route("event.update", this.data.id), {
                onSuccess: (page) => {
                    this.form.reset();
                    this.$emit("update");
                },
            });
        },
        changeColor(color) {
            this.form.color = color.hex;
        },
    },
};
</script>
<style scoped>
.custom-input {
    font-size: 0.875rem;
    line-height: 1.25rem;
    padding-top: 0.625rem;
    padding-bottom: 0.625rem;
    padding-right: 0.625rem;
    padding-left: 1rem;
    border-radius: 0.5rem;
    width: 100%;
}

.border-custom {
    border-color: red;
    border-right-width: 1px !important;
}
</style>
