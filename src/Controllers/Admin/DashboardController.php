<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Helpers\Csrf;

final class DashboardController
    extends Controller
{
    public function index(): void
    {
        if (
            empty(
                $_SESSION[
                    'usuario_admin'
                ]['id']
            )
        ) {
            $this->redirecionar(
                '/login-admin'
            );

            return;
        }

        $itensMenu = [
            [
                'id' => 'dashboard',
                'texto' => 'Dashboard',
                'icone' => 'fas fa-home',
                'path' => '/admin',
            ],
            [
                'id' => 'produtos',
                'texto' => 'Produtos',
                'icone' => 'fas fa-box',
                'path' => '/admin/produtos',
            ],
            [
                'id' => 'clientes',
                'texto' => 'Clientes',
                'icone' => 'fas fa-users',
                'path' => '/admin/clientes',
            ],
            [
                'id' => 'pedidos',
                'texto' => 'Pedidos',
                'icone' => 'fas fa-shopping-cart',
                'path' => '/admin/pedidos',
            ],
            [
                'id' => 'configuracoes',
                'texto' => 'Configurações',
                'icone' => 'fas fa-cog',
                'path' => '/admin/configuracoes',
            ],
        ];

        $indicadores = [
            [
                'titulo' => 'Produtos',
                'valor' => 1240,
                'icone' => 'fas fa-box',
                'classe' => 'bg-blue',
            ],
            [
                'titulo' => 'Clientes',
                'valor' => 8432,
                'icone' => 'fas fa-users',
                'classe' => 'bg-green',
            ],
            [
                'titulo' => 'Endereços',
                'valor' => 10125,
                'icone' => 'fas fa-map-marker-alt',
                'classe' => 'bg-purple',
            ],
            [
                'titulo' => 'Carrinhos ativos',
                'valor' => 342,
                'icone' => 'fas fa-shopping-basket',
                'classe' => 'bg-orange',
            ],
            [
                'titulo' => 'Pedidos',
                'valor' => 5890,
                'icone' => 'fas fa-shopping-cart',
                'classe' => 'bg-indigo',
            ],
            [
                'titulo' => 'Pagamentos',
                'valor' => 'R$ 142 mil',
                'icone' => 'fas fa-credit-card',
                'classe' => 'bg-teal',
            ],
            [
                'titulo' => 'Estoque baixo',
                'valor' => '15 itens',
                'icone' => 'fas fa-warehouse',
                'classe' => 'bg-red',
            ],
            [
                'titulo' => 'Notificações',
                'valor' => '8 novas',
                'icone' => 'fas fa-bell',
                'classe' => 'bg-pink',
            ],
        ];

        $acoesRapidas = [
            [
                'texto' => 'Cadastrar produto',
                'icone' => 'fas fa-plus',
                'path' => '/admin/produtos/novo',
            ],
            [
                'texto' => 'Consultar pedidos',
                'icone' => 'fas fa-receipt',
                'path' => '/admin/pedidos',
            ],
            [
                'texto' => 'Listar clientes',
                'icone' => 'fas fa-user-group',
                'path' => '/admin/clientes',
            ],
        ];

        $avisos = [
            [
                'texto' =>
                    'Existem 15 produtos com estoque baixo.',

                'icone' =>
                    'fas fa-triangle-exclamation',

                'classe' =>
                    'notice-warning',
            ],
            [
                'texto' =>
                    'Existem 8 notificações não lidas.',

                'icone' =>
                    'fas fa-bell',

                'classe' =>
                    'notice-info',
            ],
        ];

        $this->view(
            'admin/dashboard',
            [
                'tituloPagina' =>
                    'Dashboard administrativo',

                'usuarioAdmin' =>
                    $_SESSION[
                        'usuario_admin'
                    ],

                'csrfToken' =>
                    Csrf::gerar(),

                'menuAtivo' =>
                    'dashboard',

                'itensMenu' =>
                    $itensMenu,

                'indicadores' =>
                    $indicadores,

                'acoesRapidas' =>
                    $acoesRapidas,

                'avisos' =>
                    $avisos,
            ]
        );
    }
}
