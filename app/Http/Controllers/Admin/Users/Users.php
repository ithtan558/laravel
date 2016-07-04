<?php

namespace App\Http\Controllers\admin\Users;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\AdminUsers;
use App\AdminRoles;
use App\Http\Requests\Admin\Users\AdminUsersRequest;
use Elasticsearch;

class Users extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->has('search')){
            $page = $request->input('page', 1);
            $paginate = 2;

            $listUsers = AdminUsers::searchByQuery(['match' => ['email' => $request->input('search')], 'match' => ['name' => $request->input('search')]], null, null, $paginate, $page);
            $offSet = ($page * $paginate) - $paginate;
            $itemsForCurrentPage = $listUsers->toArray();
            $listUsers = new \Illuminate\Pagination\LengthAwarePaginator($itemsForCurrentPage, $listUsers->totalHits(), $paginate, $page);

            $listUsers->setPath('list');
            return view('admin.users.testsearch', compact('listUsers'));

        }
        if (trim($request->search) != '') {
            $listUsers = AdminUsers::where('email', 'like', '%'.$request->search.'%')->paginate(env('LIMIT_PAGINATION'))->appends(['search' => $request->search]);
        } else {
            $listUsers = AdminUsers::paginate(env('LIMIT_PAGINATION'));
        }
        $dataPassToView['listUsers'] = $listUsers;
        return view('admin.users.users', $dataPassToView);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listRoles = AdminRoles::all();
        $dataPassToView['listRoles'] = $listRoles;
        return view('admin.users.addUser', $dataPassToView);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUsersRequest $request)
    {
        $dataInsert = array(
            'role_id' => $request->input('role_id'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        );
        if ($user = AdminUsers::create($dataInsert)) {
            $request->session()->flash('success', trans('admin/users/users.create_success'));
            $user->addToIndex();
            return redirect()->route('add_user');
        } else {
            $request->session()->flash('error', trans('admin/users/users.create_fault'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
