<div class="container_tabContent_head">
    @can('Bütün Konteynerlər page')
        <a class="container_tab_btn {{ request('status', 'accepted') == 'accepted' ? 'active' : '' }}"
            href="{{ route('admin.container.index', ['status' => \App\Enums\ContainerStatus::ACCEPTED]) }}"
            id="allContainers">{{ trns('all_containers') }}</a>
    @endcan
    @can('Yeni Konteynerlər page')
        <a class="container_tab_btn {{ request('status', 'accepted') == 'pending' ? 'active' : '' }}"
            href="{{ route('admin.container.index', ['status' => \App\Enums\ContainerStatus::PENDING]) }}"
            id="newContainers">{{ trns('new_containers') }}</a>
    @endcan
</div>
@include('back.pages.container.section.all-container', ['containers' => $containers])
@include('back.pages.container.section.new-container', ['containers' => $containers])
{{ $containers->withQueryString()->links('back.section.pagination') }}
