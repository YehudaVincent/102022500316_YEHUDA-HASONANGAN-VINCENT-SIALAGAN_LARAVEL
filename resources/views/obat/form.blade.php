@php
    $isEdit = $obat->exists;
    $kategori = ['Analgesik & Antipiretik', 'Antibiotik', 'Vitamin & Suplemen'];
    $sediaan  = ['Tablet', 'Kapsul', 'Sirup', 'Bubuk'];
    $pabrikan = ['Kimia Farma', 'Kalbe Farma', 'Dexa Medica', 'Unknown'];
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $isEdit ? 'Edit Obat' : 'Tambah Obat' }}</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    <div class="container" style="max-width: 600px;">
        <h2>{{ $isEdit ? 'Edit Data Obat' : 'Tambah Obat Baru' }}</h2>
        <p><a href="{{ route('obat.index') }}">&larr; Kembali</a></p>

        @if ($errors->any())
            <div style="padding:10px; background:#f8d7da; color:#842029; margin-bottom:15px; border-radius:6px;">
                <ul style="margin-left:18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" class="form-card"
              action="{{ $isEdit ? route('obat.update', $obat->id) : route('obat.store') }}">
            @csrf
            @if ($isEdit)
                @method('PUT')
            @endif

            <div class="form-group">
                <label>Nama Obat:</label>
                <input type="text" name="nama_obat" value="{{ old('nama_obat', $obat->nama_obat) }}" required>
            </div>

            <div class="form-group">
                <label>Kategori Obat:</label>
                <select name="kategori" required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($kategori as $k)
                        <option value="{{ $k }}" @selected(old('kategori', $obat->kategori) == $k)>{{ $k }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Sediaan:</label>
                <select name="sediaan" required>
                    <option value="">Pilih Sediaan</option>
                    @foreach ($sediaan as $s)
                        <option value="{{ $s }}" @selected(old('sediaan', $obat->sediaan) == $s)>{{ $s }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Pabrikan:</label>
                <select name="pabrikan" required>
                    <option value="">Pilih Pabrikan</option>
                    @foreach ($pabrikan as $p)
                        <option value="{{ $p }}" @selected(old('pabrikan', $obat->pabrikan) == $p)>{{ $p }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn" style="border:none; cursor:pointer; width:100%;">Simpan</button>
        </form>
    </div>
</body>
</html>