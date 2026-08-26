@extends('layouts.admin')

@section('title', 'Tempat Sampah - Admin Dashboard')
@section('page_title', 'Tempat Sampah')
@section('page_subtitle', 'Kelola data yang dihapus')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
        <h3 class="text-lg font-bold text-slate-800 mb-4">Slot & Dokumen yang Dihapus</h3>
        
        @if($trashedDokumen->isEmpty() && $trashedSubIndikator->isEmpty() && $trashedIndikator->isEmpty() && $trashedSubKomponen->isEmpty())
            <div class="text-center py-10">
                <svg class="w-16 h-16 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                <p class="text-slate-500 font-medium text-sm">Tempat sampah kosong.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider">
                            <th class="px-4 py-3 font-semibold rounded-l-xl">Tipe</th>
                            <th class="px-4 py-3 font-semibold">Nama / Kode</th>
                            <th class="px-4 py-3 font-semibold">Waktu Dihapus</th>
                            <th class="px-4 py-3 font-semibold text-right rounded-r-xl">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($trashedSubKomponen as $sk)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-4 py-4"><span class="px-2.5 py-1 bg-amber-100 text-amber-700 text-[10px] font-bold rounded-md">Sub Komponen</span></td>
                                <td class="px-4 py-4 text-sm font-medium text-slate-700">{{ $sk->nomor_sub }} - {{ $sk->nama_sub_komponen }}</td>
                                <td class="px-4 py-4 text-xs text-slate-500">{{ $sk->deleted_at->format('d M Y, H:i') }}</td>
                                <td class="px-4 py-4">
                                    <div class="flex justify-end gap-2">
                                        <form action="{{ route('admin.trash.restore', $sk->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="type" value="sub_komponen">
                                            <button type="submit" class="px-3 py-1.5 bg-emerald-100 text-emerald-600 hover:bg-emerald-500 hover:text-white rounded-lg text-xs font-bold transition-colors cursor-pointer">Pulihkan</button>
                                        </form>
                                        <form action="{{ route('admin.trash.force-delete', $sk->id) }}" method="POST" onsubmit="return confirm('Hapus permanen slot ini beserta isinya?');">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="type" value="sub_komponen">
                                            <button type="submit" class="px-3 py-1.5 bg-red-100 text-red-600 hover:bg-red-500 hover:text-white rounded-lg text-xs font-bold transition-colors cursor-pointer">Hapus Permanen</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        
                        @foreach($trashedIndikator as $ind)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-4 py-4"><span class="px-2.5 py-1 bg-blue-100 text-blue-700 text-[10px] font-bold rounded-md">Indikator</span></td>
                                <td class="px-4 py-4 text-sm font-medium text-slate-700">{{ $ind->nomor_indikator }} - {{ $ind->nama_indikator }}</td>
                                <td class="px-4 py-4 text-xs text-slate-500">{{ $ind->deleted_at->format('d M Y, H:i') }}</td>
                                <td class="px-4 py-4">
                                    <div class="flex justify-end gap-2">
                                        <form action="{{ route('admin.trash.restore', $ind->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="type" value="indikator">
                                            <button type="submit" class="px-3 py-1.5 bg-emerald-100 text-emerald-600 hover:bg-emerald-500 hover:text-white rounded-lg text-xs font-bold transition-colors cursor-pointer">Pulihkan</button>
                                        </form>
                                        <form action="{{ route('admin.trash.force-delete', $ind->id) }}" method="POST" onsubmit="return confirm('Hapus permanen slot ini beserta isinya?');">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="type" value="indikator">
                                            <button type="submit" class="px-3 py-1.5 bg-red-100 text-red-600 hover:bg-red-500 hover:text-white rounded-lg text-xs font-bold transition-colors cursor-pointer">Hapus Permanen</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        @foreach($trashedSubIndikator as $si)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-4 py-4"><span class="px-2.5 py-1 bg-indigo-100 text-indigo-700 text-[10px] font-bold rounded-md">Sub Indikator</span></td>
                                <td class="px-4 py-4 text-sm font-medium text-slate-700">{{ $si->nomor_sub_indikator }} - {{ $si->nama_sub_indikator }}</td>
                                <td class="px-4 py-4 text-xs text-slate-500">{{ $si->deleted_at->format('d M Y, H:i') }}</td>
                                <td class="px-4 py-4">
                                    <div class="flex justify-end gap-2">
                                        <form action="{{ route('admin.trash.restore', $si->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="type" value="sub_indikator">
                                            <button type="submit" class="px-3 py-1.5 bg-emerald-100 text-emerald-600 hover:bg-emerald-500 hover:text-white rounded-lg text-xs font-bold transition-colors cursor-pointer">Pulihkan</button>
                                        </form>
                                        <form action="{{ route('admin.trash.force-delete', $si->id) }}" method="POST" onsubmit="return confirm('Hapus permanen slot ini beserta isinya?');">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="type" value="sub_indikator">
                                            <button type="submit" class="px-3 py-1.5 bg-red-100 text-red-600 hover:bg-red-500 hover:text-white rounded-lg text-xs font-bold transition-colors cursor-pointer">Hapus Permanen</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        @foreach($trashedDokumen as $doc)
                            {{-- Hanya tampilkan dokumen yang induknya TIDAK terhapus, supaya user bisa memulihkan dokumen individul. Jika induknya terhapus, dia otomatis akan dipulihkan saat induknya dipulihkan. --}}
                            @php
                                $parentTrashed = false;
                                if ($doc->sub_indikator_id) {
                                    $parent = \App\Models\SubIndikator::withTrashed()->find($doc->sub_indikator_id);
                                    if ($parent && $parent->trashed()) $parentTrashed = true;
                                } elseif ($doc->indikator_id) {
                                    $parent = \App\Models\Indikator::withTrashed()->find($doc->indikator_id);
                                    if ($parent && $parent->trashed()) $parentTrashed = true;
                                } elseif ($doc->sub_komponen_id) {
                                    $parent = \App\Models\SubKomponen::withTrashed()->find($doc->sub_komponen_id);
                                    if ($parent && $parent->trashed()) $parentTrashed = true;
                                }
                            @endphp
                            
                            @if(!$parentTrashed)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-4 py-4"><span class="px-2.5 py-1 bg-slate-100 text-slate-700 text-[10px] font-bold rounded-md">Dokumen</span></td>
                                <td class="px-4 py-4 text-sm font-medium text-slate-700">{{ $doc->nama_file }}</td>
                                <td class="px-4 py-4 text-xs text-slate-500">{{ $doc->deleted_at->format('d M Y, H:i') }}</td>
                                <td class="px-4 py-4">
                                    <div class="flex justify-end gap-2">
                                        <form action="{{ route('admin.trash.restore', $doc->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="type" value="dokumen">
                                            <button type="submit" class="px-3 py-1.5 bg-emerald-100 text-emerald-600 hover:bg-emerald-500 hover:text-white rounded-lg text-xs font-bold transition-colors cursor-pointer">Pulihkan</button>
                                        </form>
                                        <form action="{{ route('admin.trash.force-delete', $doc->id) }}" method="POST" onsubmit="return confirm('Hapus file ini permanen dari server?');">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="type" value="dokumen">
                                            <button type="submit" class="px-3 py-1.5 bg-red-100 text-red-600 hover:bg-red-500 hover:text-white rounded-lg text-xs font-bold transition-colors cursor-pointer">Hapus Permanen</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-6 p-4 bg-blue-50 text-blue-700 text-xs rounded-xl flex items-start gap-3 border border-blue-100">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <p><strong>Info:</strong> Memulihkan (Restore) Indikator atau Sub Indikator akan otomatis memulihkan seluruh dokumen bukti yang ada di dalamnya.</p>
            </div>
        @endif
    </div>
</div>
@endsection
