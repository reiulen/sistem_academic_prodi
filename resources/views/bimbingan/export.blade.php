<style>
    .table {
        border-collapse: collapse;
        width: 100%;
    }

    .table th,
    .table td {
        border: 1px solid #000;
        padding: 4px;
        white-space: nowrap;
    }

    .table thead tr {
        background: #d9e7f2;
    }

    .str {
        mso-number-format: \@;
    }

    .bigheader {
        font-size: 30px;
        font-weight: bold;
        color: black;
        margin: 0px;
    }

    .subheader {
        font-size: 20px;
        margin: 0px;
    }

    .text-center {
        text-align: center;
    }
</style>


<table width="100%">
    <tr>
        <td align="left">
            <table style="padding:0; border-collapse:collapse;" width="100%">
                <tr>
                    <td align="left" width="100%">
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<center style="margin-top: 18px">
    <h1 class="bigheader">Bimbingan Kelas</h1>
</center>

<table class="table">
    <thead>
        <tr>
            <th width="10px">No</th>
            <th>Nama Dosen</th>
            <th>Kelas</th>
            <th>Topik</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @php
        $i = 0;
    @endphp
    @if (count($data) > 0)
        @foreach ($data as $item)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $item->dosen->name_dosen ?? '-' }}</td>
            <td>{{ $item->kelas }}</td>
            <td>{{ $item->topik }}</td>
            <td>{{ date('d F Y H:i:s', strtotime($item->created_at)) }}</td>
        </tr>
        @endforeach
    @else
    <tr>
        <td colspan="11" class="text-center">Data tidak ditemukan</td>
    </tr>
    @endif
    </tbody>
</table>
