@extends('back.layouts.master')

@section('title', 'Ümumi Jurnal')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>

<div class="finance_tab_content">
    <div class="tabContent-head">
        <!-- ✅ Form başlanğıcı -->
        <form action="" method="GET" class="flex gap-3 items-center">
            <input type="text" name="search" placeholder="Axtar" value="{{ request('search') }}" class="border p-2 rounded w-40">

            <input type="text" name="start_time" class="datetimepicker border p-2 rounded w-40" placeholder="Start Time" value="{{ request('start_time') }}">
            <input type="text" name="end_time" class="datetimepicker border p-2 rounded w-40" placeholder="End Time" value="{{ request('end_time') }}">

            <button class="submitForm bg-blue-600 text-white p-2 rounded" type="submit">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                    <circle cx="11.5" cy="11.5" r="9.5" stroke="white" stroke-width="1.5"/>
                    <path d="M18.5 18.5L22 22" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
            </button>
        </form>
        <!-- ✅ Form sonu -->
    </div>

    <div class="generalFinance mt-6">
        <div class="generalFinance-table overflow-x-auto">
            <table class="min-w-full border text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2">Jurnal ID</th>
                        <th class="p-2">D.o tarixi</th>
                        <th class="p-2">Debet №</th>
                        <th class="p-2">Debet Adı</th>
                        <th class="p-2">Debet məbləği</th>
                        <th class="p-2">Kredit №</th>
                        <th class="p-2">Kredit Adı</th>
                        <th class="p-2">Kredit məbləği</th>
                        <th class="p-2">Valyuta</th>
                        <th class="p-2">Açıqlama</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($entries as $entry)
                        <tr class="border-t">
                            <td class="p-2">{{ $entry->journal_id }}</td>
                            <td class="p-2">{{ \Carbon\Carbon::parse($entry->operation_date)->format('d.m.Y') }}</td>
                            <td class="p-2">{{ $entry->debit_account_number }}</td>
                            <td class="p-2">{{ $entry->debit_account_name }}</td>
                            <td class="p-2 text-green-600 font-semibold">{{ number_format($entry->debit_amount, 2) }}</td>
                            <td class="p-2">{{ $entry->credit_account_number }}</td>
                            <td class="p-2">{{ $entry->credit_account_name }}</td>
                            <td class="p-2 text-red-600 font-semibold">{{ number_format($entry->credit_amount, 2) }}</td>
                            <td class="p-2">{{ $entry->currency }}</td>
                            <td class="p-2">{{ $entry->description }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center p-4 text-gray-500">Məlumat tapılmadı.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ✅ JS: Tarix seçimi və avtomatik submit -->
<script>
    jQuery('.datetimepicker').datetimepicker({
        timepicker: false,
        format: 'd.m.Y'
    });

    // Tarix dəyişəndə form avtomatik submit olsun
    document.querySelectorAll('[name="start_time"], [name="end_time"]').forEach(function(input) {
        input.addEventListener('change', function () {
            input.form.submit();
        });
    });
</script>
@endsection
