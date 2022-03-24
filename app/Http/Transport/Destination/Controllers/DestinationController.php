<?php

namespace App\Http\Transport\Destination\Controllers;

use App\Domain\Client\Workplace;
use App\Domain\Transport\Destination\Destination;
use App\Http\Transport\Destination\Requests\DestinationRequest;
use Illuminate\Http\Request;
use App\App\Controllers\Controller;

class DestinationController extends Controller
{
    public function index()
    {
        return view('transport.destination.index');
    }

    public function create()
    {
        $workplaces = Workplace::get();
        return view('transport.destination.create', compact('workplaces'));
    }

    public function store(DestinationRequest $request)
    {
        if (Destination::create($request->all())) {
            return $this->getResponse('success.store');
        } else {
            return $this->getResponse('error.store');
        }
    }

    public function edit($id)
    {
        $destination = Destination::findOrFail($id);
        $workplaces = Workplace::get();
        return view('transport.destination.edit', compact('workplaces','destination'));
    }

    public function update(DestinationRequest $request, $id)
    {
        $destination = Destination::findOrFail($id);
        if ($destination->update($request->all())) {
            return $this->getResponse('success.update');
        } else {
            return $this->getResponse('error.update');
        }
    }


    public function destroy($id)
    {
        $destination = Destination::findOrFail($id);
        if($destination->delete()) {
            return $this->getResponse('success.destroy');
        } else {
            return $this->getResponse('error.destroy');
        }
    }
}
