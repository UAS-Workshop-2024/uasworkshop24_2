@extends('frontendadmin.layouts.app')

@section('title', 'Jenis User')

@section('header')
<header>
    <div>
        <p>Pages / Jenis User</p>
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
        <h2>Jenis User</h2>
        <button>Tambah Jenis User</button>
    </div> 
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px;">Nomor</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Tanggal Order</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Total Bayar</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Status</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Modify</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px;" align="center">1</td>
                <td style="border: 1px solid #ddd; padding: 8px;" align="center">11 April 2024</td>
                <td style="border: 1px solid #ddd; padding: 8px;" align="center">Rp100.000</td>
                <td style="border: 1px solid #ddd; padding: 8px;" align="center">-</td>
                <td style="border: 1px solid #ddd; padding: 8px;" align="center">
                    <button class="btn btn-edit">Edit</button>
                    <button class="btn btn-delete">Hapus</button>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px;" align="center">2</td>
                <td style="border: 1px solid #ddd; padding: 8px;" align="center">13 November 2024</td>
                <td style="border: 1px solid #ddd; padding: 8px;" align="center">Rp300.000</td>
                <td style="border: 1px solid #ddd; padding: 8px;" align="center">-</td>
                <td style="border: 1px solid #ddd; padding: 8px;" align="center">
                    <button class="btn btn-edit">Edit</button>
                    <button class="btn btn-delete">Hapus</button>
                </td>
            </tr>
        </tbody>
    </table>
</main>
@endsection

