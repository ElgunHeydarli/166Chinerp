<div class="finance_tabContent_head">
    <a href="{{ route('admin.salary.index') }}"
        class="finance_tab_link {{ is_null(request('status')) && \Route::getCurrentRoute()->getName() == 'admin.salary.index' ? 'active' : '' }}">Bütün
        işçilər</a>
    <a href="{{ route('admin.salary.index', ['status' => 1]) }}"
        class="finance_tab_link {{ request('status') === '1' && \Route::getCurrentRoute()->getName() == 'admin.salary.index' ? 'active' : '' }}">İşləyənlər</a>
    <a href="{{ route('admin.salary.index', ['status' => 0]) }}"
        class="finance_tab_link {{ request('status') === '0' && \Route::getCurrentRoute()->getName() == 'admin.salary.index' ? 'active' : '' }} ">İşdən
        çıxanlar</a>
    <a href="{{ route('admin.salary-management.index') }}"
        class="finance_tab_link {{ \Route::getCurrentRoute()->getName() == 'admin.salary-management.index' ? 'active' : '' }}">Əməkhaqqı
        idarə etmək</a>
    <a href="{{ route('admin.payment-history.index') }}"
        class="finance_tab_link {{ \Route::getCurrentRoute()->getName() == 'admin.payment-history.index' ? 'active' : '' }} ">Ödəniş
        tarixçəsi</a>
    <a href="{{ route('admin.bulk-payment.index') }}"
        class="finance_tab_link {{ \Route::getCurrentRoute()->getName() == 'admin.bulk-payment.index' ? 'active' : '' }}  ">Toplu
        ödənişlər</a>
</div>
