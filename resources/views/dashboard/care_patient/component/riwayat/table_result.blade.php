<div class="float-right">
    <a href="" class="btn btn-primary btn-sm">Export PDF</a>
    <a href="" class="btn btn-success btn-sm">Export Excel</a>
</div>
<br>
<br>
<table class="table" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>No. Registrasi</th>
            <th>No. Rekam Medis</th>
            <th>Tanggal Daftar</th>
            <th>Tanggal Periksa</th>
            <th>Nama Pasien</th>
            <th>Tempat / Tgl Lahir</th>
            <th>Opsi</th>
        </tr>
    </thead>
    <tbody>
            <tr>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>
                    <a href="{{route('rawatpasien-riwayat-detail', ['id' => $id, 'historyId' => $id])}}" class="btn btn-sm btn-info">
                        <i class="fas fa-list"></i>
                        <span class="ml-1">Detail</span>
                    </a>
                </td>
            </tr>
    </tbody>
</table>