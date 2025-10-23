<!-- Modal -->
@if (Session::has('error_messages'))
    <div id="errorModal" class="custom-modal">
        <div class="custom-modal-content">
            <div class="custom-modal-header">
                <span class="error-icon">❌</span>
                <h2>Xəta baş verdi</h2>
            </div>
            <div class="custom-modal-body">
                <ul id="error-list">
                    @foreach (Session::get('error_messages', []) as $error_message)
                        <li>{{ $error_message }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="custom-modal-footer">
                <button id="closeModalBtn">Geri</button>
            </div>
        </div>
    </div>
@endif
