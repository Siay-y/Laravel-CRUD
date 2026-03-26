<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public readonly User $user;
    public function __construct()
    {
        $this->user = new User();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->user->all();
        return view('users', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $created = $this->user->create([
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'password' => password_hash($request->input('password'), PASSWORD_DEFAULT),
            'email' => $request->input('email'),
        ]);

        if ($created)
            return redirect()->back()->with('message', 'Usuário criado com sucesso!');
        return redirect()->back()->with('message', 'Erro ao criar usuário!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('user_show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user_edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updated = $this->user->where('id', $id)->update($request->except(['_token', '_method']));

        if ($updated)
            return redirect()->back()->with('message', 'Informações do usuário alteradas com sucesso!');
        return redirect()->back()->with('message', 'Erro ao alterar informações do usuário!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = $this->user->where('id', $id)->delete();

        return redirect()->route('users.index');
    }
}
