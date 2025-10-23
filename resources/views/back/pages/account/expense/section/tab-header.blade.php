<div class="finance_tabContent_head">
    <a href="{{ route('admin.expense.index') }}"
        class="finance_tab_link {{ is_null(request('type')) && \Route::getCurrentRoute()->getName() == 'admin.expense.index' ? 'active' : '' }}">Xərclər</a>
    <a href="{{ route('admin.expense.index', ['type' => 'recurring']) }}"
        class="finance_tab_link {{ request('type') == 'recurring' && \Route::getCurrentRoute()->getName() == 'admin.expense.index' ? 'active' : '' }} ">Təkrarlanan
        ödənişlər</a>
    <a href="{{ route('admin.expense.index', ['type' => 'one-time']) }}"
        class="finance_tab_link {{ request('type') == 'one-time' && \Route::getCurrentRoute()->getName() == 'admin.expense.index' ? 'active' : '' }}">Birdəfəlik
        ödənişlər</a>
    <a href="{{ route('admin.account-payable.index') }}"
        class="finance_tab_link {{ \Route::getCurrentRoute()->getName() == 'admin.account-payable.index' ? 'active' : '' }} ">Ödəniləcək
        hesablar</a>
    <a href="{{ route('admin.account.pending') }}"
        class="finance_tab_link {{ \Route::getCurrentRoute()->getName() == 'admin.account.pending' ? 'active' : '' }} ">Təsdiq
        gözləyənlər</a>
    <a href="{{ route('admin.account.summary') }}"
        class="finance_tab_link {{ \Route::getCurrentRoute()->getName() == 'admin.account.summary' ? 'active' : '' }} ">Xülasə</a>
</div>
