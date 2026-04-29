<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Confirmation Letter</title>
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
    @foreach ($data as $item)
        <!-- HEADER -->
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <!-- LOGO -->
                <td width="60%" valign="middle">
                    <img src="{{ public_path('assets/logo/image-transparent.png') }}" width="200">
                </td>

                <!-- TEXT -->
                <td width="40%" valign="middle" align="right">
                    <span class="bold">Our Bussines :</span><br>
                    Metal Stamping, Welding & Machining<br>
                    Die & Tool Making<br>
                    Checking Fixture & Welding Jig
                </td>
            </tr>
            <tr>
                <td colspan="2" style="border-bottom: 2px solid #1f4e79;"></td>
            </tr>
        </table>
        <br><br>
        <!-- DATE -->
        <table width="100%">
            <tr>
                <td class="right">
                    Karawang, {{ \Carbon\Carbon::parse($item->CreatedAt)->format('d F Y') }}
                </td>
            </tr>
        </table>

        <br>
        @php
            $date = \Carbon\Carbon::parse($item->CreatedAt);
            $romawi = [
                1 => 'I',
                2 => 'II',
                3 => 'III',
                4 => 'IV',
                5 => 'V',
                6 => 'VI',
                7 => 'VII',
                8 => 'VIII',
                9 => 'IX',
                10 => 'X',
                11 => 'XI',
                12 => 'XII',
            ];
        @endphp
        <table width="100%">
            <tr>
                <td width="15%">Document No</td>
                <td width="85%">:{{ $item->ID }}/PC-SAI/{{ $romawi[$date->month] }}/{{ $date->year }}</td>
            </tr>
            <tr>
                <td>Subject</td>
                <td>: Raw Material Price Confirmation</td>
            </tr>
        </table>

        <br>
        {{-- <div class="bold" style="text-align: center; border:1px solid #000; display:inline-block; padding:5px 15px;">
        CONFIRMATION LETTER
</div> --}}
        <div style="text-align:center;">
            <span style="border:1px solid #000; display:inline-block; padding:5px 15px; font-weight:bold;">
                CONFIRMATION LETTER
            </span>
        </div>
        <br>

        <!-- TO -->
        <table width="100%">
            <tr>
                <td width="15%">To</td>
                <td width="85%">: PT LZWL Motors Indonesia</td>
            </tr>
            <tr>
                <td>Attn</td>
                <td>: Mr Nanang</td>
            </tr>
            <tr>
                <td></td>
                <td>&nbsp;&nbsp;Mr Chen</td>
            </tr>
        </table>

        <br>

        <!-- OPENING -->
        <br>
        <table width="100%">
            <tr>
                <td>Dear Mr,</td>
            </tr>
            <tr>
                <td>With reference to your price confirmation of Purchase Raw material, here with we would like to
                    confirm
                    the material price as follow:</td>
            </tr>
        </table>

        <br>

        <br>

        <!-- LIST -->
        <table width="100%">
            <tr>
                <td width="5%">1.</td>
                <td width="30%">Material Price</td>
                <td width="65%">: As attached</td>
            </tr>
            <tr>
                <td>2.</td>
                <td>Tax Condition</td>
                <td>: Exclude VAT 11%</td>
            </tr>
            <tr>
                <td>3.</td>
                <td>Price Validity</td>
                <td>: {{ $item->Description }}</td>
            </tr>
            <tr>
                <td>4.</td>
                <td>Payment</td>
                <td>: 30 Days after invoice received. If there any delay payment, will be charged 1% Interest.</td>
            </tr>
        </table>

        <br><br>

        <!-- CLOSING -->
        <table width="100%">
            <tr>
                <td>Thank you for your attention and corporation.</td>
            </tr>
        </table>

        <br><br><br>

        <!-- SIGN HEADER -->
        <table width="100%">
            <tr>
                <td width="50%" class="center">
                    Your sincerely
                </td>
                <td width="50%" class="center">
                    Supplier Confirmation
                </td>
            </tr>
            <tr>
                <td class="center bold">
                    PT Summit Adyawinsa Indonesia
                </td>
                <td class="center bold">
                    PT LZWL Motors Indonesia
                </td>
            </tr>
        </table>

        <br><br><br><br>

        <!-- SIGN NAME -->
        <table width="100%">
            <tr>
                <td width="50%" class="center">
                    Eka Novianto Nugroho
                </td>
                <td width="50%" class="center" style="border-bottom:1px solid #000;">

                </td>
            </tr>
            <tr>
                <td class="center">
                    Vice President Director
                </td>
                <td class="center">

                </td>
            </tr>
        </table>

        <br><br>
        @if (!$loop->last)
            <div style="page-break-after: always;"></div>
        @endif
    @endforeach
</body>

</html>
