<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Price Material</title>
    <style>
        body {
            font-family: helvetica;
            font-size: 11px;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .bold {
            font-weight: bold;
        }

        .mt-10 {
            margin-top: 10px;
        }

        .mt-20 {
            margin-top: 20px;
        }

        .mt-30 {
            margin-top: 30px;
        }
    </style>
</head>

<body>
    @foreach ($header as $item)
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td width="33%" valign="middle" align="left">
                    <img src="{{ public_path('assets/logo/image-transparent.png') }}" width="150">
                </td>
                <td width="33%" valign="middle" align="center">
                    <span class="bold">Price Material {{ $item->Description }}</span>
                </td>
                <td width="34%" valign="top">
                    <table width="100%" cellpadding="0">
                        <tr>
                            <td width="40%">Part</td>
                            <td width="5%">:</td>
                            <td width="55%">Reguler Raw Material</td>
                        </tr>
                        <tr>
                            <td>Issue Date</td>
                            <td>:</td>
                            <td>{{ \Carbon\Carbon::parse($item->CreatedAt)->format('d F Y') }}</td>
                        </tr>
                        <tr>
                            <td>Prepared By</td>
                            <td>:</td>
                            <td>{{ $item->CreatedByName }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <br><br>
        <br>

        <table width="100%" border="1" cellpadding="4" cellspacing="0">
            <tr style="background-color:#ffff00; font-weight:bold; text-align:center;">
                <td width="5%">No</td>
                <td width="15%">Part</td>
                <td width="20%">Product Name</td>
                <td width="22%">Size</td>
                <td width="8%">Customer</td>
                <td width="10%">Price Kg</td>
                <td width="10%">Price Sheet</td>
                <td width="10%">Unit Weight Kg/Sheet</td>
            </tr>
            @php
                $no = 1;
            @endphp
            @foreach ($data as $row)
                <tr>
                    <td align="center">{{ $no++ }}</td>
                    <td>{{ $row->PartNo }}</td>
                    <td>{{ $row->ProductName }}</td>
                    <td>{{ $row->Spec }}</td>
                    <td align="center">{{ $row->Customer }}</td>
                    <td>
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td align="left">Rp</td>
                                <td align="right">{{ number_format($row->PriceKg, 0, ',', '.') }}</td>
                            </tr>
                        </table>
                    </td>

                    <td>
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td align="left">Rp</td>
                                <td align="right">{{ number_format($row->PriceSheet, 0, ',', '.') }}</td>
                            </tr>
                        </table>
                    </td>

                    <td align="center">{{ number_format($row->UnitWeight, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </table>
        <br><br>

        <table width="100%" cellpadding="2">
            <tr>
                <!-- NOTE (KIRI) -->
                <td width="48%" valign="top">
                    <span class="bold">Note :</span><br>
                    - If the UOM material uses sheets, the price listed is the sheet price, not Kg<br>
                    - The prices listed are the prices for the
                    {{ \Carbon\Carbon::parse($item->StartDate)->format('F') }}
                    - {{ \Carbon\Carbon::parse($item->EndDate)->format('F Y') }} period
                </td>

                <!-- TANDA TANGAN (KANAN) -->
                <td width="52%" valign="top">
                    <table width="100%" cellpadding="3">
                        <tr>
                            <td width="33%" align="center" style="border: 1px solid black">Prepared By</td>
                            <td width="33%" align="center" style="border: 1px solid black">Checked By</td>
                            <td width="33%" align="center" style="border: 1px solid black">Approved By</td>
                        </tr>

                        <!-- RUANG TTD -->
                        <tr>
                            <td height="60" style="border: 1px solid black"></td>
                            <td style="border: 1px solid black"></td>
                            <td style="border: 1px solid black"></td>
                        </tr>

                        <!-- NAMA -->
                        <tr>
                            <td align="center" style="border: 1px solid black">{{ $item->CreatedByName }}</td>
                            <td align="center" style="border: 1px solid black">Nama Checker</td>
                            <td align="center" style="border: 1px solid black">Nama Approver</td>
                        </tr>

                        <!-- JABATAN -->
                        <tr>
                            <td align="center" style="border: 1px solid black">Purchasing Department</td>
                            <td align="center" style="border: 1px solid black">Purchasing Sect. Head</td>
                            <td align="center" style="border: 1px solid black">Purchasing Dept. Head</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        @if (!$loop->last)
            <div style="page-break-after: always;"></div>
        @endif
    @endforeach
</body>

</html>
