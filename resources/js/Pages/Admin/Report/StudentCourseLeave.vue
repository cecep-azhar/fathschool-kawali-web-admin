<template>
  <AppLayout :title="__('Student Leave')">
    <template #header>
      {{ __('Student Leave') }}
    </template>
    <Breadcrumb>
      <BreadcrumbLink :title="__('Student Leave')" :href="route('student.leave')" />
    </Breadcrumb>
    <div>
      <page-header class="flex-col sm:flex-row">
        {{ __('Student Leave') }}
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
            <label for="course" class="ml-4 mr-2">{{ __('Course') }}:</label>
            <select v-model="filter.course_name" id="course" class="p-2 border rounded">
              <option value="">{{ __('All Courses') }}</option>
              <option v-for="course in courses" :key="course.id" :value="course.name">
                {{ course.name }}
              </option>
            </select>
            <button type="submit" class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
              {{ __('Filter') }}
            </button>
          </div>
        </form>
      </div>
      <global-table>
        <template #head>
          <th class="py-4 px-5">{{ __('Name') }}</th>
          <th class="py-4 px-5">{{ __('Class') }}</th>
          <th class="py-4 px-5">{{ __('Leave Period') }}</th>
          <th class="py-4 px-5">{{ __('Leave Type') }}</th>
          <th class="py-4 px-5">{{ __('Status') }}</th>
          <th class="py-4 px-5">{{ __('Description') }}</th>
          <th class="py-4 px-5">{{ __('Created At') }}</th>
        </template>
        <template #body>
          <template v-if="filteredLeave.length > 0">
            <template v-for="leave in filteredLeave" :key="leave.id">
              <tr class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="py-4 px-5 text-gray-900 dark:text-white">
                  {{ leave.student_name }}
                </td>
                <td class="py-4 px-5 text-gray-900 dark:text-white">
                  {{ leave.course_name }}
                </td>
                <td class="py-4 px-5 text-gray-900 dark:text-white">
                  {{ leave.leave_period }}
                </td>
                <td class="py-4 px-5 text-gray-900 dark:text-white">
                  {{ leave.type_name }}
                </td>
                <td class="py-4 px-5 text-gray-900 dark:text-white">
                  {{ leave.status }}
                </td>
                <td class="py-4 px-5 text-gray-900 dark:text-white">
                  {{ leave.description }}
                </td>
                <td class="py-4 px-5 text-gray-900 dark:text-white">
                  {{ leave.created_date }}
                </td>
              </tr>
            </template>
          </template>
          <template v-else>
            <tr>
              <td colspan="7" class="text-center p-4">
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
import { ref, onMounted } from 'vue';
import { useForm } from "@inertiajs/inertia-vue3";
import axios from 'axios';

export default {
  components: {
    AppLayout,
    Breadcrumb,
    BreadcrumbLink,
    NothingFound,
    ExportModal,
  },
  props: {
    studentLeaves: {
      type: Array,
      required: true,
    },
    courses: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      loading: false,
      filter: {
        name: '',
        month: '',
        course_name: '', // Filter berdasarkan nama kursus
      },
      export_options: [],
      visible: false,
      export_visible: false,
      show_user: '',
      export_data: useForm({
        type: 'Excel',
        course: 'all',
        course_id: '',
      }),
    };
  },
  computed: {
    filteredLeave() {
      return this.studentLeaves.filter((leave) => {
        let nameMatch = true;
        let monthMatch = true;
        let courseMatch = this.filter.course_name ? leave.course_name === this.filter.course_name : true;

        if (this.filter.name.trim() !== '') {
          nameMatch = leave.student_name.toLowerCase().includes(this.filter.name.trim().toLowerCase());
        }

        if (this.filter.month !== '') {
          let leaveMonth = new Date(leave.created_date).toISOString().slice(0, 7);
          monthMatch = leaveMonth === this.filter.month;
        }

        return nameMatch && monthMatch && courseMatch;
      });
    },
  },
  methods: {
    filterData() {
      axios.get(this.route('student.leave'), {
        params: this.filter,
      })
        .then((response) => {
          this.studentLeaves = response.data;
        })
        .catch((error) => {
          console.error(error);
        });
    },
    exportSubmit() {
      this.loading = true;
      let exportData = {};

      if (this.filter.name.trim() !== '') {
        exportData.name = this.filter.name.trim();
      }

      if (this.filter.month !== '') {
        exportData.month = this.filter.month;
      }

      if (this.filter.course_name !== '') {
        let selectedCourse = this.courses.find((course) => course.name === this.filter.course_name);
        if (selectedCourse) {
          exportData.course_id = selectedCourse.id;
        }
      }

      axios({
        url: this.route('student.leave.export'),
        method: 'POST',
        data: {
          ...this.export_data,
          ...exportData,
        },
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        responseType: 'blob',
      })
        .then((response) => {
          let extension = this.export_data.type;
          var fileURL = window.URL.createObjectURL(new Blob([response.data]));
          var fileLink = document.createElement('a');

          fileLink.href = fileURL;
          fileLink.setAttribute('download', 'teacherattendance-report.' + 'xlsx');
          document.body.appendChild(fileLink);

          fileLink.click();

          this.loading = false;
          this.visible = false;
        })
        .catch((e) => {
          this.loading = false;
          this.visible = false;
        });
    },
  },
};
</script>

<style scoped>
.course {
  margin-bottom: 20px;
}
</style>
