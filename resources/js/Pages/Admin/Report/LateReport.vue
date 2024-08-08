<template>
    <AppLayout :title="__('Teacher Lateness Report')">
      <template #header>
        {{ __('Teacher Lateness Report') }}
      </template>
      <Breadcrumb>
        <BreadcrumbLink :title="__('Teacher Lateness Report')" :href="route('teacher.lateness.report')" />
      </Breadcrumb>
      <div>
        <page-header class="flex-col sm:flex-row">
          {{ __('Teacher Lateness Report') }}
          <template #content>
            <div class="flex flex-col sm:flex-row gap-4">
              <global-button :loading="loading" @click="exportSubmit()" type="button" theme="sky">
                {{ __('Export') }}
              </global-button>
            </div>
          </template>
        </page-header>
        <div class="mb-4">
          <form @submit.prevent="filterData">
            <div class="flex items-center">
              <input type="text" v-model="filter.name" id="name" placeholder="Name" class="p-2 border rounded">
              <label for="month" class="ml-4 mr-2">{{ __('Month') }}:</label>
              <input type="month" v-model="filter.month" id="month" class="p-2 border rounded">
              <button type="submit" class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ __('Filter') }}
              </button>
            </div>
          </form>
        </div>
        <global-table>
          <template #head>
            <th class="py-4 px-5">{{ __('Name') }}</th>
            <th class="py-4 px-5">{{ __('Time In') }}</th>
            <th class="py-4 px-5">{{ __('Date') }}</th>
          </template>
          <template #body>
            <template v-if="filteredAttendees.length > 0">
              <template v-for="attendance in filteredAttendees" :key="attendance.id">
                <tr class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                  <td class="py-4 px-5 text-gray-900 dark:text-white">
                    {{ attendance.name }}
                  </td>
                  <td class="py-4 px-5 text-gray-900 dark:text-white">
                    {{ attendance.time_in }}
                  </td>
                  <td class="py-4 px-5 text-gray-900 dark:text-white">
                    {{ attendance.date }}
                  </td>
                </tr>
              </template>
            </template>
            <template v-else>
              <tr>
                <td colspan="3" class="text-center p-4">
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
import NothingFound from "@/Shared/NothingFound.vue";
import ExportModal from "@/Shared/Modal.vue";
import { ref } from 'vue';
import { useForm } from "@inertiajs/inertia-vue3";
import axios from 'axios';

export default {
    components: {
        AppLayout,
        Breadcrumb,
        BreadcrumbLink,
        NothingFound,
        ExportModal
    },
    props: {
        LateAttendances: {
            type: Array,
            required: true,
        },
    },
    data() {
      return {
        loading: false,
        options: [],
        options2: [],
        export_options: [],
        visible: false,
        export_visible: false,
        show_user: "",
        export_data: useForm({
            type: 'Excel',
            course: 'all'
        }),
        filter: {
            name: '',
            month: ''
        }
      };
    },
    setup(props) {
        const LateAttendances = ref(props.LateAttendances);

        return {
            LateAttendances,
        };
    },
    computed: {

      filteredAttendees() {
        return this.LateAttendances.filter(attendance => {
          let nameMatch = true;
          let monthMatch = true;

          if (this.filter.name.trim() !== '') {
            nameMatch = attendance.name.toLowerCase().includes(this.filter.name.trim().toLowerCase());
          }

          if (this.filter.month !== '') {
            let attendanceMonth = new Date(attendance.date).toISOString().slice(0, 7);
            monthMatch = attendanceMonth === this.filter.month;
          }

          return nameMatch && monthMatch;
        });
      },
    },
    methods: {
      filterData() {
        axios.get(this.route('teacher.lateness.report'), {
          params: this.filter,
        })
          .then((response) => {
            this.attendees = response.data;
          })
          .catch((error) => {
            console.error(error);
          });
      },
      exportSubmit() {
        this.loading = true;
        axios({
          url: this.route('teacher.lateness.export'),
          method: 'POST',
          data: this.filter,
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          },
          responseType: 'blob',
        })
          .then((response) => {
            const fileURL = window.URL.createObjectURL(new Blob([response.data]));
            const fileLink = document.createElement('a');
            fileLink.href = fileURL;
            fileLink.setAttribute('download', 'teacher-lateness-report.xlsx');
            document.body.appendChild(fileLink);
            fileLink.click();
            this.loading = false;
          })
          .catch((error) => {
            this.loading = false;
            console.error(error);
          });
      },
    },
};
</script>

  <style scoped>
  /* Add any specific styles for the component here */
  </style>
