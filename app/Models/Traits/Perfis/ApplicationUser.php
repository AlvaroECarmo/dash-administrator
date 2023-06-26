<?php

namespace App\Models\Traits\Perfis;

use Adldap\Laravel\Facades\Adldap;
use App\Models\External\AD\AD;

/**
 * Trait ApplicationUser
 * @package App\Models\Traits\Perfis
 *
 * Este contrato deve ser incluído em todas as aplicações (no modelo User).
 */
trait ApplicationUser
{

    /**
     * Verifica se o utilizador é Administrador da aplicação.
     * @return bool
     */
    protected function scopeIsAdmin()
    {
        // Se está a utilizar LDAP como meio de autenticação
        if (config('cian.utilizaldap')) {
            AD::init();
            if (AD::membroDe($this->name, config('cian.nomeGrupoAdmins')))
                return true;
            else
                return false;
        } else // Se não esta a utilizar LDAP , verifica na tabela Roles
        {
            return $this->hasRole('Administrador');
        }

    }

    /**
     * @return bool
     */
    protected function scopeIsSuperAdmin()
    {
        $superAdmins = explode(',', config('cian.superAdmins'));
        if (in_array($this->email, $superAdmins))
            return true;
        else
            return false;
    }
}
