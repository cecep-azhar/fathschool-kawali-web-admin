<!DOCTYPE html>
<html>
<head>
    <title>Attendance Report - {{ $student->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .student-info {
            margin-bottom: 20px;
        }

        .attendance-summary {
            margin-top: 20px;
        }

        .present-count {
            color: #28a745;
        }

        .absent-count {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Kehadiran Siswa</h2>
        <p>Periode: {{ $start_date }} - {{ $end_date }}</p>
    </div>

    <div class="student-info">
        <h3>Informasi Siswa</h3>
        <p>Nama: {{ $student->name }}</p>
        <p>ID Siswa: {{ $student->id }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Hari</th>
                <th>Status</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $attendance)
                <tr>
                    <td>{{ $attendance['date'] }}</td>
                    <td>{{ $attendance['day'] }}</td>
                    <td>{{ $attendance['status'] }}</td>
                    <td>{{ $attendance['check_in'] }}</td>
                    <td>{{ $attendance['check_out'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="attendance-summary">
        <h3>Ringkasan Kehadiran</h3>
        @php
            $presentCount = collect(value: $attendances)->where('status', 'Hadir')->count();
            $absentCount = collect($attendances)->where('status', 'Tidak Hadir')->count();
        @endphp
        <p>Total Hari: {{ count($attendances) }}</p>
        <p class="present-count">Hadir: {{ $presentCount }} hari</p>
        {{-- <p class="absent-count">Tidak Hadir: {{ $absentCount }} hari</p> --}}
    </div>
</body>
</html>