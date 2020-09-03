<?php


namespace App\Helpers\SIRIN;

use App\Http\Requests\RequestInterface;

class RequestHelper
{
    private $reg_del;
    private $status;
    private $user_mod;

    function __construct($reg_del, $user_mod, $status)
	{
		$this->reg_del = $reg_del;
		$this->user_mod = $user_mod;
		$this->status = $status;
    }

    public function addAuditFields(RequestInterface $req)
    {
        $req->merge([
            'reg_del' => $this->reg_del,
            'status' => $this->status,
            'user_mod' => $this->user_mod,
        ]);
    }

}
