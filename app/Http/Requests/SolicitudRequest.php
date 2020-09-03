<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Helpers\SIRIN\RequestHelper;

class SolicitudRequest extends FormRequest implements RequestInterface
{
    public function authorize()
    {
        return true;
    }
    public function rules(){
        return [
            'descripcion' => 'required',
            'id_user' => 'required',
            'estado' => 'required',
            'id_categoria' => 'required',
            'codigo' => 'required',
            'reg_del' => 'required',
            'status' => 'required',
            'user_mod' => 'required',
        ];
    }
    protected function prepareForValidation(){
        $this->getCodeSolicitud();
        $this->addAuditFields();
    }
    private function getCodeSolicitud(){
        $codigo = 'SIRIN-'.date("dmYHis");
        $this->merge(['codigo' => $codigo,]);
    }
    public function addAuditFields()
    {
        $helper = new RequestHelper(0,'API',1);
        $helper->addAuditFields($this);
    }
}
