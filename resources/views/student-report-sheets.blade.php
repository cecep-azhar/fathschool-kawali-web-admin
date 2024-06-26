<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <title>{{ $exam->name }} Report Sheets</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .result-box {
            max-width: 1320px;
            margin: 0px auto;
            overflow: hidden;
            background: white;
        }

        @media print {
            @page {
                size: A3;
            }
        }

        *,
        ::before,
        ::after {
            box-sizing: border-box;
            /* 1 */
            border-width: 0;
            /* 2 */
            border-style: solid;
            /* 2 */
            border-color: #e5e7eb;
            /* 2 */
        }

        ::before,
        ::after {
            --tw-content: '';
        }

        html {
            line-height: 1.5;
            /* 1 */
            -webkit-text-size-adjust: 100%;
            /* 2 */
            -moz-tab-size: 4;
            /* 3 */
            tab-size: 4;
            /* 3 */
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            /* 4 */
            font-feature-settings: normal;
            /* 5 */
            font-variation-settings: normal;
            /* 6 */
        }

        body {
            margin: 0;
            /* 1 */
            line-height: inherit;
            /* 2 */
        }

        hr {
            height: 0;
            /* 1 */
            color: inherit;
            /* 2 */
            border-top-width: 1px;
            /* 3 */
        }

        abbr:where([title]) {
            -webkit-text-decoration: underline dotted;
            text-decoration: underline dotted;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-size: inherit;
            font-weight: inherit;
        }

        a {
            color: inherit;
            text-decoration: inherit;
        }

        b,
        strong {
            font-weight: bolder;
        }

        code,
        kbd,
        samp,
        pre {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            /* 1 */
            font-size: 1em;
            /* 2 */
        }

        small {
            font-size: 80%;
        }

        sub,
        sup {
            font-size: 75%;
            line-height: 0;
            position: relative;
            vertical-align: baseline;
        }

        sub {
            bottom: -0.25em;
        }

        sup {
            top: -0.5em;
        }

        table {
            text-indent: 0;
            /* 1 */
            border-color: inherit;
            /* 2 */
            border-collapse: collapse;
            /* 3 */
        }

        button,
        input,
        optgroup,
        select,
        textarea {
            font-family: inherit;
            /* 1 */
            font-size: 100%;
            /* 1 */
            font-weight: inherit;
            /* 1 */
            line-height: inherit;
            /* 1 */
            color: inherit;
            /* 1 */
            margin: 0;
            /* 2 */
            padding: 0;
            /* 3 */
        }

        button,
        select {
            text-transform: none;
        }

        button,
        [type='button'],
        [type='reset'],
        [type='submit'] {
            -webkit-appearance: button;
            /* 1 */
            background-color: transparent;
            /* 2 */
            background-image: none;
            /* 2 */
        }

        :-moz-focusring {
            outline: auto;
        }

        :-moz-ui-invalid {
            box-shadow: none;
        }

        progress {
            vertical-align: baseline;
        }

        ::-webkit-inner-spin-button,
        ::-webkit-outer-spin-button {
            height: auto;
        }

        [type='search'] {
            -webkit-appearance: textfield;
            /* 1 */
            outline-offset: -2px;
            /* 2 */
        }

        ::-webkit-search-decoration {
            -webkit-appearance: none;
        }

        ::-webkit-file-upload-button {
            -webkit-appearance: button;
            /* 1 */
            font: inherit;
            /* 2 */
        }

        summary {
            display: list-item;
        }

        blockquote,
        dl,
        dd,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        hr,
        figure,
        p,
        pre {
            margin: 0;
        }

        fieldset {
            margin: 0;
            padding: 0;
        }

        legend {
            padding: 0;
        }

        ol,
        ul,
        menu {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        textarea {
            resize: vertical;
        }

        input::placeholder,
        textarea::placeholder {
            opacity: 1;
            /* 1 */
            color: #9ca3af;
            /* 2 */
        }

        button,
        [role="button"] {
            cursor: pointer;
        }

        :disabled {
            cursor: default;
        }

        img,
        svg,
        video,
        canvas,
        audio,
        iframe,
        embed,
        object {
            display: block;
            /* 1 */
            vertical-align: middle;
            /* 2 */
        }

        img,
        video {
            max-width: 100%;
            height: auto;
        }

        [hidden] {
            display: none;
        }

        *,
        ::before,
        ::after {
            --tw-border-spacing-x: 0;
            --tw-border-spacing-y: 0;
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            --tw-pan-x: ;
            --tw-pan-y: ;
            --tw-pinch-zoom: ;
            --tw-scroll-snap-strictness: proximity;
            --tw-gradient-from-position: ;
            --tw-gradient-via-position: ;
            --tw-gradient-to-position: ;
            --tw-ordinal: ;
            --tw-slashed-zero: ;
            --tw-numeric-figure: ;
            --tw-numeric-spacing: ;
            --tw-numeric-fraction: ;
            --tw-ring-inset: ;
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: rgb(59 130 246 / 0.5);
            --tw-ring-offset-shadow: 0 0 #0000;
            --tw-ring-shadow: 0 0 #0000;
            --tw-shadow: 0 0 #0000;
            --tw-shadow-colored: 0 0 #0000;
            --tw-blur: ;
            --tw-brightness: ;
            --tw-contrast: ;
            --tw-grayscale: ;
            --tw-hue-rotate: ;
            --tw-invert: ;
            --tw-saturate: ;
            --tw-sepia: ;
            --tw-drop-shadow: ;
            --tw-backdrop-blur: ;
            --tw-backdrop-brightness: ;
            --tw-backdrop-contrast: ;
            --tw-backdrop-grayscale: ;
            --tw-backdrop-hue-rotate: ;
            --tw-backdrop-invert: ;
            --tw-backdrop-opacity: ;
            --tw-backdrop-saturate: ;
            --tw-backdrop-sepia: ;
        }

        ::backdrop {
            --tw-border-spacing-x: 0;
            --tw-border-spacing-y: 0;
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            --tw-pan-x: ;
            --tw-pan-y: ;
            --tw-pinch-zoom: ;
            --tw-scroll-snap-strictness: proximity;
            --tw-gradient-from-position: ;
            --tw-gradient-via-position: ;
            --tw-gradient-to-position: ;
            --tw-ordinal: ;
            --tw-slashed-zero: ;
            --tw-numeric-figure: ;
            --tw-numeric-spacing: ;
            --tw-numeric-fraction: ;
            --tw-ring-inset: ;
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: rgb(59 130 246 / 0.5);
            --tw-ring-offset-shadow: 0 0 #0000;
            --tw-ring-shadow: 0 0 #0000;
            --tw-shadow: 0 0 #0000;
            --tw-shadow-colored: 0 0 #0000;
            --tw-blur: ;
            --tw-brightness: ;
            --tw-contrast: ;
            --tw-grayscale: ;
            --tw-hue-rotate: ;
            --tw-invert: ;
            --tw-saturate: ;
            --tw-sepia: ;
            --tw-drop-shadow: ;
            --tw-backdrop-blur: ;
            --tw-backdrop-brightness: ;
            --tw-backdrop-contrast: ;
            --tw-backdrop-grayscale: ;
            --tw-backdrop-hue-rotate: ;
            --tw-backdrop-invert: ;
            --tw-backdrop-opacity: ;
            --tw-backdrop-saturate: ;
            --tw-backdrop-sepia: ;
        }

        .absolute {
            position: absolute;
        }

        .left-1\/2 {
            left: 50%;
        }

        .top-1\/2 {
            top: 50%;
        }

        .mb-0 {
            margin-bottom: 0px;
        }

        .mb-1 {
            margin-bottom: 0.25rem;
        }

        .mb-1\.5 {
            margin-bottom: 0.375rem;
        }

        .mb-4 {
            margin-bottom: 1rem;
        }

        .mb-6 {
            margin-bottom: 1.5rem;
        }

        .mb-8 {
            margin-bottom: 2rem;
        }

        .mt-12 {
            margin-top: 3rem;
        }

        .mt-6 {
            margin-top: 1.5rem;
        }

        .flex {
            display: flex;
        }

        .inline-flex {
            display: inline-flex;
        }

        .table {
            display: table;
        }

        .h-\[88px\] {
            height: 88px;
        }

        .max-h-\[148px\] {
            max-height: 148px;
        }

        .min-h-\[148px\] {
            min-height: 148px;
        }

        .\!w-full {
            width: 100% !important;
        }

        .w-1\/2 {
            width: 50%;
        }

        .w-auto {
            width: auto;
        }

        .w-full {
            width: 100%;
        }

        .min-w-\[148px\] {
            min-width: 148px;
        }

        .max-w-\[148px\] {
            max-width: 148px;
        }

        .max-w-max {
            max-width: max-content;
        }

        .-translate-x-1\/2 {
            --tw-translate-x: -50%;
            transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
        }

        .-translate-y-1\/2 {
            --tw-translate-y: -50%;
            transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
        }

        .transform {
            transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
        }

        .items-center {
            align-items: center;
        }

        .justify-center {
            justify-content: center;
        }

        .gap-2 {
            gap: 0.5rem;
        }

        .gap-4 {
            gap: 1rem;
        }

        .whitespace-nowrap {
            white-space: nowrap;
        }

        .rounded-md {
            border-radius: 0.375rem;
        }

        .rounded-sm {
            border-radius: 0.125rem;
        }

        .border-b {
            border-bottom-width: 1px;
        }

        .border-b-2 {
            border-bottom-width: 2px;
        }

        .border-l-2 {
            border-left-width: 2px;
        }

        .border-r-2 {
            border-right-width: 2px;
        }

        .border-\[\#CCCCCC\] {
            --tw-border-opacity: 1;
            border-color: rgb(204 204 204 / var(--tw-border-opacity));
        }

        .bg-blue-500 {
            --tw-bg-opacity: 1;
            background-color: rgb(59 130 246 / var(--tw-bg-opacity));
        }

        .bg-gray-200 {
            --tw-bg-opacity: 1;
            background-color: rgb(229 231 235 / var(--tw-bg-opacity));
        }

        .bg-green-300 {
            --tw-bg-opacity: 1;
            background-color: rgb(134 239 172 / var(--tw-bg-opacity));
        }

        .object-cover {
            object-fit: cover;
        }

        .p-6 {
            padding: 1.5rem;
        }

        .\!px-16 {
            padding-left: 4rem !important;
            padding-right: 4rem !important;
        }

        .\!py-10 {
            padding-top: 2.5rem !important;
            padding-bottom: 2.5rem !important;
        }

        .px-4 {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        .py-16 {
            padding-top: 4rem;
            padding-bottom: 4rem;
        }

        .py-2 {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }

        .text-left {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-4xl {
            font-size: 2.25rem;
            line-height: 2.5rem;
        }

        .text-5xl {
            font-size: 3rem;
            line-height: 1;
        }

        .text-base {
            font-size: 1rem;
            line-height: 1.5rem;
        }

        .text-lg {
            font-size: 1.125rem;
            line-height: 1.75rem;
        }

        .text-xs {
            font-size: 0.75rem;
            line-height: 1rem;
        }

        .font-medium {
            font-weight: 500;
        }

        .font-semibold {
            font-weight: 600;
        }

        .leading-\[56px\] {
            line-height: 56px;
        }

        .tracking-\[-0\.02em\] {
            letter-spacing: -0.02em;
        }

        .text-\[\#074EE8\] {
            --tw-text-opacity: 1;
            color: rgb(7 78 232 / var(--tw-text-opacity));
        }

        .text-\[\#101011\] {
            --tw-text-opacity: 1;
            color: rgb(16 16 17 / var(--tw-text-opacity));
        }

        .text-\[\#111111\] {
            --tw-text-opacity: 1;
            color: rgb(17 17 17 / var(--tw-text-opacity));
        }

        .text-black {
            --tw-text-opacity: 1;
            color: rgb(0 0 0 / var(--tw-text-opacity));
        }

        .text-white {
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity));
        }

        .opacity-10 {
            opacity: 0.1;
        }

        .odd\:bg-white:nth-child(odd) {
            --tw-bg-opacity: 1;
            background-color: rgb(255 255 255 / var(--tw-bg-opacity));
        }

        .even\:bg-blue-400:nth-child(even) {
            --tw-bg-opacity: 1;
            background-color: rgb(96 165 250 / var(--tw-bg-opacity));
        }
    </style>
</head>

<body class='bg-gray-200 py-16'>
    <div class="result-box !py-10 !px-16">
        <table class="!w-full">
            <thead></thead>
            <tbody>
                <tr>
                    <td>
                        <div class="flex justify-center gap-4 items-center mb-6">
                            <img class="w-auto h-[88px] object-cover" src="{{ asset($setting->dark_logo) }}"
                                alt="">
                            <h2
                                class="text-5xl leading-[56px] mb-0 tracking-[-0.02em] text-center font-semibold text-black">
                                {{ config('app.name') }}
                            </h2>
                        </div>
                    </td>
                    @if (!$request->download)
                        <td>
                            <a href="{{ route('preview.result', [$exam->slug, 'download' => true]) }}"
                                class="inline-flex gap-2 items-center bg-blue-500 text-white py-2 px-4 rounded-md" target="_blank">
                                <span>Download</span>
                            </a>
                        </td>
                    @endif
                </tr>
                <tr>
                    <td>
                        <h3
                            class="text-4xl leading-[56px] tracking-[-0.02em] text-center font-semibold mb-4 text-black">
                            {{ $exam->name }} REPORT SHEET
                        </h3>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="!w-full border-l-2 border-r-2 border-b-2 border-[#CCCCCC] mb-8">
            <thead></thead>
            <tbody>
                <tr>
                    <td>
                        <div class="w-full p-6">
                            <h4 class="text-base mb-1.5 text-[#111111] font-semibold">
                                NAME: {{ $user->name }}
                            </h4>
                            <h4 class="text-base mb-1.5 text-[#111111] font-semibold">
                                EMAIL: {{ $user->email }}
                            </h4>
                            <h4 class="text-base mb-1.5 text-[#111111] font-semibold">
                                GENDER: {{ $user->gender ?? '' }}
                            </h4>
                            <h4 class="text-base mb-0 text-[#111111] font-semibold">
                                PHONE: {{ $user->phone ?? '' }}
                            </h4>
                        </div>
                    </td>
                    <td>
                        <div class="w-full p-6 border-l-2 border-r-2 border-[#CCCCCC]">
                            <h4 class="text-base text-[#111111] font-semibold mb-1.5">
                                COURSE: {{ $exam->course->name }}
                            </h4>
                            <h4 class="text-base font-semibold mb-1.5">
                                NO. IN COURSES: {{ $no_of_students }} Students
                            </h4>
                            <h4 class="text-base text-[#111111] font-semibold mb-0">
                                NEXT TERM BEGINS:
                                {{ $next_exam && $next_exam->start_date ? formatTime($next_exam->start_date) : '' }}
                                <br>
                                NEXT TERM ENDS:
                                {{ $next_exam && $next_exam->end_date ? formatTime($next_exam->end_date) : '' }}
                            </h4>
                        </div>
                    </td>
                    <td>
                        <div class="!w-full flex justify-center items-center p-6 text-center">
                            <img src="{{ asset($user->profile_photo_url) }}"
                                class="min-w-[148px] max-w-[148px] min-h-[148px] max-h-[148px] object-cover" />
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="mb-8 w-full">
            <thead class="w-full">
                <tr class="rounded-sm bg-green-300">
                    <th class="py-2 px-6 text-left text-xs whitespace-nowrap font-semibold text-black">S/N</th>
                    <th class="py-2 px-6 text-left text-xs whitespace-nowrap font-semibold text-black">SUBJECT</th>
                    <th class="py-2 px-6 text-left text-xs whitespace-nowrap font-semibold text-black">TOTAL MARK
                    </th>
                    <th class="py-2 px-6 text-right text-xs whitespace-nowrap font-semibold text-black">GRADE</th>
                    <th class="py-2 px-6 text-left text-xs whitespace-nowrap font-semibold text-black">AVG MARK</th>
                    <th class="py-2 px-6 text-right text-xs whitespace-nowrap font-semibold text-black">GRADE REMARK
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($exam_marks as $key => $exam_mark)
                    <tr class="border-b odd:bg-white even:bg-blue-400">
                        <td class="py-2 px-6 text-left text-base font-medium text-[#101011] whitespace-nowrap">
                            {{ $key + 1 }}
                        </td>
                        <td class="py-2 px-6 text-left text-base font-medium text-[#101011]">
                            {{ $exam_mark->subject }}
                        </td>
                        <td class="py-2 px-6 text-left text-base font-medium text-[#101011]">
                            {{ $exam_mark->marks }}
                        </td>
                        <td class="py-2 px-6 text-right text-base font-semibold text-[#101011] whitespace-nowrap">
                            {{ $exam_mark->grade }}
                        </td>
                        <td class="py-2 px-6 text-left text-base font-medium text-[#101011] whitespace-nowrap">
                            {{ round($exam_mark->mark_avg, 0) }}
                        </td>
                        <td class="py-2 px-6 text-right text-base font-semibold text-[#101011] whitespace-nowrap">
                            {{ $exam_mark->grade_remarks }}
                        </td>
                    </tr>
                @endforeach
                <tr>

                </tr>
                <tr>
                    <td>

                    </td>
                </tr>
                <tr>
                    <td>
                        <img src="{{ $setting->dark_logo_url }}" alt=""
                            class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-10">
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="!w-full">
            <thead></thead>
            <tbody>
                <tr>
                    <td colspan="2">
                        <div class="mt-12">
                            <p>KEY TO GRADES: {{ $setting->key_to_grades }}</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class='w-1/2'>GRADES SUMMARY: {{ $setting->grade_summary }}</p>
                    </td>
                    <td>
                        <p class='w-1/2'>AVERAGE SCORE: {{ round($avg_score, 0) }}</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="mt-6">
                            <h3>{{ $setting->principal_name }}</h3>
                            <h4>Director/Principal</h4>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
