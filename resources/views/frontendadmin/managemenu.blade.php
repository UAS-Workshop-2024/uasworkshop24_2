@extends('frontendadmin.layouts.app')

@section('title', 'Manage Menu')

@section('header')
<header>
    <div>
        <p>Pages / Manage Menu</p>
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
        <h2>Manage Menu</h2>
        <button>Tambah Menu</button>    
    </div> 
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px;">Nomor</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Nama Menu</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Menu Link</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Menu Icon</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Created By</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Modify</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px;" align="center">1</td>
                <td style="border: 1px solid #ddd; padding: 8px;" align="center">Menu</td>
                <td style="border: 1px solid #ddd; padding: 8px;" align="center">Menu.Show</td>
                <td style="border: 1px solid #ddd; padding: 8px;" align="center">http://icon</td>
                <td style="border: 1px solid #ddd; padding: 8px;" align="center">Administrator</td>
                <td style="border: 1px solid #ddd; padding: 8px;" align="center">
                    <button class="btn btn-edit">Edit</button>
                    <button class="btn btn-delete">Hapus</button>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px;" align="center">2</td>
                <td style="border: 1px solid #ddd; padding: 8px;" align="center">Menu User</td>
                <td style="border: 1px solid #ddd; padding: 8px;" align="center">Menuuser.Show</td>
                <td style="border: 1px solid #ddd; padding: 8px;" align="center">http://icon</td>
                <td style="border: 1px solid #ddd; padding: 8px;" align="center">Administrator</td>
                <td style="border: 1px solid #ddd; padding: 8px;" align="center">
                    <button class="btn btn-edit">Edit</button>
                    <button class="btn btn-delete">Hapus</button>
                </td>
            </tr>
        </tbody>
    </table>
</main>
@endsection

