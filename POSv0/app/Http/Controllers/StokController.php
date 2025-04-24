<?php

namespace App\Http\Controllers;

use App\Models\StokModel;
use App\Models\BarangModel;
use App\Models\UserModel;
use App\Models\SupplierModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Yajra\DataTables\Facades\DataTables;

class StokController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Stok Pengeluaran Pembelanjaan',
            'list' => ['Home', 'Stok Pembelanjaan']
        ];

        $page = (object)[
            'title' => 'Daftar stok produk yang terdaftar dalam sistem'
        ];

        $activeMenu = 'stok';

        return view('stok.index', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function list(Request $request)
    {
        $stok = StokModel::with(['user', 'supplier'])->select('t_stok.*');

        if ($request->tahun) {
            $stok->whereYear('stok_tanggal', $request->tahun);
        }

        if ($request->bulan) {
            $stok->whereMonth('stok_tanggal', $request->bulan);
        }

        return DataTables::of($stok)
            ->addIndexColumn()
            ->addColumn('user_nama', function ($stok) {
                return $stok->user->nama ?? '-';
            })
            ->addColumn('supplier_nama', function ($stok) {
                return $stok->supplier->supplier_nama ?? '-';
            })
            ->addColumn('aksi', function ($stok) {
                return '
                    <button onclick="modalAction(\'' . url('/stok/' . $stok->stok_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button>
                    <button onclick="modalAction(\'' . url('/stok/' . $stok->stok_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create_ajax()
    {
        $supplier = SupplierModel::all();

        return view('stok.create_ajax', compact('supplier'));
    }

    public function store_ajax_single(Request $request)
    {
        $request->merge(['user_id' => auth()->user()->user_id]);

        if ($request->ajax()) {
            $rules = [
                'barang_id' => 'required|exists:m_barang,barang_id',
                'user_id' => 'required|exists:m_user,user_id',
                'stok_tanggal' => 'required|date',
                'stok_jumlah' => 'required|integer',
                'supplier_id' => 'required|exists:m_supplier,supplier_id',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'msgField' => $validator->errors()
                ]);
            }

            $barang = BarangModel::find($request->barang_id);
            $barang->update([
                'stok' => $barang->stok + $request->stok_jumlah
            ]);

            StokModel::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data stok berhasil disimpan'
            ]);
        }
        return redirect('/');
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax()) {

            $user_id = auth()->user()->user_id;
            $items = $request->item;
            $jumlahs = $request->stok_jumlah;
            $tanggal = $request->stok_tanggal;
            $suppliers = $request->supplier_id;
            $hargas = $request->harga_total;
            $keterangans = $request->keterangan;

            $errors = [];

            foreach ($items as $i => $item) {
                $data = [
                    'item' => $item,
                    'stok_jumlah' => $jumlahs[$i],
                    'stok_tanggal' => $tanggal.date(' H:i:s'),
                    'supplier_id' => $suppliers[$i],
                    'harga_total' => $hargas[$i] ?? '',
                    'keterangan' => $keterangans[$i] ?? '',
                    'user_id' => $user_id
                ];

                $validator = Validator::make($data, [
                    'item' => 'required|string',
                    'stok_jumlah' => 'required|integer|min:1',
                    'harga_total' => 'required|integer',
                    'stok_tanggal' => 'required|date',
                    'supplier_id' => 'required|exists:m_supplier,supplier_id',
                    'user_id' => 'required|exists:m_user,user_id',
                    'keterangan' => 'nullable|string',
                ]);

                if ($validator->fails()) {
                    $errors[$i] = $validator->errors();
                    continue;
                }

                StokModel::create($data);
            }

            if (!empty($errors)) {
                return response()->json([
                    'status' => false,
                    'msgField' => $errors,
                    'message' => 'Beberapa data gagal divalidasi'
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => 'Semua data stok berhasil disimpan'
            ]);
        }

        return redirect('/');
    }

    public function edit_ajax(string $id)
    {
        $stok = StokModel::find($id);
        $supplier = SupplierModel::all();

        return view('stok.edit_ajax', compact('stok', 'supplier'));
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax()) {
            $rules = [
                'item' => 'required|string',
                'stok_jumlah' => 'required|integer|min:1',
                'harga_total' => 'required|integer',
                'supplier_id' => 'required|exists:m_supplier,supplier_id',
                'keterangan' => 'nullable|string',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'msgField' => $validator->errors()
                ]);
            }

            $stok = StokModel::find($id);
            if ($stok) {
                $stok->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data stok berhasil diperbarui'
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        return redirect('/');
    }

    public function confirm_ajax(string $id)
    {
        $stok = StokModel::find($id);
        return view('stok.confirm_ajax', compact('stok'));
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax()) {

            $stok = StokModel::find($id);
            if ($stok) {

                $stok->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data stok berhasil dihapus'
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        return redirect('/');
    }

    public function import()
    {
        return view('stok.import');
    }

    public function import_ajax(Request $request)
    {
        if ($request->ajax()) {
            $rules = [
                'file_stok' => ['required', 'mimes:xlsx', 'max:1024']
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'msgField' => $validator->errors()
                ]);
            }

            $file = $request->file('file_stok');
            $reader = IOFactory::createReader('Xlsx');
            $reader->setReadDataOnly(true);
            $spreadsheet = $reader->load($file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray(null, false, true, true);

            $insert = [];
            foreach ($data as $index => $row) {
                if ($index > 1) {
                    $insert[] = [
                        'item' => $row['A'],
                        'user_id' => $row['B'],
                        'stok_tanggal' => $row['C'],
                        'stok_jumlah' => $row['D'],
                        'supplier_id' => $row['E'],
                        'created_at' => now()
                    ];
                }
            }

            if (!empty($insert)) {
                StokModel::insertOrIgnore($insert);
                return response()->json([
                    'status' => true,
                    'message' => 'Data stok berhasil diimport'
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Data kosong'
            ]);
        }

        return redirect('/');
    }

    public function export_excel()
    {
        $stok = StokModel::with(['user', 'supplier'])->get();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Item');
        $sheet->setCellValue('C1', 'User');
        $sheet->setCellValue('D1', 'Tanggal');
        $sheet->setCellValue('E1', 'Jumlah');
        $sheet->setCellValue('F1', 'Supplier');

        $row = 2;
        foreach ($stok as $index => $s) {
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $s->item ?? '');
            $sheet->setCellValue('C' . $row, $s->user->name ?? '');
            $sheet->setCellValue('D' . $row, $s->stok_tanggal);
            $sheet->setCellValue('E' . $row, $s->stok_jumlah);
            $sheet->setCellValue('F' . $row, $s->supplier->supplier_nama ?? '');
            $row++;
        }

        foreach (range('A', 'F') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data_Stok_' . now()->format('Y-m-d_His') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    public function export_pdf()
    {
        $stok = StokModel::with(['user', 'supplier'])->get();

        $pdf = Pdf::loadView('stok.export_pdf', compact('stok'));
        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream('Data_Stok_' . now()->format('Y-m-d_His') . '.pdf');
    }
}
