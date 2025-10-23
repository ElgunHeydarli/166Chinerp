<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js">
</script>
<script>
    jQuery('.datetimepicker').datetimepicker({
        timepicker: false,
        format: 'd.m.Y',
        onShow: function(ct, $input) {
            $input.off('mousewheel');
        }
    });
</script>
<script src="{{ asset('back/assets') }}/jquery-nice-select-1.1.0/js/jquery.js"></script>
<script src="{{ asset('back/assets') }}/jquery-nice-select-1.1.0/js/jquery.nice-select.min.js"></script>
<script src="{{ asset('back/assets') }}/js/index.js?v={{ time() }}"></script>
<script src="{{ asset('back/assets/select2/select.js') }}"></script>
{{-- <script src="{{ asset('back/assets/js/custom.js') }}"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
    $(document).ready(function() {
        $('select.nice-select').niceSelect();

        $('select.select2').select2({
            minimumResultsForSearch: 0
        });
    });
</script>
<script>
    function sort(tables) {
        const table = document.getElementById('sortable-table').querySelector('tbody');
        new Sortable(table, {
            animation: 150,
            handle: 'tr',
            onEnd: function(evt) {
                const sortedIDs = Array.from(table.querySelectorAll('tr')).map(row => row.dataset.id);
                let url = `/${tables}/sort`;
                fetch(url, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'content-type': 'application/json',
                        },
                        body: JSON.stringify({
                            '_token': "{{ csrf_token() }}",
                            'sorted_ids': sortedIDs,
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status == 'success') {
                            console.log(data.message);
                        } else {
                            console.error(data.message);
                        }
                    });
            }
        });
    }
</script>

<script>
    function change_status(item, id, tables) {
        let url = `/${tables}/${id}/change-status`;
        let status = item.checked ? 1 : 0;
        fetch(url, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    '_token': "{{ csrf_token() }}",
                    'status': status
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status == 'success') {
                    toastr.success(data.message);
                } else {
                    toastr.error(data.message);
                }
            });
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}")
        @endforeach
    @endif
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll("form").forEach(form => {
            form.addEventListener("submit", function(e) {
                const submitButton = form.querySelector('[type="submit"]');
                if (submitButton) {
                    submitButton.disabled = true;
                    setTimeout(() => {
                        submitButton.disabled = false;
                    }, 5000);
                }
            });
        });
    });
</script>


<script>
    let resetSelectBtns = document.querySelectorAll('.resetSelectBtn');
    resetSelectBtns.forEach(resetSelectBtn => {
        resetSelectBtn.addEventListener('click', function() {
            let select = resetSelectBtn.previousElementSibling.previousElementSibling;
            select.value = '';
            $(select).niceSelect('update');
        });
    });
</script>

<script>
    function add_file(input) {
        let fileArea = input.closest(".file-area"); // Parent olan file-area'yı bul
        let fileNameSpan = fileArea.querySelector(".fileName");

        if (input.files.length > 0) {
            fileNameSpan.textContent = input.files[0].name; // Dosya adını yazdır
            fileArea.classList.add("active"); // active sınıfını ekle
        } else {
            fileNameSpan.textContent = ""; // Dosya seçilmezse boş bırak
            fileArea.classList.remove("active"); // active sınıfını kaldır
        }
    }
</script>


@stack('js')
