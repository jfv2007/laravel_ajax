<?php

namespace App\Http\Controllers;

use App\Models\Tag18;
use Illuminate\Http\Request;

class Tag18Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tag18.index');   //devuelve  la vista
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       /*  $file = $request->file('avatar');
		$fileName = time() . '.' . $file->getClientOriginalExtension();
		$file->storeAs('public/images', $fileName); */

		$empData = ['tag' => $request->tag,
        'descripcion' => $request->descripcion
        ];

        Tag18::create($empData);
		return response()->json([
			'status' => 200
		]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function fetchAll() {
        $emps = Tag18::all();
        $output = '';
        if ($emps->count() > 0) {
            $output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>Tag</th>
                <th>Descripcion</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $emp->id . '</td>
                <td>' . $emp->tag .  '</td>
                <td>' . $emp->descripcion . '</td>
                <td>
                  <a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editEmployeeModal"><i class="bi-pencil-square h4"></i></a>

                  <a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

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
    public function edit(Request $request, Tag18 $tag18 )
    {
        $id = $request->id;
        $emp = Tag18::find($id);
        return response()->json($emp);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {

		 $emp = Tag18::find($request->emp_id);


		$empData = [
            'tag' => $request->tag,
            'descripcion' => $request->descripcion
        ];

		$emp->update($empData);
		return response()->json([
			'status' => 200,
		]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $id = $request->id;
        Tag18::destroy($id);
    }
}
