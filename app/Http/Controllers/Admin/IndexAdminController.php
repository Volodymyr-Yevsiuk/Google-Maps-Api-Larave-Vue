<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Repositories\MarkerRepository;
use App\Http\Requests\MarkerRequest;
use App\Http\Controllers\Controller;

use App\Models\Marker;

class IndexAdminController extends Controller
{

    protected $m_rep;

    public function __construct(MarkerRepository $m_rep) {

        $this->m_rep = $m_rep;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::denies('VIEW_PERSONAL_MARKERS')) {
            return redirect('/login');
        }

        return view(config('settings.theme').'.layouts.admin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MarkerRequest $request)
    {
        if(Gate::denies('CREATE_MARKERS')) {
            return redirect ('/login');
        }

        $this->m_rep->addMarker($request);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
    public function update(MarkerRequest $request, $id)
    {
        if(Gate::denies('UPDATE_MARKER')) {
            return redirect ('/login');
        }
        
        $marker = Marker::find($id);

        $this->m_rep->updateMarker($request, $marker);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('DELETE_MARKER')) {
            return redirect ('/login');
        }

        $marker = Marker::find($id);

        $this->m_rep->deleteMarker($marker);

    }
}
