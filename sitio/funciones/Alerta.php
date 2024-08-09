<?php

class Alerta {
    public function add_alerta($mensaje, $tipo = 'success') {
        $_SESSION['alertas'][] = ['mensaje' => $mensaje, 'tipo' => $tipo];
    }

    public function get_alertas() {
        $alertas = isset($_SESSION['alertas']) ? $_SESSION['alertas'] : [];
        if (!empty($alertas)) {
            foreach ($alertas as $alerta) {
                echo "<div class='alert alert-{$alerta['tipo']}' role='alert'>{$alerta['mensaje']}</div>";
            }
            $_SESSION['alertas'] = [];
        }
    }
}
