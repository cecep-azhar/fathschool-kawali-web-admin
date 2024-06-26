<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Result Card</title>
    @vite('resources/js/app.js')
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
    </style>
</head>

<body class='bg-gray-200 py-16'>
    <div class="relative">
        <div id="download_section" class="result-box relative py-10 px-16">
            <div class="flex justify-center gap-4 items-center mb-6">
                <img class="w-auto h-[88px] object-cover" src="{{ asset('images/result-school-logo.png') }}"
                    alt="">
                <h2 class="text-5xl leading-[56px] mb-0 tracking-[-0.02em] text-center font-semibold text-black">
                    {{ config('app.name') }}
                </h2>
            </div>
            <h3 class="text-4xl leading-[56px] tracking-[-0.02em] text-center font-semibold mb-4 text-black">
                {{ $exam->name }} REPORT SHEET
            </h3>
            <div class="border-l-2 border-r-2 border-b-2 border-[#CCCCCC] mb-8">
                <div class="flex justify-between">
                    <div class="w-full p-6">
                        <h4 class="text-lg text-[#074EE8] mb-1.5">
                            UNOGWU ENEATTAH GRACE
                        </h4>
                        <h4 class="text-base mb-1.5 text-[#111111] font-semibold">
                            USERNAME: {{ $user->name }}
                        </h4>
                        @if ($user->phone)
                        <h4 class="text-base mb-1.5 text-[#111111] font-semibold">
                            GENDER: {{ $user->gender }}
                        </h4>
                        @endif
                        <h4 class="text-base mb-1.5 text-[#111111] font-semibold">
                            EMAIL: {{ $user->email }}
                        </h4>
                        @if ($user->phone)
                        <h4 class="text-base mb-0 text-[#111111] font-semibold">
                            PHONE: {{ $user->phone }}
                        </h4>
                        @endif
                    </div>
                    <div class="w-full p-6 border-l-2 border-r-2 border-[#CCCCCC]">
                        <h4 class="text-base text-[#111111] font-semibold mb-1.5">
                            HOUSE: School House Junior Girls
                        </h4>
                        <h4 class="text-base text-[#111111] font-semibold mb-1.5">
                            RESIDENCE TYPE: Day Student
                        </h4>
                        <h4 class="text-base font-semibold mb-1.5">
                            NO. IN CLASS: {{ $no_of_students }} Students
                        </h4>
                        @if ($next_exam && $next_exam->start_date && $next_exam->end_date)
                            <h4 class="text-base text-[#111111] font-semibold mb-0">
                                NEXT TERM BEGINS: {{ formatTime($next_exam->start_date) }} <br>
                                NEXT TERM ENDS: {{ formatTime($next_exam->end_date) }}
                            </h4>
                        @endif
                    </div>
                    <div class="w-full max-w-max p-6">
                        <img src="{{ asset($user->profile_photo_url) }}"
                            class="min-w-[148px] max-w-[148px] min-h-[148px] max-h-[148px] object-cover" />
                    </div>
                </div>
            </div>
            <table class="mb-8 w-full">
                <thead class="w-full">
                    <tr class="rounded-sm bg-green-300">
                        <th class="py-2 px-6 text-left text-xs whitespace-nowrap font-semibold text-black">S/N</th>
                        <th class="py-2 px-6 text-left text-xs whitespace-nowrap font-semibold text-black">SUBJECT</th>
                        {{-- <th class="py-2 px-6 text-right text-xs whitespace-nowrap font-semibold text-black">CA1 (30%)
                        </th>
                        <th class="py-2 px-6 text-left text-xs whitespace-nowrap font-semibold text-black">EXAM (70%)
                        </th> --}}
                        <th class="py-2 px-6 text-left text-xs whitespace-nowrap font-semibold text-black">TOTAL MARK
                        </th>
                        <th class="py-2 px-6 text-right text-xs whitespace-nowrap font-semibold text-black">GRADE</th>
                        <th class="py-2 px-6 text-left text-xs whitespace-nowrap font-semibold text-black">AVG MARK</th>
                        <th class="py-2 px-6 text-left text-xs whitespace-nowrap font-semibold text-black">SUBJECT POS.
                        </th>
                        <th class="py-2 px-6 text-right text-xs whitespace-nowrap font-semibold text-black">GRADE REMARK
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($exam_marks as $key => $exam_mark)
                    <tr class="border-b odd:bg-white even:bg-blue-400">
                        <td class="py-2 px-6 text-left text-base font-medium text-[#101011] whitespace-nowrap">
                            {{ $key+1 }}
                        </td>
                        <td class="py-2 px-6 text-left text-base font-medium text-[#101011]">
                            {{ $exam_mark->subject }}
                        </td>
                        {{-- <td class="py-2 px-6 text-right text-base font-semibold text-[#101011] whitespace-nowrap">
                            18
                        </td>
                        <td class="py-2 px-6 text-left text-base font-medium text-[#101011] whitespace-nowrap">
                            51
                        </td> --}}
                        <td class="py-2 px-6 text-left text-base font-medium text-[#101011]">
                            {{ $exam_mark->marks }}
                        </td>
                        <td class="py-2 px-6 text-right text-base font-semibold text-[#101011] whitespace-nowrap">
                            {{ $exam_mark->grade }}
                        </td>
                        <td class="py-2 px-6 text-left text-base font-medium text-[#101011] whitespace-nowrap">
                            {{ round($exam_mark->mark_avg, 0) }}
                        </td>
                        <td class="py-2 px-6 text-left text-base font-medium text-[#101011]">
                            8th
                        </td>
                        <td class="py-2 px-6 text-right text-base font-semibold text-[#101011] whitespace-nowrap">
                            {{ $exam_mark->grade_remarks }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="my-12">
                <p>KEY TO GRADES: {{ $setting->key_to_grades }}</p>
                <div class="flex items-center">
                    <p class='w-1/2'>GRADES SUMMARY: {{ $setting->grade_summary }}</p>
                    <p class='w-1/2'>AVERAGE SCORE: {{ round($avg_score, 0) }}</p>
                </div>
            </div>
            <div class="flex gap-5 mb-6 items-center border-l-2 border-r-2 border-b-2 border-gray-300">
                <div class='w-1/2 p-4 border-r-2 border-gray-300'>
                    <div class="border border-gray-300">
                        <div class="w-full bg-green-300">
                            <div class="py-2 px-6 text-center text-xs whitespace-nowrap font-semibold text-black">
                                BEHAVIOURAL TRAITS / PSYCHOMOTOR
                            </div>
                        </div>
                        <div class="border-b flex border-blue-400">
                            <div class="w-1/2 px-2 py-1 text-xs font-medium text-[#101011] whitespace-nowrap">
                                Neatness - -
                            </div>
                            <div class="w-1/2 px-2 py-1 text-xs font-medium text-[#101011]">
                                Obedience - -
                            </div>
                        </div>
                        <div class="border-b flex border-blue-400">
                            <div class="w-1/2 px-2 py-1 text-xs font-medium text-[#101011] whitespace-nowrap">
                                Neatness - -
                            </div>
                            <div class="w-1/2 px-2 py-1 text-xs font-medium text-[#101011]">
                                Obedience - -
                            </div>
                        </div>
                        <div class="border-b flex border-blue-400">
                            <div class="w-1/2 px-2 py-1 text-xs font-medium text-[#101011] whitespace-nowrap">
                                Neatness - -
                            </div>
                            <div class="w-1/2 px-2 py-1 text-xs font-medium text-[#101011]">
                                Obedience - -
                            </div>
                        </div>
                        <div class="border-b flex border-blue-400">
                            <div class="w-1/2 px-2 py-1 text-xs font-medium text-[#101011] whitespace-nowrap">
                                Neatness - -
                            </div>
                            <div class="w-1/2 px-2 py-1 text-xs font-medium text-[#101011]">
                                Obedience - -
                            </div>
                        </div>
                        <div class="border-b flex border-blue-400">
                            <div class="w-1/2 px-2 py-1 text-xs font-medium text-[#101011] whitespace-nowrap">
                                Neatness - -
                            </div>
                            <div class="w-1/2 px-2 py-1 text-xs font-medium text-[#101011]">
                                Obedience - -
                            </div>
                        </div>
                    </div>
                </div>
                <div class='w-1/2 p-4'>
                    <div class="border border-gray-300">
                        <div class="w-full bg-green-300">
                            <div class="py-2 px-6 text-center text-xs whitespace-nowrap font-semibold text-black">
                                KEY TO PSYCHOMOTOR
                            </div>
                        </div>
                        <div class="border-b flex border-blue-400">
                            <div class="w-1/5 px-2 py-1 text-xs font-medium text-[#101011] whitespace-nowrap">
                                A - -
                            </div>
                            <div class="w-4/5 px-2 py-1 text-xs font-medium text-[#101011]">
                                Excellent show of traits
                            </div>
                        </div>
                        <div class="border-b flex border-blue-400">
                            <div class="w-1/5 px-2 py-1 text-xs font-medium text-[#101011] whitespace-nowrap">
                                A - -
                            </div>
                            <div class="w-4/5 px-2 py-1 text-xs font-medium text-[#101011]">
                                Excellent show of traits
                            </div>
                        </div>
                        <div class="border-b flex border-blue-400">
                            <div class="w-1/5 px-2 py-1 text-xs font-medium text-[#101011] whitespace-nowrap">
                                A - -
                            </div>
                            <div class="w-4/5 px-2 py-1 text-xs font-medium text-[#101011]">
                                Excellent show of traits
                            </div>
                        </div>
                        <div class="border-b flex border-blue-400">
                            <div class="w-1/5 px-2 py-1 text-xs font-medium text-[#101011] whitespace-nowrap">
                                A - -
                            </div>
                            <div class="w-4/5 px-2 py-1 text-xs font-medium text-[#101011]">
                                Excellent show of traits
                            </div>
                        </div>
                        <div class="border-b flex border-blue-400">
                            <div class="w-1/5 px-2 py-1 text-xs font-medium text-[#101011] whitespace-nowrap">
                                A - -
                            </div>
                            <div class="w-4/5 px-2 py-1 text-xs font-medium text-[#101011]">
                                Excellent show of traits
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border border-gray-300 mb-8">
                <div class="w-full bg-green-300">
                    <div class="py-2 px-6 text-center text-xs whitespace-nowrap font-semibold text-black">
                        REMARKS / COMMENTS
                    </div>
                </div>
                <div class="border-b flex border-blue-400">
                    <div class="w-1/3 px-2 py-1 text-xs font-medium text-[#101011] whitespace-nowrap">
                        House Master Remarks:
                    </div>
                    <div class="w-2/3 px-2 py-1 text-xs font-medium text-[#101011]">

                    </div>
                </div>
                <div class="border-b flex border-blue-400">
                    <div class="w-1/3 px-2 py-1 text-xs font-medium text-[#101011] whitespace-nowrap">
                        Form Teacher's Remarks:
                    </div>
                    <div class="w-2/3 px-2 py-1 text-xs font-medium text-[#101011]">

                    </div>
                </div>
                <div class="border-b flex border-blue-400">
                    <div class="w-1/3 px-2 py-1 text-xs font-medium text-[#101011] whitespace-nowrap">
                        Principal's Remarks:
                    </div>
                    <div class="w-2/3 px-2 py-1 text-xs font-medium text-[#101011]">

                    </div>
                </div>
            </div>
            <div>
                <h3>E.T. (MR) INEGBENOISE</h3>
                <h4>Director/Principal</h4>
            </div>

            <img src="{{ asset('images/result-shadow-logo.png') }}" alt=""
                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2" />
        </div>
    </div>
</body>

</html>
