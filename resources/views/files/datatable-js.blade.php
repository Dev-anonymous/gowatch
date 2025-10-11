<link rel="stylesheet" href="{{ asset('js/dt/dt.min.css') }}">
{{-- <script src="{{ asset('js/dt/pdf.js') }}"></script> --}}
{{-- <script src="{{ asset('js/dt/font.js') }}"></script> --}}
<script src="{{ asset('js/dt/dt.min.js') }}"></script>
{{-- <script src="{{ asset('js/dt/loadingoverlay.js') }}"></script> --}}
<style>
    .dt-paging-button.page-item.active button {
        color: #fff !important;
    }

    /* .btn.buttons-collection.dropdown-toggle,
    .buttons-html5 {
        background-color: var(--appcolor) !important
    }

    .dt-paging-button.page-item.active>.page-link {
        background-color: var(--appcolor) !important;
        border-radius: 50% !important
    }

    .dt-buttons.btn-group.flex-wrap {
        margin-bottom: 20px !important
    } */

    div.dataTables_processing>div:last-child>div {
        background: var(--appcolor) !important;
    }

    table th,
    table td {
        line-height: 1.2 !important;
    }
</style>
