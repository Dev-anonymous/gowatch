<style>
    #intro {
        height: 80vh;
    }

    :root {
        --appcolor: #00C853;
    }

    /* Height for devices larger than 576px */
    @media (min-width: 992px) {
        #intro {
            margin-top: -58.59px;
        }
    }
    .app-btn {
        color: white;
        background: var(--appcolor);
    }
    a.nav-link {
        transition: transform .3s;
        color: var(--appcolor) !important;
    }

    a.nav-link.active>span {
        border-bottom: 2px solid #000 !important;
        padding: 5px 5px;
    }

    a.nav-link:hover {
        transform: scale(1.1);
    }
</style>
