<?php
namespace App\Modules\Accounts;

use App\Models\Account;
use App\Models\User;
use App\Common\Base64ToImage;
use App\Modules\Accounts\Resources\AccountResource;
use App\Modules\Accounts\Requests\StoreRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;
use File;
use Illuminate\Support\Facades\Auth;

class EditView
{

    public function addData(StoreRequest $request)
    {
    }

}