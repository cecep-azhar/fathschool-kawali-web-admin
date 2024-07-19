<template>
  <AppLayout :title="__('Teacher Rating')">
    <template #header>
      {{ __('Teacher Rating') }}
    </template>
    <Breadcrumb>
      <BreadcrumbLink :title="__('Teacher Rating')" :href="route('teacher.rating')" />
    </Breadcrumb>
    <div>
      <page-header class="flex-col sm:flex-row">
        {{ __('Teacher Rating') }}
        <template #content>
          <div class="flex flex-col sm:flex-row gap-4">
            <global-button :loading="false" @click="exportSubmit()" type="button" theme="sky">
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
          <th class="py-4 px-5">{{ __('Class') }}</th>
          <th class="py-4 px-5">{{ __('Rating') }}</th>
          <th class="py-4 px-5">{{ __('Comment') }}</th>
          <th class="py-4 px-5">{{ __('Created At') }}</th>
        </template>
        <template #body>
          <template v-if="filteredRating.length > 0">
            <template v-for="rating in filteredRating" :key="rating.id">
              <tr class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="py-4 px-5 text-gray-900 dark:text-white">
                  {{ rating.teacher_name }}
                </td>
                <td class="py-4 px-5 text-gray-900 dark:text-white">
                  {{ rating.course_name }}
                </td>
                <td class="py-4 px-5 text-gray-900 dark:text-white">
                  {{ rating.rating }}
                </td>
                <td class="py-4 px-5 text-gray-900 dark:text-white">
                  {{ rating.comment }}
                </td>
                <td class="py-4 px-5 text-gray-900 dark:text-white">
                  {{ rating.created_date }}
                </td>
              </tr>
            </template>
          </template>
          <template v-else>
            <tr>
              <td colspan="6" class="text-center p-4">
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
    teacherRatings: {
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
    const teacherRatings = ref(props.teacherRatings);

    return {
      teacherRatings,
    };
  },
  computed: {
    // Menghitung data yang sudah difilter berdasarkan nama dan bulan
    filteredRating() {
      return this.teacherRatings.filter(rating => {
        let nameMatch = true;
        let monthMatch = true;

        // Filter berdasarkan nama
        if (this.filter.name.trim() !== '') {
          nameMatch = rating.teacher_name.toLowerCase().includes(this.filter.name.trim().toLowerCase());
        }

        // Filter berdasarkan bulan
        if (this.filter.month !== '') {
          let ratingMonth = new Date(rating.created_date).toISOString().slice(0, 7);
          monthMatch = ratingMonth === this.filter.month;
        }

        return nameMatch && monthMatch;
      });
    }
  },
  methods: {
    exportSubmit() {
      this.loading = true;
      let exportData = {
        type: this.export_data.type,
        course: this.export_data.course
      };

      // Jika ada filter nama yang aktif
      if (this.filter.name.trim() !== '') {
        exportData.name = this.filter.name.trim();
      }

      // Jika ada filter bulan yang aktif
      if (this.filter.month !== '') {
        exportData.month = this.filter.month;
      }

      axios.post(this.route('rateteacher.export'), exportData, {
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        responseType: "blob"
      }).then((response) => {
        let extension = this.export_data.type;
        var fileURL = window.URL.createObjectURL(new Blob([response.data]));
        var fileLink = document.createElement("a");

        fileLink.href = fileURL;
        fileLink.setAttribute("download", "ratingteacher-report." + 'xlsx');
        document.body.appendChild(fileLink);

        fileLink.click();

        this.loading = false;
        this.export_visible = false;
      }).catch((e) => {
        this.loading = false;
        this.export_visible = false;
      });
    }
  }
};
</script>

<style scoped>
.course {
  margin-bottom: 20px;
}
</style>
