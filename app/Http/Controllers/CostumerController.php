<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CostumerController extends Controller
{
    public function index()
    {
        $costumers = Costumer::orderBy('name', 'asc')->paginate(10);
        return view('costumers.index', compact('costumers'));
    }

    public function create()
    {
        return view('costumers.create');
    }

    public function store(CostumerRequest $request)
    {
        Costumer::create([
            'name'      => $request->name,
            'owner'     => $request->owner,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'address'   => $request->address,
        ]);

        return redirect()
            ->route('costumers.index')
            ->with('success', 'Cliente cadastrado com sucesso!');
    }

    public function show(Costumer $costumer)
    {
        return view('costumers.show', compact('costumer'));
    }

    public function edit(Costumer $costumer)
    {
        return view('costumers.edit', compact('costumer'));
    }

    public function update(CostumerRequest $request, Costumer $costumer)
    {
        $data = [
            'name' => $request->name,
            'owner' => $request->owner,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];

        if ($request->filled('password')) {
            $data['password'] = $request->password;
        }

        $costumer->update($data);
        
        return redirect()
            ->route('costumers.index')
            ->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy(Costumer $costumer)
    {
        $costumer->delete();

        return redirect()
            ->route('costumers.index')
            ->with('success', 'Cliente excluído com sucesso!');
    }
}
