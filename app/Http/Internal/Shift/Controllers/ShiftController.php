<?php

namespace App\Http\Internal\Shift\Controllers;


use App\App\Controllers\Controller;
use App\Domain\Internal\Shift\Shift;
use App\Http\Internal\Shift\Requests\ShiftRequest;

class ShiftController extends Controller
{

    public function index()
    {
        return view('internal.shift.index');
    }

    public function create()
    {
        return view('internal.shift.create');
    }

    public function store(ShiftRequest $request)
    {
        if (Shift::create($request->all())) {
            return $this->getResponse('success.store');
        } else {
            return $this->getResponse('error.store');
        }
    }

    public function edit($id)
    {
        $shift = Shift::findOrFail($id);
        return view('internal.shift.edit', compact('shift'));
    }

    public function update(ShiftRequest $request, $id)
    {
        $shift = Shift::findOrFail($id);
        if ($shift->update($request->all())) {
            return $this->getResponse('success.update');
        } else {
            return $this->getResponse('error.update');
        }
    }


    public function destroy($id)
    {
        $shift = Shift::findOrFail($id);
        if($shift->delete()) {
            return $this->getResponse('success.destroy');
        } else {
            return $this->getResponse('error.destroy');
        }
    }
}
