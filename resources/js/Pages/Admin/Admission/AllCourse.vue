<template>
    <AppLayout :title="__('Class QR Codes')">
        <template #header>
            {{ __('Class QR Codes') }}
        </template>
        <Breadcrumb>
            <BreadcrumbLink :title="__('All Courses')" :href="route('class.qr.all')" />
        </Breadcrumb>

        <div>
            <page-header class="flex-col sm:flex-row">
                {{ __('All Courses') }}
                <template #content>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <!-- Tambahkan tombol-tombol sesuai kebutuhan -->
                    </div>
                </template>
            </page-header>
            <div class="mb-4">
                <!-- Form pencarian bisa ditambahkan di sini jika diperlukan -->
            </div>
            <global-table>
                <template #head>
                    <th class="py-4 px-5">{{ __('Name') }}</th>
                    <th class="py-4 px-5">{{ __('QR Code') }}</th>
                </template>
                <template #body>
                    <template v-if="courses.length > 0">
                        <template v-for="course in courses" :key="course.id">
                            <tr class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="py-4 px-5 text-gray-900 dark:text-white">
                                    {{ course.name }}
                                </td>
                                <td class="py-4 px-5">
                                    <img :src="course.qr_code" alt="QR Code for {{ course.name }}" />
                                </td>
                            </tr>
                        </template>
                    </template>
                    <template v-else>
                        <tr>
                            <td colspan="2" class="text-center p-4">
                                <NothingFound asShow="div" />
                            </td>
                        </tr>
                    </template>
                </template>
            </global-table>
            <div class="flex justify-center">
                <!-- Pagination bisa ditambahkan di sini jika diperlukan -->
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Breadcrumb from "@/Shared/Breadcrumb.vue";
import BreadcrumbLink from "@/Shared/BreadcrumbLink.vue";
import GlobalTable from "@/Shared/GlobalTable.vue";
import NothingFound from "@/Shared/NothingFound.vue";
import { ref } from 'vue';

export default {
    components: {
        AppLayout,
        Breadcrumb,
        BreadcrumbLink,
        GlobalTable,
        NothingFound,
    },
    props: {
        courses: {
            type: Array,
            required: true,
        },
    },
    setup(props) {
        // Misalnya jika ada data yang di-passing dari Laravel
        const courses = ref(props.courses);

        return {
            courses,
        };
    },
};
</script>
