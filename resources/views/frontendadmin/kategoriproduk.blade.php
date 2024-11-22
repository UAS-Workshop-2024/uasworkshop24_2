@extends('frontendadmin.layouts.app')

@section('title', 'Kategori Produk')

@section('header')
<header>
    <div>
        <p>Pages / Kategori Produk</p>
    </div>
    <div class="search-container">
        {{-- <span class="search-icon">🔍</span> --}}
        <input type="text" placeholder="Cari" class="search-input">
        {{-- <span class="filter-icon">⚙️</span> --}}
      </div>      
</header>
@endsection

@section('content')
<main>
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h2>Kategori Produk</h2>
        <button>Tambah Kategori</button>    
    </div> 
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px;">Nomor</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Nama</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Deskripsi</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Modify</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px;" align="center">1</td>
                <td style="border: 1px solid #ddd; padding: 8px;" align="center">Arabika</td>
                <td style="border: 1px solid #ddd; padding: 8px;" align="center">Kopi ini....</td>
                <td style="border: 1px solid #ddd; padding: 8px;" align="center">
                    <button class="btn btn-edit">Edit</button>
                    <button class="btn btn-delete">Hapus</button>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px;" align="center">2</td>
                <td style="border: 1px solid #ddd; padding: 8px;" align="center">Robusta</td>
                <td style="border: 1px solid #ddd; padding: 8px;" align="center">Kopi ini...</td>
                <td style="border: 1px solid #ddd; padding: 8px;" align="center">
                    <button class="btn btn-edit">Edit</button>
                    <button class="btn btn-delete">Hapus</button>
                </td>
            </tr>
        </tbody>
    </table>
</main>
@endsection

