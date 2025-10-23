<div class="receivable_history-table">
    <table>
        <thead>
            <tr>
                <th>Metric</th>
                <th>Valyuta</th>
                <th>Məbləğ</th>
                {{-- <th>Ölkə</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($currencies as $currency)
                <tr>
                    <td>Ümumi kreditor borcları</td>
                    <td>{{ $currency->code }}</td>
                    <td>{{ round($total_prices['total_price'][$currency->code] * 100) / 100 }}</td>
                    {{-- <td>Çin</td> --}}
                </tr>
            @endforeach

            @foreach ($currencies as $currency)
                <tr>
                    <td>Vaxtı keçmiş kreditor borcları</td>
                    <td>{{ $currency->code }}</td>
                    <td>{{ round($total_prices['total_late_price'][$currency->code] * 100) / 100 }}</td>
                    {{-- <td>Çin</td> --}}
                </tr>
            @endforeach

            @foreach ($currencies as $currency)
                <tr>
                    <td>Ödənilmiş kreditor borcları</td>
                    <td>{{ $currency->code }}</td>
                    <td>{{ round($total_prices['total_paid_price'][$currency->code] * 100) / 100 }}</td>
                    {{-- <td>Çin</td> --}}
                </tr>
            @endforeach

            @foreach ($currencies as $currency)
                <tr>
                    <td>Qarşıdan gələn ödənişlər</td>
                    <td>{{ $currency->code }}</td>
                    <td>{{ round($total_prices['total_upcoming_price'][$currency->code] * 100) / 100 }}</td>
                    {{-- <td>Çin</td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
