<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Test Report</title>
    <style>
        @page {
            margin: 130px 40px 100px 40px;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            color: #1e293b;
            background-color: #ffffff;
            line-height: 1.5;
            font-size: 11px;
        }

        .page-header {
            position: fixed;
            top: -110px;
            left: 0;
            right: 0;
            height: 95px;
            border-bottom: 2px solid #8a277d;
        }

        .page-header img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .letterhead-fallback {
            padding: 10px 0;
            height: 80px;
            box-sizing: border-box;
        }

        .fallback-brand {
            float: left;
            width: 55%;
        }

        .fallback-tagline {
            font-size: 9px;
            font-style: italic;
            color: #64748b;
            margin-bottom: 2px;
        }

        .fallback-name {
            font-size: 28px;
            font-weight: bold;
            color: #8a277d;
            letter-spacing: 2px;
            text-transform: uppercase;
            line-height: 1;
        }

        .fallback-sub {
            color: #149447;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1px;
            margin-top: 2px;
        }

        .fallback-site {
            color: #8a277d;
            font-size: 10px;
            font-weight: bold;
            margin-top: 2px;
        }

        .fallback-address {
            float: right;
            width: 42%;
            text-align: right;
            font-size: 10px;
            line-height: 1.4;
            color: #475569;
        }

        .page-footer {
            position: fixed;
            bottom: -80px;
            left: 0;
            right: 0;
            height: 70px;
            border-top: 2px solid #149447;
        }

        .page-footer img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .footer-fallback {
            width: 100%;
            height: 60px;
            color: #ffffff;
            font-size: 10px;
            font-weight: bold;
        }

        .footer-fallback-left,
        .footer-fallback-right {
            float: left;
            width: 50%;
            height: 60px;
            padding-top: 15px;
            box-sizing: border-box;
        }

        .footer-fallback-left {
            background-color: #149447;
            text-align: left;
            padding-left: 15px;
        }

        .footer-fallback-right {
            background-color: #8a277d;
            text-align: right;
            padding-right: 15px;
        }

        .report-body {
            margin-top: 5px;
        }

        /* Patient Info Card Redesign */
        .patient-card {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 22px;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
        }

        .patient-card td {
            padding: 8px 12px;
            font-size: 11px;
            vertical-align: middle;
            color: #334155;
            border-bottom: 1px solid #f1f5f9;
        }

        .patient-card tr:last-child td {
            border-bottom: none;
        }

        .patient-card td.label {
            font-weight: bold;
            color: #64748b;
            text-transform: uppercase;
            font-size: 9px;
            letter-spacing: 0.5px;
            width: 110px;
        }

        .patient-card td.sep {
            width: 8px;
            color: #cbd5e1;
            padding: 0;
            text-align: center;
        }

        .patient-card td.value {
            font-weight: 600;
            color: #0f172a;
        }

        /* Category Header */
        .category-title {
            font-size: 12px;
            font-weight: bold;
            color: #8a277d;
            margin: 24px 0 8px 0;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 2px solid #8a277d;
            padding-bottom: 4px;
            page-break-after: avoid;
        }

        /* Results Table Redesign */
        .results-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .results-table th {
            background-color: #f1f5f9;
            color: #475569;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 9px;
            letter-spacing: 0.5px;
            padding: 8px 12px;
            border-top: 1px solid #cbd5e1;
            border-bottom: 2px solid #cbd5e1;
            text-align: left;
        }

        .results-table td {
            padding: 8px 12px;
            font-size: 11px;
            border-bottom: 1px solid #e2e8f0;
            color: #334155;
            vertical-align: middle;
        }

        .results-table tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .param-col { width: 40%; }
        .value-col { width: 22%; }
        .ref-col { width: 28%; }
        .flag-col { width: 10%; text-align: center; }

        .observed-value-wrapper {
            font-weight: 600;
            color: #0f172a;
        }
        
        .observed-value-wrapper.flagged {
            font-weight: bold;
        }

        .unit-text {
            color: #64748b;
            font-size: 10px;
            margin-left: 3px;
        }

        /* Section row / Subheading row styling */
        .section-row td {
            background-color: #f8fafc;
            font-weight: bold;
            color: #475569;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 6px 12px;
            border-bottom: 1px solid #cbd5e1;
            border-left: 3px solid #8a277d;
        }

        /* Flags styling */
        .flag-badge {
            display: inline-block;
            font-weight: bold;
            font-size: 10px;
            text-align: center;
            padding: 2px 6px;
            border-radius: 3px;
        }

        .flag-badge.flag-critical {
            color: #dc2626;
            background-color: #fee2e2;
        }

        .flag-badge.flag-high {
            color: #ea580c;
            background-color: #ffedd5;
        }

        .flag-badge.flag-low {
            color: #2563eb;
            background-color: #dbeafe;
        }

        /* Report closing note and signature */
        .report-closing {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
            page-break-inside: avoid;
        }

        .report-note {
            width: 60%;
            vertical-align: top;
            padding: 12px 16px;
            background-color: #f8fafc;
            border-left: 3px solid #8a277d;
            font-size: 11px;
            color: #475569;
            line-height: 1.5;
            border-radius: 0 4px 4px 0;
        }

        .report-note-label {
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 6px;
            text-transform: uppercase;
            font-size: 9px;
            letter-spacing: 0.5px;
        }

        .signature {
            width: 40%;
            text-align: right;
            vertical-align: bottom;
            padding-bottom: 5px;
        }

        .signature img {
            max-height: 48px;
            display: inline-block;
            margin-bottom: 6px;
        }

        .signature-name {
            font-weight: bold;
            color: #1e293b;
            font-size: 11px;
        }

        .signature-title {
            font-size: 9px;
            color: #64748b;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="page-header">
        @if (extension_loaded('gd'))
            <img src="{{ public_path('images/report-header-awwal.png') }}" alt="AWWAL LAB">
        @else
            <div class="letterhead-fallback">
                <div class="fallback-brand">
                    <div class="fallback-tagline">"Accurate Diagnosis for Effective Treatment"</div>
                    <div class="fallback-name">awwal</div>
                    <div class="fallback-sub">QUALITY DIAGNOSTIC LABS</div>
                    <div class="fallback-site">www.awwallabs.in</div>
                </div>
                <div class="fallback-address">
                    A Muhammed's Complex<br>
                    Chenaykunnu Road Jn.<br>
                    <strong>PATHAPPIRIYAM</strong>, Vayanasala<br>
                    Ph : 7034 250 209, 7559 049 948<br>
                    Email : awwallabppm@gmail.com
                </div>
            </div>
        @endif
    </div>

    <!-- Footer -->
    <div class="page-footer">
        @if (extension_loaded('gd'))
            <img src="{{ public_path('images/report-footer-awwal.png') }}" alt="Working Hours">
        @else
            <div class="footer-fallback">
                <div class="footer-fallback-left">
                    QUALITY OF OUR LABORATORY IS CONTROLLED BY CMC VELLORE
                </div>
                <div class="footer-fallback-right">
                    Working Hours : 6.30 am To 9.00 pm<br>Sunday 7.00 am To 12.00 pm
                </div>
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <div class="report-body">
        @php
            $patientName = trim(strtoupper($patient->first_name . ' ' . $patient->last_name));
            $referenceNo = str_replace(['#P-', '#'], '', $patient->patient_id);
            $sex = strtoupper($patient->gender ?? '');
            $reportDate = optional($report->sample_received_on)->format('d-M-Y - h:i:s A');
            $printedDate = now()->format('d-M-Y - h:i:s A');
        @endphp

        <!-- Patient Info Card Redesigned -->
        <table class="patient-card">
            <tr>
                <td class="label">Patient Name</td>
                <td class="sep">:</td>
                <td class="value" style="width: 35%;">{{ $patientName }}</td>
                <td class="label" style="width: 105px;">Age / Sex</td>
                <td class="sep">:</td>
                <td class="value">{{ $patient->age }} &nbsp;/&nbsp; {{ $sex }}</td>
            </tr>
            <tr>
                <td class="label">Reference No</td>
                <td class="sep">:</td>
                <td class="value">{{ $referenceNo }}</td>
                <td class="label">Specimen</td>
                <td class="sep">:</td>
                <td class="value">Blood / Serum</td>
            </tr>
            <tr>
                <td class="label">Referred By</td>
                <td class="sep">:</td>
                <td class="value">{{ $report->doctor_name }}</td>
                <td class="label">Received Date</td>
                <td class="sep">:</td>
                <td class="value">{{ $reportDate }}</td>
            </tr>
            <tr>
                <td class="label">Printed Date</td>
                <td class="sep">:</td>
                <td class="value" colspan="4">{{ $printedDate }}</td>
            </tr>
        </table>

        <!-- Results Section -->
        @foreach ($groupedResults as $category => $results)
            <div class="category-title">{{ $category }}</div>
            <table class="results-table">
                <thead>
                    <tr>
                        <th class="param-col">Parameter</th>
                        <th class="value-col">Observed Value</th>
                        <th class="ref-col">Reference Value</th>
                        <th class="flag-col">Flag</th>
                    </tr>
                </thead>
                <tbody>
                    @php $lastSubheading = null; @endphp
                    @foreach ($results as $r)
                        @php
                            $subheading = trim($r['subcategory'] ?? '');
                            $value = trim((string)($r['observed_value'] ?? ''));
                            $unit = trim((string)($r['unit'] ?? ''));
                            $flag = trim((string)($r['flag'] ?? ''));
                            
                            $flagClass = '';
                            $badgeClass = '';
                            if ($flag === 'C') {
                                $flagClass = 'flag-critical';
                                $badgeClass = 'flag-critical';
                            } elseif ($flag === 'H') {
                                $flagClass = 'flag-high';
                                $badgeClass = 'flag-high';
                            } elseif ($flag === 'L') {
                                $flagClass = 'flag-low';
                                $badgeClass = 'flag-low';
                            }
                        @endphp

                        @if ($subheading !== '' && $subheading !== $lastSubheading)
                            <tr class="section-row">
                                <td colspan="4">{{ strtoupper($subheading) }}</td>
                            </tr>
                            @php $lastSubheading = $subheading; @endphp
                        @endif

                        <tr>
                            <td>{{ $r['name'] ?? '' }}</td>
                            <td>
                                <span class="observed-value-wrapper {{ $flag ? 'flagged' : '' }}">
                                    @if ($flagClass)
                                        <span class="{{ $flagClass }}">{{ $value }}</span>
                                    @else
                                        {{ $value }}
                                    @endif
                                </span>
                                @if ($unit !== '')
                                    <span class="unit-text">{{ $unit }}</span>
                                @endif
                            </td>
                            <td>{!! nl2br(e($r['normal_value'] ?? $r['biological_reference'] ?? '')) !!}</td>
                            <td class="flag-col">
                                @if ($flag)
                                    <span class="flag-badge {{ $badgeClass }}">{{ $flag }}</span>
                                @else
                                    <span style="color: #cbd5e1;">-</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach

        <!-- Report Footer Note & Signature -->
        <table class="report-closing">
            <tr>
                <td class="report-note">
                    <div class="report-note-label">Notes / Interpretation</div>
                    @if($report->notes)
                        <div>{!! nl2br(e($report->notes)) !!}</div>
                    @else
                        <div style="color: #94a3b8; font-style: italic;">No notes provided.</div>
                    @endif
                </td>
                <td class="signature">
                    @if($report->signature && is_file($report->signature->imageAbsolutePath()))
                        <img src="{{ $report->signature->imageAbsolutePath() }}" alt="{{ $report->signature->name }}">
                        <div class="signature-name">{{ $report->signature->name }}</div>
                        <div class="signature-title">Authorized Signatory</div>
                    @else
                        <div class="signature-name">Medi Technician</div>
                        <div class="signature-title">Lab In-Charge</div>
                    @endif
                </td>
            </tr>
        </table>
    </div>

</body>
</html>
