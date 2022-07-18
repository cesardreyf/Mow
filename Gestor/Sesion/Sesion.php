<?php

namespace Mow\Gestor\Sesion;

use Mow\Interfaz\Sesion\Sesion as ISesion;

class Sesion implements ISesion
{
    public const SESION_LIBRE = PHP_SESSION_NONE;
    public const SESION_OCUPADA = PHP_SESSION_ACTIVE;
    public const SESION_DESHABILITADA = PHP_SESSION_DISABLED;

    public const ELIMINAR_COOKIES_AL_DESTRUIR = 1;

    private $opciones;
    private $config;

    public function __construct(array $opciones = [], int $config = 0)
    {
        $this->config($config);
        $this->opciones($opciones);
    }

    public function iniciar(): bool
    {
        // Si la sesión no están habilitadas
        // o si ya existe una sesión activa
        if( $this->estado() !== self::SESION_LIBRE ) {
            return false;
        }

        return session_start($this->opciones);
    }

    public function finalizar(): bool
    {
        // Si la sesión no están habilitadas
        // o si aún no se inició una sesión
        if( $this->estado() !== self::SESION_OCUPADA ) {
            return false;
        }

        // Finaliza la sesión actual y almacena la información
        session_write_close();

        // Limpia la variable superglobal
        $_SESSION = array();
        return true;
    }

    public function estado(): int
    {
        return session_status();
    }

    public function destruir(): bool
    {
        if( $this->estado() !== self::SESION_OCUPADA ) {
            return false;
        }

        if( $this->config & self::ELIMINAR_COOKIES_AL_DESTRUIR && ini_get('session.use_cookies') ) {
            $p = session_get_cookie_params();
            setcookie(session_name(), '', -1, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
        }

        $_SESSION = array();
        return session_destroy();
    }

    public function existe(string $clave): bool
    {
        return isset($_SESSION[$clave]);
    }

    public function obtener(string $clave)
    {
        return $_SESSION[$clave] ?? null;
    }

    public function definir(string $clave, $valor)
    {
        return $_SESSION[$clave] = $valor;
    }

    public function eliminar(string $clave)
    {
        $_SESSION[$clave] = null;
        unset($_SESSION[$clave]);
    }

    public function opciones(array $opciones): array
    {
        return $this->opciones = $opciones;
    }

    public function opcion(string $directiva, $valor)
    {
        return $this->opciones[$directiva] = $valor;
    }

    public function config(int $flags)
    {
        return $this->config = $flags;
    }

    public function nombre(string $nombre = 'PHPSESSID'): string
    {
        if( $this->estado() !== self::SESION_LIBRE ) return '';
        return session_name($nombre);
    }

}
