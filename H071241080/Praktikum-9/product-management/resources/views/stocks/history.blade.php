@extends('layouts.app')

@section('title', 'Riwayat Stok')

@section('breadcrumb')
    <div class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">🏠 Dashboard</a>
    </div>
    <span>›</span>
    <div class="breadcrumb-item">
        <a href="{{ route('stocks.index') }}">📊 Manajemen Stok</a>
    </div>
    <span>›</span>
    <div class="breadcrumb-item active">
        <span>📜 Riwayat</span>
    </div>
@endsection

@section('topbar-actions')
    <a href="{{ route('stocks.index') }}" class="btn btn-secondary">
        <span>←</span>
        <span>Kembali ke Stok</span>
    </a>
@endsection

@section('content')
    <div class="page-header">
        <div class="page-title-row">
            <h1 class="page-title">
                <span class="page-title-icon">📜</span>
                Riwayat Pergerakan Stok
            </h1>
        </div>
        <p class="page-subtitle">Audit log semua pergerakan stok produk di seluruh gudang</p>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-header-title">
                <span>📊</span>
                Log Pergerakan Stok
            </h3>
        </div>
        <div class="card-body">
            @if ($movements->isEmpty())
                <div class="empty-state">
                    <div class="empty-state-icon">📜</div>
                    <h3 class="empty-state-title">Belum ada riwayat</h3>
                    <p class="empty-state-description">Belum ada pergerakan stok yang tercatat</p>
                    <a href="{{ route('stocks.index') }}" class="btn btn-primary">
                        <span>📊</span>
                        <span>Kelola Stok</span>
                    </a>
                </div>
            @else
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Waktu</th>
                                <th>Produk</th>
                                <th>Gudang</th>
                                <th>Perubahan Stok</th>
                                <th>Stok Akhir</th>
                                <th>Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($movements as $movement)
                                <tr>
                                    <td style="font-family: monospace; font-size: 13px;">
                                        {{ $movement->created_at->format('d/m/Y H:i:s') }}
                                    </td>
                                    <td style="font-weight: 600;">{{ $movement->product->name }}</td>
                                    <td>
                                        <span class="badge" style="background: #fef3c7; color: #92400e;">
                                            🏭 {{ $movement->warehouse->name }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($movement->value > 0)
                                            <span style="display: inline-flex; align-items: center; gap: 4px; background: #d1fae5; color: #065f46; padding: 4px 12px; border-radius: 12px; font-weight: 700; font-size: 14px;">
                                                <span>↑</span>
                                                <span>+{{ $movement->value }}</span>
                                            </span>
                                        @elseif ($movement->value < 0)
                                            <span style="display: inline-flex; align-items: center; gap: 4px; background: #fee2e2; color: #991b1b; padding: 4px 12px; border-radius: 12px; font-weight: 700; font-size: 14px;">
                                                <span>↓</span>
                                                <span>{{ $movement->value }}</span>
                                            </span>
                                        @else
                                            <span style="color: var(--text-secondary);">0</span>
                                        @endif
                                    </td>
                                    <td style="font-weight: 600; color: var(--primary);">{{ $movement->stock_after }} unit</td>
                                    <td style="color: var(--text-secondary); font-size: 13px;">{{ $movement->notes }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div style="margin-top: 24px; display: flex; justify-content: center;">
                    {{ $movements->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection