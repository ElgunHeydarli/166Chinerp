@extends('back.layouts.master')

@php
    use Spatie\Permission\Models\Permission;
@endphp

@section('content')
    <div class="create-draftOrder-container">
        <h2 style="font-size: 28px; margin-bottom:25px;">Rola icazə ver</h2>
        <form method="POST" class="create-draftOrder">
            @csrf
            <div class="draftOrder-form">
                <div class="form-item">
                    <label for="">Başlıq<span>*</span></label>
                    <input type="text" disabled name="name" value="{{ $role->name }}" placeholder="Text here...">
                </div>

                <div class="all-groups">
                    <label>
                        <input onchange="check_all_permissions(this)" type="checkbox"> Bütün icazələr
                    </label>
                </div>

                <div class="group-container">
                    @foreach ($permission_groups as $key => $permission_group)
                        @php
                            $permissions = Permission::where('group_name', $permission_group->group_name)
                                ->orderBy('sort', 'asc')
                                ->get();
                            $checked_permission_count = 0;
                            foreach ($permissions as $permission) {
                                if ($role->hasPermissionTo($permission->name)) {
                                    $checked_permission_count++;
                                }
                            }
                        @endphp
                        <div class="group">
                            <div class="group-title">
                                <input type="checkbox" onchange="check_group_permissions(this)"
                                    {{ count($permissions) == $checked_permission_count ? 'checked' : '' }}
                                    id="permission_{{ $key }}">
                                <label for="permission_{{ $key }}">{{ $permission_group->group_name }}</label>
                            </div>
                            <div class="sub-group">

                                @foreach ($permissions as $permission)
                                    <label><input type="checkbox" onchange="change_sub_groups(this)" name="permission_id[]"
                                            value="{{ $permission->id }}"
                                            {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>{{ $permission->name }}</label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
            <button class="submitDraftOrder" type="submit">Təsdiqlə</button>
        </form>
    </div>
@endsection

@push('css')
    <style>
        .create-draftOrder-container .create-draftOrder .draftOrder-form {
            grid-template-columns: repeat(1, 1fr);
        }

        .group-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            width: 100%;
            margin: auto;
        }

        .group {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            padding: 20px;
            transition: transform 0.2s ease-in-out;
        }

        .group-title {
            font-weight: bold;
            font-size: 18px;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
            color: #333;
            cursor: pointer;
        }

        .group-title input {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .group-title label {
            cursor: pointer;
        }

        .sub-group {
            padding-left: 20px;
        }

        label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 16px;
            margin: 5px 0;
            cursor: pointer;
        }

        label input {
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .all-groups {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
@endpush

@push('js')
    <script>
        function check_all_permissions(item) {
            let checked = item.checked;
            let groups = document.querySelectorAll('.group-container [type="checkbox"]');
            groups.forEach(group => {
                group.checked = checked;
            });
        }

        function check_group_permissions(item) {
            let checked = item.checked;
            let parentElement = item.parentElement.parentElement;
            let sub_groups = parentElement.querySelectorAll('[name="permission_id[]"]');
            sub_groups.forEach(sub_group => {
                sub_group.checked = checked;
            });
        }

        function change_sub_groups(item) {
            let checked = item.checked;
            let group_title = item.parentElement.parentElement.previousElementSibling;
            let group = group_title.querySelector('[type="checkbox"]');
            if (!checked) group.checked = false;
        }
    </script>
@endpush
