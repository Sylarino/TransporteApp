<?php

namespace App\Http\Internal\Mobile\Controllers;

use App\App\Controllers\Controller;
use App\Domain\Client\Workplace;
use App\Domain\Internal\Mobile\Mobile;
use App\Http\Internal\Mobile\Requests\MobileRequest;

class MobileController extends Controller
{
    public function index()
    {
        return view('internal.mobile.index');
    }

    public function create()
    {
        $workplaces = Workplace::get();
        return view('internal.mobile.create',compact('workplaces'));
    }

    public function store(MobileRequest $request)
    {
        if (Mobile::create($request->all())) {
            return $this->getResponse('success.store');
        } else {
            return $this->getResponse('error.store');
        }
    }

    public function edit($id)
    {
        $mobile = Mobile::findOrFail($id);
        $workplaces = Workplace::get();
        return view('internal.mobile.edit', compact('mobile','workplaces'));
    }

    public function update(MobileRequest $request, $id)
    {
        $mobile = Mobile::findOrFail($id);
        if ($mobile->update($request->all())) {
            return $this->getResponse('success.update');
        } else {
            return $this->getResponse('error.update');
        }
    }


    public function destroy($id)
    {
        $mobile = Mobile::findOrFail($id);
        if($mobile->delete()) {
            return $this->getResponse('success.destroy');
        } else {
            return $this->getResponse('error.destroy');
        }
    }
}
