<div class="receivable_pay_history-table">
    <table>
        <thead>
            <tr>
                <th>Tarix</th>
                <th>Müştəri adı</th>
                <th>Valyuta</th>
                <th>Məbləğ</th>
                <th>Ödəniş üsulu</th>
                <th>Qeyd</th>
                <th>Ölkə</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($receive_payments as $receive_payment)
                <tr>
                    <td>{{ $receive_payment->date?->format('d.m.Y') ?? ' - ' }}</td>
                    <td>{{ $receive_payment->receive->customer?->name ?? ' - ' }}</td>
                    <td>{{ $receive_payment->currency ?? ' - ' }}</td>
                    <td>{{ $receive_payment->price ?? ' - ' }}</td>
                    <td>{{ $receive_payment->payment_method?->label() ?? ' - ' }}</td>
                    <td>{{ $receive_payment->note ?? ' - ' }}</td>
                    <td>{{ $receive_payment->receive->country?->name ?? ' - ' }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th>Cəmi ödənən : {{ $all_receives->sum('price') }}</th>
            </tr>
        </tfoot>
    </table>
</div>
{{ $receive_payments->withQueryString()->links('back.section.pagination') }}
