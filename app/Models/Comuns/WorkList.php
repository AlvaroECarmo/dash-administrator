<?php

namespace App\Models\Comuns;

use Adldap\Laravel\Traits\HasLdapUser;
use App\Models\External\AD\AD;
use App\Models\External\IDONIC\Pessoa;
use App\Models\Traits\DataBetween;
use App\Models\Traits\HasCompositePrimaryKey;
use App\Models\Traits\Perfis\ApplicationUser;
use App\Models\Traits\Perfis\AssembleiaUser;
use App\Models\Traits\Search;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use Spatie\Permission\Traits\HasRoles;

class WorkList extends Model
{
    use HasFactory, Notifiable;
    use HasRoles;
    use HasLdapUser;
    use Authenticatable;
    use Impersonate;
    use ApplicationUser, AssembleiaUser;
    use HasCompositePrimaryKey;
    use Search;
    use DataBetween;

    protected $connection = 'ConnectionName';
    protected $table = 'SchemaName.WorkList';

    protected $fillable = ['justificacaofalta_id', 'isManager', 'isDrh', 'nomeFuncionario',
        'idFuncionario', 'nomeManager', 'idManager', 'isNotManager'];
    protected $primaryKey = 'id';

    protected $searchable = ['nomeFuncionario'];
    protected $dateSeach = ['created_at'];

    /*public function saveNewWork($justificacao, bool $isManager, bool $isDrh, $managerObj = null): bool
    {
        $this->justificacaofalta_id = $justificacao['id'];
        $this->nomeFuncionario = $justificacao['pessoaNome'];
        $this->idFuncionario = $justificacao['pessoa_id'];

        $managerObj = $this->findManager();

        if ($managerObj) {
            $this->isNotManager = false;
            $this->nomeManager = $managerObj['Nome'];
            $this->idManager = $managerObj['ID'];
            $this->isManager = $isManager;
            $this->isDrh = $isDrh;
        } else {
            $this->isNotManager = true;
            $this->nomeManager = null;
            $this->idManager = null;
            $this->isDrh = true;
            $this->isManager = false;
        }

        if (\Auth::user()->isManager()) {
            $this->isManager = true;
            $this->isDrh = true;
        }

        return $this->save();
    }*/

    private function findManager()
    {


        try {
            if (\Auth::user()->isManager())
                return Pessoa::whereEmail(\Auth::user()->ldap->getEmail())->first();

            $inforAD = AD::getManager(\Auth::user()->ldap->getManager());
            $managerData = Pessoa::whereEmail($inforAD['Email'])->first();

            return $managerData;
        } catch (\Exception $e) {
            return null;
        }

    }
}
