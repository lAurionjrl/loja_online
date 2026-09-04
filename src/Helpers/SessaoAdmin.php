<?php

declare(strict_types=1);

namespace App\Helpers;

final class SessaoAdmin
{
    /*
    |--------------------------------------------------------------------------
    | Registrar login do administrador
    |--------------------------------------------------------------------------
    */
    public static function entrar(array $usuario): void
    {
        session_regenerate_id(true);

        $_SESSION['admin'] = [
            'id' => (int) ($usuario['id'] ?? 0),
            'nome' => (string) ($usuario['nome'] ?? ''),
            'email' => (string) ($usuario['email'] ?? ''),
            'autenticado_em' => time(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Verificar autenticação
    |--------------------------------------------------------------------------
    */
    public static function autenticado(): bool
    {
        return isset($_SESSION['admin'])
            && is_array($_SESSION['admin'])
            && !empty($_SESSION['admin']['id']);
    }

    /*
    |--------------------------------------------------------------------------
    | Dados do administrador
    |--------------------------------------------------------------------------
    */
    public static function dados(): array
    {
        return is_array(
            $_SESSION['admin'] ?? null
        )
            ? $_SESSION['admin']
            : [];
    }

    /*
    |--------------------------------------------------------------------------
    | Exigir autenticação
    |--------------------------------------------------------------------------
    */
    public static function exigirLogin(): void
    {
        if (self::autenticado()) {
            return;
        }

        $base = defined('BASE_URL')
            ? rtrim((string) BASE_URL, '/')
            : '';

        header(
            'Location: '
            . $base
            . '/loginadmin'
        );

        exit;
    }

    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */
    public static function sair(): void
    {
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {

            $parametros =
                session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                [
                    'expires' => time() - 42000,
                    'path' => $parametros['path'],
                    'domain' => $parametros['domain'],
                    'secure' => $parametros['secure'],
                    'httponly' => $parametros['httponly'],
                    'samesite' =>
                        $parametros['samesite']
                        ?? 'Lax',
                ]
            );
        }

        if (
            session_status()
            === PHP_SESSION_ACTIVE
        ) {
            session_destroy();
        }
    }
}
