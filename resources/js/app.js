import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp, Head, Link } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { SnackbarService, Vue3Snackbar } from "vue3-snackbar";
import "vue3-snackbar/dist/style.css";
import dayjs from 'dayjs';
import RelativeTime from 'dayjs/plugin/relativeTime';
dayjs.extend(RelativeTime);

import 'shepherd.js/dist/css/shepherd.css';

import { Button, DatePicker, RangePicker, Select, Modal } from 'ant-design-vue';
import 'ant-design-vue/dist/antd.css';
import Antd from 'ant-design-vue';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

// global components
import GlobalButton from "./Shared/GlobalButton.vue";
import BackButton from "./Shared/BackButton.vue";
import GlobalInput from "./Shared/GlobalInput.vue";
import GlobalLabel from "./Shared/GlobalLabel.vue";
import GlobalTextarea from "./Shared/GlobalTextarea.vue";
import InputError from "./Shared/InputError.vue";
import PageHeader from "./Shared/PageHeader.vue";
import Badge from "./Shared/Badge.vue";
import GlobalTable from "./Shared/Table.vue";
import GlobalSelect from "./Shared/GlobalSelect.vue";
import AppLogo from "./Shared/AppLogo.vue";
import NothingFound from "./Shared/NothingFound.vue";
import vClickOutside from "click-outside-vue3"
import Breadcrumb from "./Shared/Breadcrumb.vue"
import BreadcrumbLink from "./Shared/BreadcrumbLink.vue"
import TabFilter from "./Shared/Filter/TabFilter.vue"

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(Button)
            .use(DatePicker)
            .use(RangePicker)
            .use(Select)
            .use(Modal)
            .use(vClickOutside)
            .use(SnackbarService)
            .use(Antd)
            .mixin({
                components: {
                    Head,
                    Link,
                    GlobalButton,
                    BackButton,
                    GlobalInput,
                    GlobalLabel,
                    GlobalTextarea,
                    InputError,
                    PageHeader,
                    GlobalTable,
                    GlobalSelect,
                    AppLogo,
                    Badge,
                    NothingFound,
                    Breadcrumb,
                    BreadcrumbLink,
                    Vue3Snackbar,
                    TabFilter
                },
                data() {
                    return {
                        dark_class: false,
                    }
                },
                methods: {
                    // for multple language
                    __(key, replace = {}) {
                        var translation = this.$page.props.language[key]
                            ? this.$page.props.language[key]
                            : key

                        Object.keys(replace).forEach(function (key) {
                            translation = translation.replace(':' + key, replace[key])
                        });

                        return translation
                    },
                    // for auth user permission check
                    can(permission) {
                        return Object.values(this.$page.props.auth_permissions).includes(permission);
                    },
                    // for file download
                    download(arg) {
                        axios({
                            url: arg,
                            method: "GET",
                            responseType: "blob",
                        }).then((response) => {
                            let filename = response.request.responseURL;
                            let arR = filename.split(".");
                            let extension = arR.pop();

                            var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                            var fileLink = document.createElement("a");

                            fileLink.href = fileURL;
                            fileLink.setAttribute("download", "file." + extension);
                            document.body.appendChild(fileLink);

                            fileLink.click();
                        });
                    },
                    changeLogo(arg) {
                        this.dark_class = arg;
                    },
                    getOnboardingContent(menuId, content) {

                        const onboardingContents = this.$page.props.onboarding_contents;
                        if (Array.isArray(onboardingContents)) {
                            const selectedItem = onboardingContents.find(item => item.menu_slug === menuId);
                            if (content == 'title') {
                                return selectedItem?.title;
                            } else if (content == 'description') {
                                return selectedItem?.description;
                            }
                            else {
                                return selectedItem;
                            }
                        } else {
                            return null;
                        }
                    },
                    getDateTimeFormat() {
                        var date_format = 'MMMM D, YYYY';
                        let app_format = this.$page.props.date_format;

                        let date_format_rules = {
                            'd_m_Y': 'DD-MM-YYYY',
                            'd_M_Y': 'DD-MMM-YYYY',
                            'd__m__Y': 'DD/MM/YYYY',
                            'm_d_Y': 'MM-DD-YYYY',
                            'm__d__Y': 'MM/DD/YYYY',
                            'Y__m__d': 'YYYY/MM/DD',
                        };

                        var date_format = date_format_rules[app_format];
                        if (date_format) {
                            return date_format;
                        } else {
                            var date_format = format;
                        }
                    },
                    formatTime(date, format = null, concat = null) {
                        var date_format = 'MMMM D, YYYY';

                        if (!format) {
                            let app_format = this.$page.props.date_format;

                            let date_format_rules = {
                                'd_m_Y': 'DD-MM-YYYY',
                                'd_M_Y': 'DD-MMM-YYYY',
                                'd__m__Y': 'DD/MM/YYYY',
                                'm_d_Y': 'MM-DD-YYYY',
                                'm__d__Y': 'MM/DD/YYYY',
                                'Y__m__d': 'YYYY/MM/DD',
                            };

                            var date_format = date_format_rules[app_format];
                        } else {
                            var date_format = format;
                        }

                        if (concat) {
                            var date_format = date_format + ' ' + concat;
                        }

                        return dayjs(date).format(date_format) ?? date;
                    },
                    convertAmount(amount = '') {
                        return this.$page.props.default_currency_symbol + ' ' + amount;
                    },
                    conversionRate(from, to, amount) {

                        let rates = this.$page.props.currency_conversion_rate;
                        const from_rate = rates[from];
                        const to_rate = rates[to];

                        const conversionRate = to_rate / from_rate;
                        const conversionAmount = parseFloat(amount) * conversionRate;
                        return this.number_format(conversionAmount.toFixed(5));
                    },
                    number_format(amount) {
                        let currency_format = this.$page.props.currency_format;

                        let format = {
                            '12345678.00': this.format_amount(amount, 2, '.', ''),
                            '12,345,678.00': this.format_amount(amount),
                            '1,23,45,678.00': this.format_amount(amount, 2, '.', ','),
                            '12.345.678.00': this.format_amount(amount, 2, '.', '.'),
                            '12.345.678,00': this.format_amount(amount, 2, ',', '.'),
                        };

                        return format[currency_format];
                    },
                    format_amount(number, decimals, dec_point, thousands_sep) {
                        number = number * 1;
                        var str = number.toFixed(decimals ? decimals : 0).toString().split('.');
                        var parts = [];
                        for (var i = str[0].length; i > 0; i -= 3) {
                            parts.unshift(str[0].substring(Math.max(0, i - 3), i));
                        }
                        str[0] = parts.join(thousands_sep ? thousands_sep : ',');
                        return str.join(dec_point ? dec_point : '.');
                    },
                    decimalFormat(price) {
                        const numericValue = parseFloat(price);
                        return numericValue.toFixed(2);
                    },
                },
            })
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4Bc563' });
