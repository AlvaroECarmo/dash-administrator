<?php

namespace App\Models\Traits\Perfis;
use App\Models\External\PRIMAVERA\Funcionario;

/**
 * Trait AssembleiaUser
 * @package App\Models\Traits\Perfis
 *
 * Este contrato deve ser incluído em todas as aplicações da Assembleia(no modelo User).
 */
trait AssembleiaUser
{

    /**
     * Verifica se o utilizador é Agente da Assembleia Nacional.
     * @return bool
     */
    protected function scopeIsAgenteAssembleia() {
        try {

            $funcionario = Funcionario::funcionarioPorEmail( $this->ldap->getEmail() );

            if ($funcionario)
                return $funcionario->isAgente();
            else
                return false;
        } catch (\Exception $e)
        {
            return false;
        }
    }

    protected function scopeIsDeputado() {
        try {

            $funcionario = Funcionario::funcionarioPorEmail( $this->ldap->getEmail() );

            if ($funcionario)
                return $funcionario->isDeputado();
            else
                return false;
        } catch (\Exception $e)
        {
            return false;
        }
    }

}
