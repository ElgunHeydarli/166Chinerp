<div class="employeeTable-table">
    <table>
        <thead>
            <tr>
                <th>İşçi ID</th>
                <th>Ad</th>
                <th>Soyad</th>
                <th>Vəzifə</th>
                <th>Şöbə</th>
                <th>Ölkə</th>
                <th>Gross ə/h</th>
                <th>Nəğd</th>
                <th>Bank</th>
                <th>Hökümət ödənişləri</th>
                <th>Net ə/h</th>
                <th>Valyuta</th>
                <th>Müqavilə tarixi</th>
                <th>Müqavilə bitmə tarixi</th>
                <th>Status</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td><a href="employee-view.html">E-00{{ $user->id }}</a></td>
                    <td>{{ $user->firstname }}</td>
                    <td>{{ $user->lastname }}</td>
                    <td>{{ $user->position }}</td>
                    <td>{{ $user->branch?->name ?? ' - ' }}</td>
                    <td>{{ $user->country?->name ?? ' - ' }}</td>
                    <td>{{ $user->gross_salary }}</td>
                    <td>{{ $user->net_salary }}</td>
                    <td>{{ $user->cash }}</td>
                    <td>{{ $user->bank }}</td>
                    <td>{{ $user->government_payment }}</td>
                    <td>{{ $user->currency }}</td>
                    <td>{{ $user->start_date?->format('d.m.Y') ?? ' - ' }}</td>
                    <td>{{ $user->end_date?->format('d.m.Y') ?? ' - ' }}</td>
                    <td>
                        <!-- isleyirse jobing, islemirse quits class add olunacaq -->
                        @if ($user->status == 1)
                            <div class="status-txt jobing">
                                <span></span>
                                <p>işləyir</p>
                            </div>
                        @else
                            <div class="status-txt quits">
                                <span></span>
                                <p>işləmir</p>
                            </div>
                        @endif
                    </td>
                    <td>
                        <div class="employee-operation" onclick="open_operations()">
                            <button class="employee-operation-btn" type="button">
                                Əməliyyat
                                <svg width="19" height="19" viewBox="0 0 19 19" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_22_2058)">
                                        <path d="M5 7.38989L9.5 11.8899L14 7.38989" stroke="black" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_22_2058">
                                            <rect width="18" height="18" fill="white"
                                                transform="translate(0.5 0.639893)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </button>
                            <div class="employee-operation-links" >
                                <a href="{{ route('admin.salary.show', $user->id) }}"
                                    class="employee-operation-link employee-view-link">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M10 12C10 12.5304 10.2107 13.0391 10.5858 13.4142C10.9609 13.7893 11.4696 14 12 14C12.5304 14 13.0391 13.7893 13.4142 13.4142C13.7893 13.0391 14 12.5304 14 12C14 11.4696 13.7893 10.9609 13.4142 10.5858C13.0391 10.2107 12.5304 10 12 10C11.4696 10 10.9609 10.2107 10.5858 10.5858C10.2107 10.9609 10 11.4696 10 12Z"
                                            stroke="#534D59" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M21 12C18.6 16 15.6 18 12 18C8.4 18 5.4 16 3 12C5.4 8 8.4 6 12 6C15.6 6 18.6 8 21 12Z"
                                            stroke="#534D59" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    Bax
                                </a>
                                <a href="{{ route('admin.salary.edit', $user->id) }}"
                                    class="employee-operation-link employee-edit-link">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M19.5 12C19.5 11.8011 19.579 11.6103 19.7197 11.4697C19.8603 11.329 20.0511 11.25 20.25 11.25C20.4489 11.25 20.6397 11.329 20.7803 11.4697C20.921 11.6103 21 11.8011 21 12V20.25C21 20.4489 20.921 20.6397 20.7803 20.7803C20.6397 20.921 20.4489 21 20.25 21H3.75C3.55109 21 3.36032 20.921 3.21967 20.7803C3.07902 20.6397 3 20.4489 3 20.25V3.75C3 3.55109 3.07902 3.36032 3.21967 3.21967C3.36032 3.07902 3.55109 3 3.75 3H12C12.1989 3 12.3897 3.07902 12.5303 3.21967C12.671 3.36032 12.75 3.55109 12.75 3.75C12.75 3.94891 12.671 4.13968 12.5303 4.28033C12.3897 4.42098 12.1989 4.5 12 4.5H4.5V19.5H19.5V12Z"
                                            fill="#534D59" />
                                        <path
                                            d="M11.0145 12.9899L12.252 12.8129L19.854 5.21239C19.9256 5.1432 19.9827 5.06044 20.0221 4.96894C20.0614 4.87744 20.082 4.77902 20.0829 4.67944C20.0838 4.57985 20.0648 4.48109 20.0271 4.38892C19.9894 4.29675 19.9337 4.21301 19.8633 4.14259C19.7929 4.07217 19.7091 4.01648 19.6169 3.97877C19.5248 3.94106 19.426 3.92208 19.3264 3.92295C19.2268 3.92381 19.1284 3.9445 19.0369 3.98381C18.9454 4.02312 18.8627 4.08025 18.7935 4.15189L11.19 11.7524L11.013 12.9899H11.0145ZM20.9145 3.08989C21.1236 3.29884 21.2894 3.54694 21.4026 3.82002C21.5158 4.09309 21.574 4.38579 21.574 4.68139C21.574 4.97698 21.5158 5.26968 21.4026 5.54276C21.2894 5.81583 21.1236 6.06394 20.9145 6.27289L13.137 14.0504C13.0223 14.1655 12.8733 14.2402 12.7125 14.2634L10.2375 14.6174C10.1221 14.634 10.0045 14.6234 9.89395 14.5866C9.78339 14.5498 9.68293 14.4877 9.60053 14.4053C9.51813 14.3229 9.45607 14.2225 9.41926 14.1119C9.38245 14.0013 9.37191 13.8837 9.38848 13.7684L9.74248 11.2934C9.7652 11.1327 9.83942 10.9838 9.95398 10.8689L17.733 3.09139C18.1549 2.66958 18.7271 2.43262 19.3237 2.43262C19.9203 2.43262 20.4925 2.66958 20.9145 3.09139V3.08989Z"
                                            fill="#534D59" />
                                    </svg>
                                    Düzəlişə göndər
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $users->withQueryString()->links('back.section.pagination') }}
