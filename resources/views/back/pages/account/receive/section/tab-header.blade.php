<div class="finance_tabContent_head">
    <a href="{{ route('admin.receive.index') }}"
        class="finance_tab_link {{ Route::getCurrentRoute()->getName() == 'admin.receive.index' ? 'active' : '' }}">Alınacaq
        hesablar</a>
    <a href="{{ route('admin.receive.report') }}"
        class="finance_tab_link {{ Route::getCurrentRoute()->getName() == 'admin.receive.report' ? 'active' : '' }} ">Ümumi
        hesabat</a>
    <a href="{{ route('admin.receive.history') }}"
        class="finance_tab_link {{ Route::getCurrentRoute()->getName() == 'admin.receive.history' ? 'active' : '' }} ">Ödənişlərin
        tarixçəsi</a>
</div>
