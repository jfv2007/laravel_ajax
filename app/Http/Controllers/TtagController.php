<?php

namespace App\Http\Controllers;

use App\Models\Ttags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TtagController extends Controller
{
    public function index(){
        return view('tags.index');   //devuelve  la vista
    }


// handle insert employee ajax request
//insert empleado ajax request
    public function store(Request $request){
        $file = $request->file('foto');
		$fileName = time() . '.' . $file->getClientOriginalExtension();
		$file->storeAs('public/images/planta', $fileName);

		$empData = ['tag' => $request->tag,
        'descripcion' => $request->descripcion,
        'operacion' => $request->operacion,
        'ubicacion' => $request->ubicacion,
        'ct' => $request->ct,
        'planta' => $request->planta,
        'area' => $request->area,
        'foto' => $fileName];

        Ttags::create($empData);
		return response()->json([
			'status' => 200
		]);
    }

    //handle fetch all employees ajax request

    // handle fetch all eamployees ajax request
	public function fetchAll() {
		$emps = Ttags::all();
		$output = '';
		if ($emps->count() > 0) {
			$output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>foto</th>
                <th>Tag</th>
                <th>Descripcion</th>
                <th>Operacion</th>
                <th>ubicacion</th>
                <th>CT</th>
                <th>Planta</th>
                <th>Area</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
			foreach ($emps as $emp) {
				$output .= '<tr>
                <td>' . $emp->id . '</td>
                <td><img src="storage/images/planta/' . $emp->foto . '" width="50" class="img-thumbnail rounded-circle"></td>
                <td>' . $emp->tag .  '</td>
                <td>' . $emp->descripcion . '</td>
                <td>' . $emp->operacion . '</td>
                <td>' . $emp->ubicacion . '</td>
                <td>' . $emp->ct . '</td>
                <td>' . $emp->planta . '</td>
                <td>' . $emp->area . '</td>
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

// handle edit an employee ajax request
public function edit(Request $request) {
    $id = $request->id;
    $emp = Ttags::find($id);
    return response()->json($emp);
}

	// handle update an employee ajax request
	public function update(Request $request) {
		$fileName = '';
		$emp = Ttags::find($request->emp_id);
		if ($request->hasFile('foto')) {
			$file = $request->file('foto');
			$fileName = time() . '.' . $file->getClientOriginalExtension();
			$file->storeAs('public/images/planta', $fileName);
			if ($emp->foto) {
				Storage::delete('public/images/planta/' . $emp->foto);
			}
		} else {
			$fileName = $request->emp_foto;
		}

		$empData = ['tag' => $request->tag,
                    'descripcion' => $request->descripcion,
                    'operacion' => $request->operacion,
                    'ubicacion' => $request->ubicacion,
                    'ct' => $request->ct,
                    'planta' => $request->planta,
                    'area' => $request->area,
                    'foto' => $fileName
                ];

		$emp->update($empData);
		return response()->json([
			'status' => 200,
		]);
	}

// handle delete an employee ajax request
public function delete(Request $request) {
    $id = $request->id;
    $emp = Ttags::find($id);
    if (Storage::delete('public/images/planta/' . $emp->foto)) {
        Ttags::destroy($id);
    }
}


}
