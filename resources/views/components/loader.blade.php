<style>
    .loadingoverlay {
        z-index: 999 !important;
    }

    .loader {
        position: fixed;
        left: 0px;
        right: 0px;
        top: 0px;
        bottom: 0px;
        opacity: 1;
        background: white;
        z-index: 999999999;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .loader>span {
        border: 2px solid #f3f3f3;
        border-radius: 50%;
        border-top: 4px solid #00C853;
        width: 80px;
        height: 80px;
        -webkit-animation: spin .4s linear infinite;
        animation: spin .4s linear infinite;
    }

    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

<div class="loader">
    <span></span>
</div>
