document.addEventListener(
    'DOMContentLoaded',
    function () {
        const botaoMenu =
            document.querySelector(
                '[data-sidebar-toggle]'
            );

        const overlay =
            document.querySelector(
                '[data-sidebar-overlay]'
            );

        const botaoTopo =
            document.querySelector(
                '[data-voltar-topo]'
            );

        function abrirOuFecharMenu() {
            document.body.classList.toggle(
                'sidebar-open'
            );
        }

        function fecharMenu() {
            document.body.classList.remove(
                'sidebar-open'
            );
        }

        if (botaoMenu) {
            botaoMenu.addEventListener(
                'click',
                abrirOuFecharMenu
            );
        }

        if (overlay) {
            overlay.addEventListener(
                'click',
                fecharMenu
            );
        }

        document.addEventListener(
            'keydown',
            function (evento) {
                if (evento.key === 'Escape') {
                    fecharMenu();
                }
            }
        );

        if (botaoTopo) {
            botaoTopo.addEventListener(
                'click',
                function () {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                }
            );
        }
    }
);
