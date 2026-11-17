<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Apotek Bang Ganteng - Katalog</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    <div class="container">
        <h2>Katalog Farmasi</h2>
        <p>Master Data Obat, Kategori, Sediaan, dan Pabrikan</p>

        <form action="{{ route('logout') }}" method="POST" style="margin-bottom: 20px;">
            @csrf
            <button type="submit" class="btn btn-warning" style="border:none; cursor:pointer;">Keluar</button>
        </form>

        @if (session('success'))
            <div style="padding:10px; background:#d1e7dd; color:#0f5132; margin-bottom:15px; border-radius:6px;">
                {{ session('success')}}
            </div>
        @endif

        <div style="margin-bottom: 20px;">
            <a href="{{ route('obat.create') }}" class="btn">Tambah Obat Baru</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Obat</th>
                    <th>Kategori Obat</th>
                    <th>Sediaan</th>
                    <th>Pabrikan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($obat as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_obat }}</td>
                        <td>{{ $item->kategori }}</td>
                        <td>{{ $item->sediaan }}</td>
                        <td>{{ $item->pabrikan }}</td>
                        <td style="display:flex; gap:6px;">
                            <a href="{{ route('obat.edit', $item->id) }}" class="btn btn-warning" style="padding:6px 12px;">Edit</a>

                            <form action="{{ route('obat.destroy', $item->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding:6px 12px; border:none; cursor:pointer;">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" style="text-align:center;">Belum ada data obat.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>