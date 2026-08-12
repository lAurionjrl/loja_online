        <footer class="admin-footer">

            <p>
                &copy;
                <?= date('Y') ?>
                Loja Online — Painel administrativo
            </p>

            <button
                type="button"
                class="back-to-top"
                data-voltar-topo
            >

                <i
                    class="fas fa-arrow-up"
                    aria-hidden="true"
                ></i>

                Voltar ao topo

            </button>

        </footer>

    </div>

</div>

<script
    src="<?=
        htmlspecialchars(
            BASE_URL
                . '/assets/js/admin/dashboard.js',
            ENT_QUOTES,
            'UTF-8'
        )
    ?>"
></script>

</body>
</html>
