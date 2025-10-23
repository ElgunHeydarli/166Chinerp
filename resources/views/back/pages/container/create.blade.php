@extends('back.layouts.master')

@section('content')
    <div class="createContainerOrder-container">
        <a href="{{ route('admin.container.index') }}" class="backBtn" type="button">
            <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M9.80442 17.7083L18.0112 25.9136L16.9997 26.9166L7.08301 16.9999L16.9997 7.08325L18.0112 8.08625L9.80301 16.2916H26.9163V17.7083H9.80442Z"
                    fill="black" />
            </svg>
            Geri
        </a>
        <form action="{{ route('admin.container.store') }}" method="POST" enctype="multipart/form-data"
            class="createContainerOrder-form">
            @csrf
            <div class="addForm_list">
                <div class="list-items">
                    @include('back.pages.container.section.add-new-container', [
                        'container_types' => $container_types,
                        'currencies' => $currencies,
                        'vendors' => $vendors,
                        'counter' => 0,
                    ])
                </div>
                <button class="addNewCreateContainerOrder" onclick="add_container()" type="button">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 12H12M12 12H6M12 12V6M12 12V18" stroke="white" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Yenisini əlavə et
                </button>
            </div>

            <div class="form-main">
                <button class="submitNewCreateContainerOrder" type="submit">
                    Sifarişi təsdiq et
                </button>
            </div>

        </form>
    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js">
    </script>
    <script>
        let counter = 0;

        function add_container() {
            counter++;
            let url = `/container/add-container?counter=${counter}`;
            let addForm_list = document.querySelector('.addForm_list .list-items');
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    if (data.status == 'success') {
                        addForm_list.insertAdjacentHTML('beforeend', data.view);
                        let all_selects = document.querySelectorAll('select');
                        all_selects.forEach(select => {
                            $(select).niceSelect();
                        });
                        jQuery('.datetimepicker').datetimepicker({
                            timepicker: false,
                            format: 'd.m.Y',
                            onShow: function(ct, $input) {
                                $input.off('mousewheel');
                            }
                        });
                    }
                })
        }

        function delete_item(item) {
            item.parentElement.remove();
        }
    </script>

    <script>
        async function file_upload(item) {
            let container = item.parentElement.parentElement;
            let imagesFileUpload = container.querySelector('.images-fileUpload');
            let files = item.files;

            if (files.length) {
                for (let file of files) { // forEach əvəzinə for...of istifadə edirik
                    let imgFileUploadArea = document.createElement('div');
                    imgFileUploadArea.classList.add('img-fileUpload-area');
                    imgFileUploadArea.innerHTML = `
                        <img src="{{ asset('back/assets') }}/images/pdfImg.svg" alt="">
                        <div class="img-fileUpload-main">
                            <div class="img-fileUpload-top">
                                <span class="img-FileName">${file.name}</span>
                                <p class="img-fileSize">${(file.size / (1024 * 1024)).toFixed(2)} MB</p>
                            </div>
                            <div class="img-fileProgress">
                                <div class="uploadLine"></div>
                            </div>
                        </div>
                        <button onclick='remove_file(this)' class="removeImgFile" type="button">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.5 4.5L4.5 13.5M4.5 4.5L13.5 13.5" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    `;

                    imagesFileUpload.appendChild(imgFileUploadArea);
                    let imageUploadLine = imgFileUploadArea.querySelector('.uploadLine'); // Düzgün element seçirik

                    imageUploadLine.style.transition = 'none';
                    imageUploadLine.style.width = '0%';

                    await new Promise((resolve) => setTimeout(resolve, 100)); // Gözləmə əlavə edirik

                    imageUploadLine.style.transition = 'width 0.5s linear';
                    simulateFileUploadProgress(imageUploadLine); // Yükləmə prosesini çağırırıq
                }
            }
        }

        const simulateFileUploadProgress = (progressElement) => {
            let progress = 0;
            const interval = setInterval(() => {
                progress += 10;
                progressElement.style.width = `${progress}%`;
                if (progress >= 100) clearInterval(interval);
            }, 50);
        };
    </script>
@endpush
