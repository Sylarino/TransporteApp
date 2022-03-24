<?php

namespace App\Http\Client\Workplace\Controllers;

use App\Domain\Client\Workplace;
use App\Http\Client\Workplace\Requests\WorkplaceRequest;
use Illuminate\Http\Request;
use App\App\Controllers\Controller;

class WorkplaceController extends Controller
{

    public function index()
    {
        return view('client.workplace.index');
    }

    public function create()
    {
        return view('client.workplace.create');
    }

    public function store(WorkplaceRequest $request)
    {
        if (Workplace::create($request->all())) {
            return $this->getResponse('success.store');
        } else {
            return $this->getResponse('error.store');
        }
    }

    public function edit($id)
    {
        $workplace = Workplace::findOrFail($id);
        return view('client.workplace.edit', compact('workplace'));
    }

    public function update(WorkplaceRequest $request, $id)
    {
        $workplace = Workplace::findOrFail($id);
        if ($workplace->update($request->all())) {
            return $this->getResponse('success.update');
        } else {
            return $this->getResponse('error.update');
        }
    }


    public function destroy($id)
    {
        $workplace = Workplace::findOrFail($id);
        if($workplace->delete()) {
            return $this->getResponse('success.destroy');
        } else {
            return $this->getResponse('error.destroy');
        }
    }
}
