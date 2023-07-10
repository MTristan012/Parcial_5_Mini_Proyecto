<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Inscription;
use Illuminate\Http\Request;

class InscriptionController extends Controller
{
    public function index()
    {
        $inscriptions = Inscription::all();

        return view('admin/adminClasses', ["inscriptions" => $inscriptions]);
    }
    public function create(Request $request){
        //dd($request->all());
        if($request->selectAlumnoInscribir != NULL){
            $classInfo = explode(",", $request->selectAlumnoInscribir);
            $classId = $classInfo[0];
            $class = $classInfo[1];
            $inscription = new Inscription();
            $inscription->classID = $classId;
            $inscription->class = $class;
            $inscription->studentID = $request->studentID;
            $inscription->student = $request->student;

            if (
                $inscription->classID !== null && $inscription->classID !== '' &&
                $inscription->class !== null && $inscription->class !== '' &&
                $inscription->studentID !== null && $inscription->studentID !== '' &&
                $inscription->student !== null && $inscription->student !== ''
            ) {
                try {
                    $inscription->save();
                    return back()->with("Correct", "Enroll Complete");
                } catch (\Throwable $th) {
                    //dd($th);
                    return back()->with("Incorrect", "Error");
                }
            } else {
                return back()->with("Incorrect", "Please Select a Class");
            }
        }
    }
    public function delete(Request $request){
        //dd($request->all());
        $inscriptionId = $request->input('inscriptionID');

        $inscription = Inscription::find($inscriptionId);
        if ($inscription) {
            $inscription->delete();
            return back()->with("success", "Inscription drop out successfully");
        } else {
            return back()->with("error", "Inscription not found");
        }
    }
}
