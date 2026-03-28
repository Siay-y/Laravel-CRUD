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

    private function isApiRequest(Request $request): bool
    {
        return $request->expectsJson() || 
               $request->ajax() || 
               str_contains($request->header('referer') ?? '', '/docs');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $users = $this->user->orderBy('id', 'desc')->paginate($perPage)->appends(['per_page' => $perPage]);

        if ($this->isApiRequest($request)) {
            return response()->json($users);
        }

        return view('users', ['users' => $users, 'perPage' => $perPage]);
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
        if (!$request->input('firstName') || !$request->input('lastName') || !$request->input('email') || !$request->input('password')) {
            if ($this->isApiRequest($request)) {
                return response()->json(['success' => false, 'message' => 'Preencha todos os campos!'], 400);
            }
            return redirect()->back()->with('message', 'Preencha todos os campos!')->with('type', 'error');
        }

        $created = $this->user->create([
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'password' => password_hash($request->input('password'), PASSWORD_DEFAULT),
            'email' => $request->input('email'),
        ]);

        if ($this->isApiRequest($request)) {
            if ($created) {
                return response()->json(['success' => true, 'message' => 'Usuário criado com sucesso!', 'data' => $created], 201);
            }
            return response()->json(['success' => false, 'message' => 'Erro ao criar usuário!'], 500);
        }

        if ($created)
            return redirect()->back()->with('message', 'Usuário criado com sucesso!')->with('type', 'success');
        return redirect()->back()->with('message', 'Erro ao criar usuário!')->with('type', 'error');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, User $user)
    {
        if ($this->isApiRequest($request)) {
            return response()->json($user);
        }

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
        if (!$request->input('firstName') || !$request->input('lastName') || !$request->input('email')) {
            if ($this->isApiRequest($request)) {
                return response()->json(['success' => false, 'message' => 'Preencha todos os campos!'], 400);
            }
            return redirect()->back()->with('message', 'Preencha todos os campos!')->with('type', 'error');
        }

        $updated = $this->user->where('id', $id)->update($request->except(['_token', '_method']));

        if ($this->isApiRequest($request)) {
            if ($updated) {
                $user = $this->user->find($id);
                return response()->json(['success' => true, 'message' => 'Informações do usuário alteradas com sucesso!', 'data' => $user]);
            }
            return response()->json(['success' => false, 'message' => 'Erro ao alterar informações do usuário!'], 500);
        }

        if ($updated)
            return redirect()->back()->with('message', 'Informações do usuário alteradas com sucesso!')->with('type', 'success');
        return redirect()->back()->with('message', 'Erro ao alterar informações do usuário!')->with('type', 'error');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        try {
            $deleted = $this->user->where('id', $id)->delete();

            if ($this->isApiRequest($request)) {
                if ($deleted) {
                    return response()->json(['success' => true, 'message' => 'Usuário removido com sucesso!']);
                }
                return response()->json(['success' => false, 'message' => 'Erro ao remover o usuário.'], 500);
            }

            return redirect()->route('users.index');
        } catch (\Exception $e) {
            if ($this->isApiRequest($request)) {
                return response()->json(['success' => false, 'message' => 'Erro ao remover o usuário: ' . $e->getMessage()], 500);
            }

            return redirect()->route('users.index');
        }
    }
}
