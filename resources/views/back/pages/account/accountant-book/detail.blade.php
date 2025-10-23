@extends('back.layouts.master')

@section('content')
    <div class="financial_book_view_container">
        <a href="financial_book.html" class="backLink">
            <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M9.80442 17.7083L18.0112 25.9136L16.9997 26.9166L7.08301 16.9999L16.9997 7.08325L18.0112 8.08625L9.80301 16.2916H26.9163V17.7083H9.80442Z"
                    fill="black" />
            </svg>
            Geri
        </a>
        <div class="head-title">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M12 22C6.477 22 2 17.523 2 12C2 6.477 6.477 2 12 2C17.523 2 22 6.477 22 12C22 17.523 17.523 22 12 22ZM12 20.8C14.3339 20.8 16.5722 19.8729 18.2225 18.2225C19.8729 16.5722 20.8 14.3339 20.8 12C20.8 9.6661 19.8729 7.42778 18.2225 5.77746C16.5722 4.12714 14.3339 3.2 12 3.2C9.6661 3.2 7.42778 4.12714 5.77746 5.77746C4.12714 7.42778 3.2 9.6661 3.2 12C3.2 14.3339 4.12714 16.5722 5.77746 18.2225C7.42778 19.8729 9.6661 20.8 12 20.8ZM11.4 10H12.6V17H11.4V10ZM12 9C11.7348 9 11.4804 8.89464 11.2929 8.70711C11.1054 8.51957 11 8.26522 11 8C11 7.73478 11.1054 7.48043 11.2929 7.29289C11.4804 7.10536 11.7348 7 12 7C12.2652 7 12.5196 7.10536 12.7071 7.29289C12.8946 7.48043 13 7.73478 13 8C13 8.26522 12.8946 8.51957 12.7071 8.70711C12.5196 8.89464 12.2652 9 12 9Z"
                    fill="#534D59" />
            </svg>
            <p>Maliyyə kitabı məlumatları</p>
        </div>
        <div class="financial_book_view-table">
            <table>
                <thead>
                    <tr>
                        <th>Tarix</th>
                        <th>Jurnal detalı</th>
                        <th>Debet</th>
                        <th>Kredit</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>10.01.2025</td>
                        <td>Jurnal detalı</td>
                        <td>1000</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>10.01.2025</td>
                        <td>Jurnal detalı</td>
                        <td>&nbsp;</td>
                        <td>2000</td>
                    </tr>
                    <tr>
                        <td>10.01.2025</td>
                        <td>Jurnal detalı</td>
                        <td>1000</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>10.01.2025</td>
                        <td>Jurnal detalı</td>
                        <td>&nbsp;</td>
                        <td>2000</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
    <div class="pagination">
        <a href="" class="prev">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15 5L9 12L15 19" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                </path>
            </svg>
        </a>
        <a href="" class="pagination_item active">1</a>
        <a href="" class="pagination_item">2</a>
        <p class="pagination_item">...</p>
        <a href="" class="pagination_item">10</a>
        <a href="" class="next">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 5L15 12L9 19" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                </path>
            </svg>
        </a>
    </div>
@endsection
