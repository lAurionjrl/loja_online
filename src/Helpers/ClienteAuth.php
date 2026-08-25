<?php

declare(strict_types=1);

namespace App\Helpers;

use PDO;

final class ClienteAuth
{
    public static function logado(): bool
    {
        return !empty($_SESSION['cliente']['id']);
    }

    public static function usuario(): ?array
    {
        if (!self::logado()) {
            return null;
        }

        return $_SESSION['cliente'];
    }

    public static function id(): ?int
    {
        if (!self::logado()) {
            return null;
        }

        return (int) $_SESSION['cliente']['id'];
    }

    public static function entrar(
        array $cliente
    ): void {

        session_regenerate_id(true);

        $_SESSION['cliente'] = [
            'id' => (int) $cliente['id'],
            'nome' => (string) $cliente['nome'],
            'email' => (string) $cliente['email'],
            'foto_url' => $cliente['foto_url'] ?? null,
        ];
    }

    public static function exigirLogin(): void
    {
        if (self::logado()) {
            return;
        }

        $_SESSION['cliente_destino'] = $_SERVER['REQUEST_URI'] ?? '';

        header('Location: ' . BASE_URL . '/cliente/login');

        exit;
    }

    public static function sair(): void
    {
        unset($_SESSION['cliente']);

        session_regenerate_id(true);
    }

    // =======================================================
    // MÉTODO NOVO ADICIONADO PARA O EXERCÍCIO ("1 ENDEREÇO"):
    // =======================================================
    public static function endereco(PDO $db): ?array
    {
        // Usa o próprio método id() da sua classe para pegar o cliente logado
        $clienteId = self::id();
        if (!$clienteId) {
            return null;
        }

        // 1. Tenta buscar o endereço marcado como 'principal'
        $sql = "SELECT * FROM enderecos WHERE cliente_id = :cliente_id AND principal = 1 LIMIT 1";
        $stmt = $db->prepare($sql);
        $stmt->execute([':cliente_id' => $clienteId]);

        $endereco = $stmt->fetch(PDO::FETCH_ASSOC);

        // 2. Se não houver endereço marcado como principal, pega o primeiro da lista
        if (!$endereco) {
            $sql = "SELECT * FROM enderecos WHERE cliente_id = :cliente_id ORDER BY id ASC LIMIT 1";
            $stmt = $db->prepare($sql);
            $stmt->execute([':cliente_id' => $clienteId]);
            $endereco = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return $endereco ?: null;
    }
}