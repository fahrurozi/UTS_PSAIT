<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\mahasiswa;
use App\matakulliah;
use App\perkuliahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class SaitController extends Controller
{
    public function index()
    {
        $model = DB::select("select mahasiswa.nim as nim, mahasiswa.nama as nama, mahasiswa.alamat as alamat, mahasiswa.tanggal_lahir as tanggal_lahir, matakuliah.kode_mk as kode_mk, matakuliah.nama_mk as nama_mk, matakuliah.sks as sks, perkuliahan.nilai as nilai from perkuliahan inner join mahasiswa on mahasiswa.nim = perkuliahan.nim inner join matakuliah ON perkuliahan.kode_mk = matakuliah.kode_mk;");
        return $this->output(200, 'retrieved successfully', $model);
    }

    public function show($nim)
    {
        $model = DB::select("select mahasiswa.nim as nim, mahasiswa.nama as nama, mahasiswa.alamat as alamat, mahasiswa.tanggal_lahir as tanggal_lahir, matakuliah.kode_mk as kode_mk, matakuliah.nama_mk as nama_mk, matakuliah.sks as sks, perkuliahan.nilai as nilai from perkuliahan inner join mahasiswa on mahasiswa.nim = perkuliahan.nim inner join matakuliah ON perkuliahan.kode_mk = matakuliah.kode_mk where mahasiswa.nim = '$nim';");
        return $this->output(200, 'retrieved successfully', $model);
    }

    public function create_join(Request $request)
    {
        DB::beginTransaction();
        try {
            $mahasiswa = new mahasiswa();
            $mahasiswa->nim = $request->nim;
            $mahasiswa->nama = $request->nama;
            $mahasiswa->alamat = $request->alamat;
            $mahasiswa->tanggal_lahir = $request->tanggal_lahir;
            $mahasiswa->save();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
        }
        try {
            $matakuliah = new matakulliah();
            $matakuliah->kode_mk = $request->kode_mk;
            $matakuliah->nama_mk = $request->nama_mk;
            $matakuliah->sks = $request->sks;
            $matakuliah->save();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
        }
        try {
            $perkuliahan = new perkuliahan();
            $perkuliahan->nim = $mahasiswa->nim;
            $perkuliahan->kode_mk = $matakuliah->kode_mk;
            $perkuliahan->nilai = $request->nilai;
            $perkuliahan->save();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
        }
        DB::commit();
        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'success',
            'mahasiswa' => $mahasiswa,
            'matakuliah' => $matakuliah,
            'perkuliahan' => $perkuliahan
        ], Response::HTTP_CREATED);
    }

    public function update_join(Request $request)
    {
        
        $perkuliahan = perkuliahan::where('nim', $request->nim)->where('kode_mk', $request->kode_mk)->first();
        
        
        $perkuliahan->nilai = $request->nilai;
        $perkuliahan->update();

        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'success',
            'perkuliahan' => $perkuliahan,
        ], Response::HTTP_CREATED);
    }   

    public function matakuliah()
    {
        $model = matakulliah::all();
        return $this->output(200, 'retrieved successfully', $model);
    }

    public function destroy(Request $request){
        $perkuliahan = perkuliahan::where('nim', $request->nim)->where('kode_mk', $request->kode_mk)->first();
        $perkuliahan->delete();
        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'success',
            'perkuliahan' => $perkuliahan,
        ], Response::HTTP_CREATED);
    }

    public function output($code, $message, $data = null)
    {
        if ($code == 200 || $code == 201) {
            $result = [
                'code' => $code,
                'status' => 'success',
                'message' => $message,
                'data' => $data,
            ];
        } else if ($code == 401 || $code == 404) {
            $result = [
                'code' => $code,
                'status' => 'fail',
                'message' => $message,
            ];
        } else if ($code == 422) {
            $result = [
                'code' => $code,
                'status' => 'error',
                'message' => $message,
            ];
        }

        return response($result);
    }
}
