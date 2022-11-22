<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
// use Barryvdh\DomPDF\Facade\Pdf;


class EmployeeController extends Controller
{
    public function index(){
        $employee = Employee::all();
        return view('web.pages.employee.index',['employee'=>$employee]);
    }

    public function createEmployee(){
        return view('web.pages.employee.create');
    }

    public function storeEmployee(Request $request){
        $validated = $request->validate([
            'employee_name' => 'required|max:255',
            'email' => 'required|unique:employees,email|email',
            'phone' => 'required|regex:/(01)[0-9]{9}/',
            'photo' => 'required|image|mimes:jpg,bmp,png',
            'address' => 'required',
            'gender' => 'required',
        ]);

        $employee = new Employee();
        $employee->employee_name = $request->employee_name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->gender = $request->gender;

        if ($request->file('photo'))
        {
            $originalImage      = $request->file('photo');
            $imageName          = $this->uploadImage($originalImage);
            $employee->photo = $imageName;
        }
        $employee->save();
        return redirect()->to('create-employee')->with('success','Employee has been successfully added');


    }

    private function uploadImage($originalImage)
    {
        $image           = $originalImage;
        $name            = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/uploads/employee');
        $file_path       = 'uploads/employee/'.$name;
        $image->move($destinationPath, $name);
        return $file_path;
    }

    public function deleteEmployee($id){
        $employee = Employee::find($id);
        $employee->delete();
        return back()->with('success','Employee has been successfully deleted');
    }

    public function editEmployee($id){
        $employee = Employee::find($id);
        return view('web.pages.employee.edit',['employee'=>$employee]);
    }

    public function updateEmployee(Request $request,$id){
        $employee = Employee::find($id);
        if($request->hasFile('photo')){
            $originalImage      = $request->file('photo');
            $imageName          = $this->uploadImage($originalImage);
            unlink($employee->photo);
            $employee->photo = $imageName;
        }
        $employee->employee_name = $request->employee_name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->gender = $request->gender;
        $employee->save();
        return redirect()->to('dashboard')->with('success','Employee has been successfully updated');

    }

    public function allEmployeeGet(){
        $employee = Employee::all();
        return response()->json([
            'employee' => $employee,
        ]);
    }

    public function downloadPdfById($id){
        $employee = Employee::find($id);
        // $pdf = PDF::loadView('web.pages.employee.pdf',compact('employee'));
        // return $pdf->download('employee.pdf');
    }

}
