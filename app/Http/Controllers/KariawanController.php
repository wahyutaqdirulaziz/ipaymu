<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use App\Models\Kariawan;
use Datatables;
use DB;
use Carbon;

class KariawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kariawan/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kariawan/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $input = $request->all();
        DB::beginTransaction();
        try {
            $uuid = Uuid::uuid1();
            $input['id'] = $uuid;
            // dd($uuid);
            Kariawan::create($input);
            DB::commit();
            return redirect(route('kariawan.index'))->with('success', 'Kariawan berhasil ditambahkan');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi Kesalan Silahkan Coba Lagi Nanti');
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
        $karyawan = Kariawan::find($id);
        return view('kariawan/edit',compact('karyawan'));
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
        $input = $request->all();
        $kariawan = kariawan::find($id);
        DB::beginTransaction();
        try {
            $uuid = Uuid::uuid1();
            $update['name'] = $input['name'];
            $update['pekerjaan'] = $input['pekerjaan'];
            $kariawan->update($update);
            DB::commit();
            return redirect(route('home'))->with('success', 'Kariawan berhasil di update');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi Kesalan Silahkan Coba Lagi Nanti');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $karyawan = Kariawan::where('id',$id)->firstOrFail();
        $karyawan->delete();
        return redirect()->route('home')
                        ->with('success','Karyawan deleted successfully');
    }



    public function datakariawan(Request $request)
    {
        if(request()->ajax()) {
            $data = Kariawan::select('id','name','pekerjaan','created_at')->get();
            return Datatables()->of($data)
            ->addColumn('tanggal',function($row){
                $dt = \Carbon\Carbon::parse($row->created_at)->isoFormat('dddd');
                $dat = \Carbon\Carbon::parse($row->created_at)->format('d');
                $tanggal_minggu = ($dt == "Sunday") ? "hari Minggu" : "";
                $tanggal_biasa = ($dat % 2 == 0) ? "Genap" : "Ganjil";
                return \Carbon\Carbon::parse($row->created_at)->format('d M Y') .'<span class="badge badge-secondary">'.$tanggal_biasa ." " .$tanggal_minggu.'</span>';

            }) 
            ->addColumn('action',function($row){
                $btn = '<div class="btn-group" role="group" aria-label="Basic example">
                <a href="' . route("kariawan.edit", $row->id) . '" class="edit btn btn-info btn-sm">edit</a>
              
                <form action="' . route("kariawan.destroy", $row->id) . '" class="form-process-order form-process-hapus-' . $row->id . '" method="POST">
                '.csrf_field().'
                '.method_field('DELETE').'
                <button type="submit" class="btn btn-success btn-sm process" data-process="process" data-hapus="'.$row->id.'">delete</button>
            </form>
                </div>';
                 return $btn;
            })
            ->rawColumns(['action','tanggal'])
            ->addIndexColumn()
            ->make(true);
        }
    }
}
