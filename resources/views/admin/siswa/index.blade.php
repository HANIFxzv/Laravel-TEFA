<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
</head>

<body>
    <h1>Data Siswa</h1>
    <a href="{{ route('admin/dashboard') }}">Menu Utama</a><br>
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElemenById('logout-form').submit();">Logout</a>
    <br><br>
    <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
    </form>
    <br><br>
    <form action="" method="get"> 
        <label>Cari</label>
        <input type="text" name="cari">
        <input type="submit" value="Cari">

    </form>
    <br><br>
    <a href="{{ route('siswa.create') }}">Tambahkan Siswa</a>

    @if(Session::has('succes'))
    <div class="alert alert-succes" role="alert"> 
    {{ Session::get('succes') }}
    </div>
    @endif

    <table class="tabel">
        <tr> 
            <th>Foto<th>
            <th>NIS<th>
            <th>Nama<th>
            <th>Email<th>
            <th>Kela<th>
            <th>No.HP<th>
            <th>Status<th>
            <th>Aksi<th>
        </tr>
        @forelse ($siswas as $siswa)
        <tr> 
            <td>
                 <img src="{{ asset('storage/siswas/'.$siswa->image) }}" width="120px" height="120px" alt="">
            </td>
            <td>{{ $siswa->nis }}</td>
            <td>{{ $siswa->name}}></td>
            <td>{{ $siswa->email}}</td>
            <td>{{ $siswa->tingkatan}} {{ $siswa->jurusan }} {{ $siswa->kelas }}</td>
            <td>{{ $siswa-hp }}</td>
            @if ($siswa->status == 1) :
            <td>Aktif</td>
            @else
            <td>Tidak Aktif</td>
            @endif
            <td>
                <form onsubmit="return confirm('Apakah Anda Yakin ?');"action="{{ route('siswa.destroy', $siswa->id) }}" method="POST">
                    <a href="{{ route('siswa.show', $siswa->id)}}" class="btn btn-sm btn-dark">SHOW</a>
                    <a href="{{ route('siswa.edit', $siswa->id)}}" class="btn btn-sm btn-primary">EDIT</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit">HAPUS</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td>
                <p>data tidak ditemukan</p>
            </td>
            <td>
                <a href="{{ route('siswa.index') }}">kembali</a>
            </td>
        </tr>
        @endforelse
    </table>
    {{ $siswas->links() }}

</body>

</html>