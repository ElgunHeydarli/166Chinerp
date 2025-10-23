<div class="custom-modal" id="infoModal">
    <div class="custom-modal-content">
        <span class="custom-modal-close" onclick="close_log_modal()" id="closeModal">&times;</span>
        <h2>Status Tarixçəsi</h2>

        <div class="timeline">
            @foreach ($status_changes as $status_change)
                <div class="timeline-item">
                    <div class="timeline-title">{{ $status_change->status }}</div>
                    <div class="timeline-file">
                        <a href="{{ asset($status_change->file) }}" target="_blank" >Fayla bax</a>
                    </div>
                    <div class="timeline-date">{{ $status_change->created_at->format('d.m.Y H:i') }}</div>
                </div>
            @endforeach
        </div>

    </div>
</div>
