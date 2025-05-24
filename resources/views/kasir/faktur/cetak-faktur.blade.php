<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/icon type" href="logo/Logo1.png">
    <title>Invoice Pembelian</title>

    <style>
        .landScape {
            width: 100%;
            height: 100%;
            margin: 0% 0% 0% 0%;
            filter: progid:DXImageTransform.Microsoft.BasicImage(Rotation=3);
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }

        .btn {
            cursor: pointer;
            display: inline-block;
            font-weight: 400;
            color: #212529;
            text-align: center;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-color: rgb(60, 177, 60);
            border: 1px solid;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
    <body>
    <a href="#" class="btn" style="background-color: white; text-decoration:none;" onclick="window.history.back();" id="kembaliLink">Kembali</a>
    <button class="btn" style="background-color: white; display: inline-block;" onclick="printInvoice();" id="cetakResiButton">Cetak Resi</button>

    <script>
        function printInvoice() {
            // Sembunyikan tautan "Kembali" dan tombol "Cetak Resi" saat mencetak
            document.getElementById('kembaliLink').style.display = 'none';
            document.getElementById('cetakResiButton').style.display = 'none';

            // Cetak resi atau lakukan operasi pencetakan lainnya
            window.print();

            // Tampilkan kembali tautan "Kembali" dan tombol "Cetak Resi" setelah pencetakan selesai
            document.getElementById('kembaliLink').style.display = 'inline-block';
            document.getElementById('cetakResiButton').style.display = 'inline-block';
        }
    </script>
</body>

        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="4">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{ asset('images/logo.jpg') }}" style="width: 100%; max-width: 125px;" alt="Company Logo" />

                            </td>
                            <td>
                                Invoice #:@if(isset($detailFaktur[0]))
                                {{ $detailFaktur[0]->ID_Transaksi}}
                                @endif  
                                
                                <br />
                                Tanggal Transaksi: @if(isset($detailFaktur[0]))
                                {{ $detailFaktur[0]->Dibeli }}
                                @endif  
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="4">
                    <table>
                        <tr>
                            <td>
                                Mutia Petshop<br />
                                Alamat : Jln. Amal Nomor 121 Medan Sunggal<br />
                                WhatsApp : +6281361526811
                            </td>

                            <td>
                                Penerima :    {{ $detailFaktur[0]->Pengguna }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <!-- <tr class="heading">
                <td>Metode Pembayaran</td>
                <td colspan="3">Offline</td>
            </tr> -->

            <!-- <tr class="details">
                <td>Status Pembayaran: </td>
                <td colspan="3">Lunas</td>
            </tr> -->

            <tr class="heading">
                <td>Nama Produk</td>
                <td>Harga</td>
                <td>Jumlah</td>
                <td>Sub Total</td>
            </tr>
            @php
            $totalKeseluruhan = 0;
            @endphp
            @foreach ($detailFaktur as $item)
            <tr class="item">
                <td>{{ $item->Barang }}</td>
                <td>Rp. {{ number_format($item->Harga_Satuan, 2) }}</td>
                <td>{{ $item->jumlah_stok_dipesan }}</td>
                @php
                $subtotal = $item->Harga_Satuan * $item->jumlah_stok_dipesan;
                $totalKeseluruhan += $subtotal;
                @endphp
                <td>Rp. {{ number_format($subtotal, 2) }}</td>
            </tr>
            @endforeach

            <tr class="total">
                <td colspan="3">Total:</td>
                <td>Rp. {{ number_format($totalKeseluruhan, 2) }}</td>
            </tr>
        </table>
    </div>
</body>

</html>