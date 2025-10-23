@php
    $current_locale = app()->getLocale();
@endphp

<div class="header-container">
    <div class="header">
        <a href="" class="headerlogo">
            <img src="{{ asset('back/assets') }}/images/header-logo.svg" alt="">
        </a>
        <div class="header-right">
            <div class="lang-box">
                <button class="current-lang" type="button">
                    @if ($current_locale == 'az')
                        <img src="{{ asset('back/assets/images/az.png') }}" alt="">
                    @endif

                    @if ($current_locale == 'en')
                        <img src="{{ asset('back/assets/images/us.jpg') }}" alt="">
                    @endif

                    @if ($current_locale == 'zh')
                        <img src="{{ asset('back/assets/images/zh.png') }}" alt="">
                    @endif
                </button>
                <div class="lang-items">
                    @if ($current_locale != 'az')
                        <a href="{{ route('admin.change-lang', ['lang' => 'az']) }}" class="lang-item">
                            <img src="{{ asset('back/assets/images/az.png') }}" alt="">
                            <p>Azerbaijan</p>
                        </a>
                    @endif

                    @if ($current_locale != 'en')
                        <a href="{{ route('admin.change-lang', ['lang' => 'en']) }}" class="lang-item">
                            <img src="{{ asset('back/assets/images/us.jpg') }}" alt="">
                            <p>English</p>
                        </a>
                    @endif
                    @if ($current_locale != 'zh')
                        <a href="{{ route('admin.change-lang', ['lang' => 'zh']) }}" class="lang-item">
                            <img src="{{ asset('back/assets/images/zh.png') }}" alt="">
                            <p>Chinese</p>
                        </a>
                    @endif
                </div>
            </div>
            <div class="notification-box">
                <!-- eger bildiris varsa, butona "have_notifaciton" classi add ele -->
                <button
                    class="notification_btn {{ count(auth()->user()->unreadNotifications) ? 'have_notifaciton' : '' }} "
                    type="button">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M18.134 11C18.715 16.375 21 18 21 18H3C3 18 6 15.867 6 8.4C6 6.703 6.632 5.075 7.757 3.875C8.882 2.675 10.41 2 12 2C12.338 2 12.6713 2.03 13 2.09M13.73 21C13.5542 21.3031 13.3018 21.5547 12.9982 21.7295C12.6946 21.9044 12.3504 21.9965 12 21.9965C11.6496 21.9965 11.3054 21.9044 11.0018 21.7295C10.6982 21.5547 10.4458 21.3031 10.27 21M19 8C19.7956 8 20.5587 7.68393 21.1213 7.12132C21.6839 6.55871 22 5.79565 22 5C22 4.20435 21.6839 3.44129 21.1213 2.87868C20.5587 2.31607 19.7956 2 19 2C18.2044 2 17.4413 2.31607 16.8787 2.87868C16.3161 3.44129 16 4.20435 16 5C16 5.79565 16.3161 6.55871 16.8787 7.12132C17.4413 7.68393 18.2044 8 19 8Z"
                            stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <div class="notification-box-main">
                    <div class="box-main-head">
                        <h2>Notifications</h2>
                        <a href="" class="viewAll">View All</a>
                    </div>
                    <div class="notification-box-items">
                        <!-- eger oxunmamis bildiris varsa, "unread" classi elave olunmalidi -->
                        @foreach (auth()->user()->notifications as $notification)
                            @if (isset($notification->data['order_item_id']))
                                <a href=""
                                    onclick="get_order_details({{ $notification->data['order_item_id'] }})"
                                    class="box-item {{ is_null($notification->read_at) ? 'unread' : '' }}">
                                    <div class="icon">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18 12H12M12 12H6M12 12V6M12 12V18" stroke="white"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>

                                    <div class="item-body">
                                        <h3>Admin</h3>
                                        <p>{{ $notification->data['message'] }}</p>
                                        <div class="item-time">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 8V12L14.5 14.5" stroke="#000" stroke-width="1.5"
                                                    stroke-opacity=".6" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M7 3.33782C8.47087 2.48697 10.1786 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 10.1786 2.48697 8.47087 3.33782 7"
                                                    stroke="#000" stroke-width="1.5" stroke-opacity=".6"
                                                    stroke-linecap="round" />
                                            </svg>
                                            <span>{{ $notification->created_at->format('d.m.Y H:i') }}</span>
                                        </div>
                                    </div>
                                </a>
                            @else
                                <a href=""
                                    class="box-item {{ is_null($notification->read_at) ? 'unread' : '' }}">
                                    <div class="icon">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18 12H12M12 12H6M12 12V6M12 12V18" stroke="white"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>

                                    <div class="item-body">
                                        <h3>Admin</h3>
                                        <p>{{ $notification->data['message'] }}</p>
                                        <div class="item-time">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 8V12L14.5 14.5" stroke="#000" stroke-width="1.5"
                                                    stroke-opacity=".6" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M7 3.33782C8.47087 2.48697 10.1786 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 10.1786 2.48697 8.47087 3.33782 7"
                                                    stroke="#000" stroke-width="1.5" stroke-opacity=".6"
                                                    stroke-linecap="round" />
                                            </svg>
                                            <span>{{ $notification->created_at->format('d.m.Y H:i') }}</span>
                                        </div>
                                    </div>
                                </a>
                            @endif
                        @endforeach
                    </div>

                </div>
            </div>
            <div class="adminDropDown-box">
                <button class="adminDropDown_btn" type="button">
                    <div class="admin-img">
                        <img src="{{ asset('back/assets') }}/images/header-logo.svg" alt="">
                    </div>
                    <p>{{ auth()->user()->name }}</p>
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.3327 6.66667L7.99935 10L4.66602 6.66667" stroke="white" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
                <div class="adminDropDown-box-main">
                    <a href="" class="adminDropDown-link">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="6" r="4" stroke="#000" stroke-width="1.5"
                                stroke-opacity=".6" />
                            <path
                                d="M19.9975 18C20 17.8358 20 17.669 20 17.5C20 15.0147 16.4183 13 12 13C7.58172 13 4 15.0147 4 17.5C4 19.9853 4 22 12 22C14.231 22 15.8398 21.8433 17 21.5634"
                                stroke="#000" stroke-opacity=".6" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                        <p>Profile</p>
                    </a>
                    <a href="" class="adminDropDown-link">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="3" stroke="#000" stroke-width="1.5"
                                stroke-opacity=".6" />
                            <path
                                d="M3.66122 10.6392C4.13377 10.9361 4.43782 11.4419 4.43782 11.9999C4.43781 12.558 4.13376 13.0638 3.66122 13.3607C3.33966 13.5627 3.13248 13.7242 2.98508 13.9163C2.66217 14.3372 2.51966 14.869 2.5889 15.3949C2.64082 15.7893 2.87379 16.1928 3.33973 16.9999C3.80568 17.8069 4.03865 18.2104 4.35426 18.4526C4.77508 18.7755 5.30694 18.918 5.83284 18.8488C6.07287 18.8172 6.31628 18.7185 6.65196 18.5411C7.14544 18.2803 7.73558 18.2699 8.21895 18.549C8.70227 18.8281 8.98827 19.3443 9.00912 19.902C9.02332 20.2815 9.05958 20.5417 9.15224 20.7654C9.35523 21.2554 9.74458 21.6448 10.2346 21.8478C10.6022 22 11.0681 22 12 22C12.9319 22 13.3978 22 13.7654 21.8478C14.2554 21.6448 14.6448 21.2554 14.8478 20.7654C14.9404 20.5417 14.9767 20.2815 14.9909 19.9021C15.0117 19.3443 15.2977 18.8281 15.7811 18.549C16.2644 18.27 16.8545 18.2804 17.3479 18.5412C17.6837 18.7186 17.9271 18.8173 18.1671 18.8489C18.693 18.9182 19.2249 18.7756 19.6457 18.4527C19.9613 18.2106 20.1943 17.807 20.6603 17C20.8677 16.6407 21.029 16.3614 21.1486 16.1272M20.3387 13.3608C19.8662 13.0639 19.5622 12.5581 19.5621 12.0001C19.5621 11.442 19.8662 10.9361 20.3387 10.6392C20.6603 10.4372 20.8674 10.2757 21.0148 10.0836C21.3377 9.66278 21.4802 9.13092 21.411 8.60502C21.3591 8.2106 21.1261 7.80708 20.6601 7.00005C20.1942 6.19301 19.9612 5.7895 19.6456 5.54732C19.2248 5.22441 18.6929 5.0819 18.167 5.15113C17.927 5.18274 17.6836 5.2814 17.3479 5.45883C16.8544 5.71964 16.2643 5.73004 15.781 5.45096C15.2977 5.1719 15.0117 4.6557 14.9909 4.09803C14.9767 3.71852 14.9404 3.45835 14.8478 3.23463C14.6448 2.74458 14.2554 2.35523 13.7654 2.15224C13.3978 2 12.9319 2 12 2C11.0681 2 10.6022 2 10.2346 2.15224C9.74458 2.35523 9.35523 2.74458 9.15224 3.23463C9.05958 3.45833 9.02332 3.71848 9.00912 4.09794C8.98826 4.65566 8.70225 5.17191 8.21891 5.45096C7.73557 5.73002 7.14548 5.71959 6.65205 5.4588C6.31633 5.28136 6.0729 5.18269 5.83285 5.15108C5.30695 5.08185 4.77509 5.22436 4.35427 5.54727C4.03866 5.78945 3.80569 6.19297 3.33974 7C3.13231 7.35929 2.97105 7.63859 2.85138 7.87273"
                                stroke="#000" stroke-opacity=".6" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                        <p>Settings</p>
                    </a>
                    <a href="{{ route('logout') }}" class="adminDropDown-exit">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 12L2 12M2 12L5.5 9M2 12L5.5 15" stroke="#ff0000" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M9.00195 7C9.01406 4.82497 9.11051 3.64706 9.87889 2.87868C10.7576 2 12.1718 2 15.0002 2L16.0002 2C18.8286 2 20.2429 2 21.1215 2.87868C22.0002 3.75736 22.0002 5.17157 22.0002 8L22.0002 16C22.0002 18.8284 22.0002 20.2426 21.1215 21.1213C20.3531 21.8897 19.1752 21.9862 17 21.9983M9.00195 17C9.01406 19.175 9.11051 20.3529 9.87889 21.1213C10.5202 21.7626 11.4467 21.9359 13 21.9827"
                                stroke="#ff0000" stroke-width="1.5" stroke-linecap="round" />
                        </svg>

                        <p>Exit</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
