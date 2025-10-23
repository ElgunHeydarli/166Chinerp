<table>
    <thead>
        <tr>
            <th>Xərc ID</th>
            <th>Kateqoriya</th>
            <th>Alt kateqoriya</th>
            <th>Log ID</th>
            <th>Təhcizatçı</th>
            <th>Xərc növü</th>
            <th>Valyuta</th>
            <th>Cəmi məbləğ</th>
            <th>Ödənmiş məbləğ</th>
            <th>Qalıq</th>
            <th>Son ödəmə tarixi</th>
            <th>Qeyd</th>
            <th>Status</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($expenses as $expense)
            <tr>
                <td>EXP-{{ str_pad($expense->id, 4, '0', STR_PAD_LEFT) }}</td>
                <td>{{ $expense->category->name ?? '-' }}</td>
                <td>{{ $expense->sub_category->name ?? '-' }}</td>
                <td>{{ $expense->log_id ?? '-' }}</td>
                <td>{{ $expense->factory ?? '-' }}</td>
                <td>{{ $expense->expense_type->label() ?? ' - ' }}</td>
                <td>{{ $expense->currency ?? '-' }}</td>
                <td>{{ number_format($expense->total_price, 2) }}</td>
                <td>{{ number_format($expense->pay_price, 2) }}</td>
                <td>{{ number_format($expense->remainder, 2) }}</td>
                <td>{{ optional($expense->last_payment_date)->format('d.m.Y') }}</td>
                <td>{{ $expense->note }}</td>
                <td>
                    @php
                        $statusClass = $expense->status == 1 ? 'paid' : ($expense->status == 0 ? 'pending' : 'reject');
                        $statusText =
                            $expense->status == 1 ? 'Ödənilib' : ($expense->status == 0 ? 'Gözləmədə' : 'İmtina');
                    @endphp
                    <div class="status-txt {{ $statusClass }}">
                        <span></span>
                        <p>{{ $statusText }}</p>
                    </div>
                </td>
                <td>
                    <div class="costManagement-operation">
                        <button class="costManagement-operation-btn" type="button">
                            Əməliyyat
                            <svg width="19" height="19" viewBox="0 0 19 19" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 7.38989L9.5 11.8899L14 7.38989" stroke="black" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                        <div class="costManagement-operation-links">
                            <a href="{{ route('admin.expense.show', $expense->id) }}"
                                class="costManagement-operation-link costManagement-view">
                                Bax
                            </a>
                            <a href="{{ route('admin.expense.edit', $expense->id) }}"
                                class="costManagement-operation-link costManagement-edit">
                                Düzəlişə göndər
                            </a>
                            <button data-href="{{ route('admin.expense.destroy', $expense->id) }}"
                                class="costManagement-operation-link settingTable_delete"
                                onclick="open_delete_modal(this)">
                                Sil
                            </button>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>

</table>
{{ $expenses->withQueryString()->links('back.section.pagination') }}
