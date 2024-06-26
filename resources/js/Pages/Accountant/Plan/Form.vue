<template>
    <AppLayout :title="__('Add New Plan')">
        <Breadcrumb>
            <BreadcrumbLink :title=" __('Add New Plan')" />
        </Breadcrumb>
        <div>
            <page-header>
                {{ __('Add New Plan') }}
                <template #content>
                    <global-button :url="route('plan.index')" :loading="false" type="link" theme="primary">
                        {{ __('All Plan') }}
                    </global-button>
                </template>
            </page-header>
        </div>
        <form @submit.prevent="submit">
            <div
                class="max-w-2xl flex flex-col gap-5 mx-auto px-4 rounded bg-white dark:bg-gray-800 p-5 dark:border-gray-700">
                <div>
                    <div>
                        <global-label for="title" value="Title" :required="true" />
                        <global-input type="text" id="title" v-model="form.title" name="title"
                            class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                            :placeholder="__('Title')" :error="$page.props.errors.title" />
                        <input-error :error="$page.props.errors.title" />
                    </div>
                    <div class="mt-3">
                        <global-label for="course" value="Course" :required="true" />
                        <Multiselect id="course" :close-on-select="true" :can-clear="true" :searchable="true"
                            v-model="form.course" :create-option="false" placeholder="Course" :options="courses.map(item => ({
                                value: item.id, label: item.name
                            }))" autocomplete="off" />
                        <input-error :error="$page.props.errors.course" />
                    </div>
                    <div class="mt-3">
                        <global-label for="currency" value="Currency" :required="true" />
                        <Multiselect id="currency" :close-on-select="true" :can-clear="true" :searchable="true"
                            v-model="form.currency" :create-option="false" placeholder="Currency" :options="currencies.map(item => ({
                                value: item.code, label: item.name
                            }))" autocomplete="off" />
                        <input-error :error="$page.props.errors.currency" />
                    </div>
                    <div class="mt-3">
                        <global-label for="description" value="Description" :required="false" />
                        <global-textarea id="description" v-model="form.description" name="description"
                            class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400"
                            :placeholder="__('Description')" :error="$page.props.errors.description" />
                        <input-error :error="$page.props.errors.description" />
                    </div>
                    <div class="mt-4"></div>
                    <div v-for="(item, index) in  benefit_amount" :key="index" :class="index != 0 ? 'mt-3' : ''">
                        <div class="flex items-left justify-between">
                            <global-label for="title" class="w-full" value="Benefit" :required="true" />
                            <global-label for="title" class="w-4/12" value="Amount" :required="true" />
                        </div>
                        <div class="flex items-left justify-between -mt-1">
                            <global-input type="text" id="title" v-model="form.benefits[index]" name="title"
                                class="mt-1 block w-full rounded-r-none dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400 testBenefits"
                                :placeholder="__('Benefit')" :error="$page.props.errors.benefits" />
                            <global-input type="number" id="title" v-model="form.amounts[index]" name="title"
                                class="mt-1 block w-4/12 dark:bg-gray-700 dark:border-gray-600 rounded-l-none dark:text-gray-400 testAmounts"
                                :placeholder="__('Amount')" :error="$page.props.errors.amounts" />
                        </div>
                        <input-error :error="$page.props.errors.benefits" />
                        <button v-if="index != 0" @click="removeBenefit(index)" type="button"
                            class="text-red-500 mt-1 hover:text-red-600">
                            {{ __('Remove Benefit') }}
                        </button>
                    </div>
                    <div @click="addBenefit()" class="flex justify-end"
                        :class="benefit_amount.length > 1 ? '-mt-[22px]' : 'mt-1'">
                        <button type="button" class="text-blue-500 hover:text-blue-600">
                            {{ __('Add New Benefit') }}
                        </button>
                    </div>
                </div>
                <div class="flex justify-center items-center -mt-2">
                    <global-button :loading="form.processing" type="submit" cssClass="w-full mb-4" theme="primary">
                        {{ plan ? __('Update') : __('Submit') }}
                    </global-button>
                </div>
            </div>
        </form>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from '@inertiajs/inertia-vue3'
import Multiselect from '@vueform/multiselect'
import '@vueform/multiselect/themes/default.css';

export default {
    components: { Multiselect, AppLayout },
    props: {
        courses: Object,
        plan: Object,
        benefits: Array,
        amounts: Array,
        plan_courses: Array,
        currencies: Array
    },
    data() {
        return {
            benefit_amount: [1],
            form: useForm({
                title: this.plan ? this.plan.title : '',
                description: this.plan ? this.plan.description : '',
                course: this.plan ? this.plan.course_id : '',
                benefits: this.benefits ?? [],
                amounts: this.amounts ?? [],
                currency: this.plan ? this.plan.currency : '',
                _method: this.plan ? "PUT" : "POST",
            }),
        };
    },
    mounted() {
        if (this.plan) {
            for (let index = 1; index < this.benefits.length; index++) {
                let length = this.benefit_amount.length;
                this.benefit_amount.push(length + 1);
            }
        }
    },
    methods: {
        submit() {
            if (this.plan) {
                this.form.post(
                    this.route("plan.update", this.plan.id),
                    {
                        onSuccess: () => {
                            this.$emit("update");
                            this.form.reset('title', 'price', 'description', 'courses', 'currency');
                        },
                    }
                );
            } else {
                this.form.post(this.route("plan.store"), {
                    onSuccess: () => {
                        this.form.reset('title', 'price', 'description', 'courses', 'currency');
                    },
                });
            }
        },
        addBenefit() {
            let length = this.benefit_amount.length;
            this.benefit_amount.push(length + 1);
        },
        removeBenefit(index) {
            this.form.benefits.splice(index, 1);
            this.form.amounts.splice(index, 1);
            this.benefit_amount.splice(index, 1);
        },
    },
};
</script>
