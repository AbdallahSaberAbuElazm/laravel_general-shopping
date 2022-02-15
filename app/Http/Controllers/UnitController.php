<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
use Illuminate\Support\Facades\Session;
use PDO;

use function PHPUnit\Framework\isNull;

class UnitController extends Controller
{



    public function showAdd()
    {
        $unit = Unit::find(1);
        return view('admin.units.add-edit-unit')->with(['unit' => $unit]);
    }

    public function index()
    {
        $units = Unit::paginate(env('PAGINATEION_COUNT'));
        return view('admin.units.units')->with([
            'units' => $units,
            'showLinks' => true,
        ]);
    }

    public function unitNameExists($unitName)
    {
        $unit = Unit::where(
            'unit_name',
            '=',
            $unitName
        )->first();
        if (!is_null($unit)) {
            return false;
        } else {
            return true;
        }
    }

    public function unitCodeExists($unitCode)
    {
        $unit = Unit::where(
            'unit_code',
            '=',
            $unitCode
        )->first();

        if (!is_null($unit)) {
            return false;
        } else {
            return true;
        }
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'unit_name' => 'required',
            'unit_code' => 'required',
        ]);
        if(!$validate){
            toastr()->warning('Unit name and code are required');
        }
        $checkUnitName =  $request->input('unit_name');
        $checkUnitCode =  $request->input('unit_code');
        if (!$this->unitNameExists($checkUnitName)) {
            toastr()->info('Unit name '.$checkUnitName.' already exists');
            return redirect()->back();
        }

        if (!$this->unitCodeExists($checkUnitCode)) {
            toastr()->info('Unit code '.$checkUnitCode.'  already exists');
            return redirect()->back();
        }

        $unit = new Unit();
        $unit->unit_name = $checkUnitName;
        $unit->unit_code = $checkUnitCode;
        $unit->save();

        toastr()->success('Unit '.$unit->unit_name.' , '.$unit->unit_code.' has been added');
        return redirect()->back();

    }

    public function delete(Request $request)
    {
        $validate = $request->validate([
            'unit_id' => 'required',
        ]);
        if (!$validate) {
            toastr()->warning('Unit id is required');
            return redirect()->back();
        }
        $unitId = intval($request->input('unit_id'));
        Unit::destroy($unitId);
        toastr()->success('Unit has been deleted');
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $validate = $request->validate([
            'edit_unit_id'   => 'required',
            'unit_name' => 'required',
            'unit_code' => 'required',
        ]);

        if (!$validate) {
            toastr()->warning('Unit name and code are required');
            return redirect()->back();
        }

        $unitName = $request->input('unit_name');
        $unit_code = $request->input('unit_code');

        if (!($this->unitNameExists($unitName) || $this->unitCodeExists($unit_code))) {
            toastr()->info('The unit already exists');
            return redirect()->back();
        }

        $unitId = intval($request->input('edit_unit_id'));
        $unit = Unit::find($unitId);
        $unit->unit_name = $unitName;
        $unit->unit_code = $unit_code;
        $unit->save();
        toastr()->success('Unit has been updated');
        return redirect()->back();
    }

    public function search(Request $request)
    {
        $validate = $request->validate([
            'unit_search' => 'required',
        ]);
        if (!$validate) {
            toastr()->warning('Please enter your search data unit name or code');
            return redirect()->back();
        }
        $searchUnit = $request->input("unit_search");
        $units = Unit::where(
            'unit_name',
            'LIKE',
            '%' . $searchUnit . '%'
        )->orWhere(
            'unit_code',
            'LIKE',
            '%' . $searchUnit . '%'
        )->get();

        if (count($units) > 0) {
            return view('admin.units.units')->with([
                'units' => $units,
                'showLinks'=>false,
            ]);
        }
        toastr()->warning('Nothing found!!!');
        return redirect()->route('units');
    }
}
