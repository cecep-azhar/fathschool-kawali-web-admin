<template>
  <AppLayout :title="__('Teacher Attendance')">
    <template #header>
      {{ __('Teacher Attendance') }}
    </template>
    <Breadcrumb>
      <BreadcrumbLink :title="__('All Attendance')" :href="route('teacher.attendance')" />
    </Breadcrumb>
    <div>
      <page-header class="flex-col sm:flex-row">
        {{ __('All Attendance') }}
            <template #content>
                <div class="flex flex-col sm:flex-row gap-4">
                    <global-button :loading="false" @click="exportTeacher()" type="button" theme="sky">
                        {{ __('Export') }}
                    </global-button>
                </div>
            </template>
      </page-header>
      <div class="mb-4">
        <!-- Form pencarian bisa ditambahkan di sini jika diperlukan -->
      </div>
      <global-table>
        <template #head>
          <th class="py-4 px-5">{{ __('Name') }}</th>
          <th class="py-4 px-5">{{ __('Date') }}</th>
          <th class="py-4 px-5">{{ __('Time In') }}</th>
          <th class="py-4 px-5">{{ __('Time Out') }}</th>
          <th class="py-4 px-5">{{ __('Latlon In') }}</th>
          <th class="py-4 px-5">{{ __('Latlon Out') }}</th>
        </template>
        <template #body>
          <template v-if="attendanceteacher.length > 0">
            <template v-for="attendance in attendanceteacher" :key="attendance.id">
              <tr class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="py-4 px-5 text-gray-900 dark:text-white">
                  {{ attendance.user.name  }}
                </td>
                <td class="py-4 px-5 text-gray-900 dark:text-white">
                  {{ attendance.date }}
                </td>
                <td class="py-4 px-5 text-gray-900 dark:text-white">
                  {{ attendance.time_in }}
                </td>
                <td class="py-4 px-5 text-gray-900 dark:text-white">
                  {{ attendance.time_out }}
                </td>
                <td class="py-4 px-5 text-gray-900 dark:text-white">
                  {{ attendance.latlon_in }}
                </td>
                <td class="py-4 px-5 text-gray-900 dark:text-white">
                  {{ attendance.latlon_out }}
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
import { ref } from 'vue';

export default {
  components: {
    AppLayout,
    Breadcrumb,
    BreadcrumbLink,
    NothingFound,
  },
  props: {
    attendanceteacher: {
      type: Array,
      required: true,
    },
  },
  setup(props) {
    const attendanceteacher = ref(props.attendanceteacher);

    return {
      attendanceteacher,
    };
  },
  methods: {
        exportTeacher() {
            this.export_visible = true;
        },
        exportSubmit() {
            this.loading = true;
            axios({
                url: this.route('teacherattendance.export'),
                method: "POST",
                data: this.export_data,
                responseType: "blob",
            }).then((response) => {

                let extension = this.export_data.type;

                var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                var fileLink = document.createElement("a");

                fileLink.href = fileURL;
                fileLink.setAttribute("download", "teacherattendance-report." + 'xlsx');
                document.body.appendChild(fileLink);

                fileLink.click();

                this.loading = false;
                this.visible = false;
            }).catch((e) => {
                this.loading = false;
                this.visible = false;
            });
        }
    },
};
</script>

<style scoped>
.course {
  margin-bottom: 20px;
}
</style>
