<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Datatables;
use Validator;
use Response;

class ScoringController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->menu         = trans('menu.scoring.name');
        $this->route        = $this->routes['backend'].'scoring';
        $this->slug         = $this->slugs['backend'].'scoring';
        $this->view         = $this->views['backend'].'scoring';
        $this->breadcrumb   = '<li><a href="'.route($this->route.'.index').'">'.$this->menu.'</a></li>';
        # share parameters
        $this->share();
        # init model
        $this->model        = new \App\Models\Scoring;
        $this->library      = new \App\Libraries\StaticLibrary;
    }

    public function index()
    {
        try {
            $breadcrumb = $this->breadcrumbs($this->breadcrumb.'<li class="active">'.trans('label.view').'</li>');
            return view($this->view.'.index', compact('breadcrumb'));
        } catch (\Exception $e) {
            abort(500);
        }
    }

    public function datatables()
    {
        try {
            $data = numrows($this->model->sql()->get());
            return Datatables::of($data)
                // ->addColumn('action', function ($data) {
                //     $action  = null;
                //     if (check_access('detail', $this->slug)) {
                //         $action .= '<a data-href="'.route($this->route.'.detail', encodeids($data->id)).'" class="btn btn-xs btn-success btn-modal-action" title="'.trans('label.detail').'" data-title="'.trans('form.detail', ['menu' => $this->menu]).'" data-icon="fa fa-search fa-fw" data-background="modal-primary">'.trans('icon.detail').'</a>';
                //     }
                //     if (check_access('update', $this->slug)) {
                //         $action .= '<a data-href="'.route($this->route.'.edit', encodeids($data->id)).'" class="btn btn-xs btn-primary btn-modal-form" title="'.trans('label.edit').'" data-title="'.trans('form.edit', ['menu' => $this->menu]).'" data-icon="fa fa-edit fa-fw" data-background="modal-primary">'.trans('icon.edit').'</a>';
                //     }
                //     if (check_access('delete', $this->slug)) {
                //         $action .= '<a data-href="'.route($this->route.'.delete', encodeids($data->id)).'" class="btn btn-xs btn-danger btn-modal-action" title="'.trans('label.delete').'" data-title="'.trans('form.delete', ['menu' => $this->menu]).'" data-icon="fa fa-trash-o fa-fw" data-background="modal-danger">'.trans('icon.delete').'</a>';
                //     }
                //     return $action;
                // })
                ->editColumn('penghasilan', function ($data) { return $this->library->getPenghasilan($data->penghasilan); })
                ->editColumn('pengeluaran', function ($data) { return $this->library->getPengeluaran($data->pengeluaran); })
                ->editColumn('pekerjaan', function ($data) { return $this->library->getPekerjaan($data->pekerjaan); })
                ->editColumn('status_kawin', function ($data) { return $this->library->getStatusKawin($data->status_kawin); })
                ->editColumn('score', function ($data) {
                    if($data->score){
                        return "Layak Meminjam";
                    }else{
                        return "Tidak Layak";
                    }
                })
                ->make(true);
        } catch (\Exception $e) {
            abort(500);
        }
    }

    public function hitung(Request $request){
        $penghasilan = $request->penghasilan;
        $pengeluaran = $request->pengeluaran;
        $pekerjaan = $request->pekerjaan;
        $status_kawin = $request->status_kawin;

        // true values
        $count_score_true = $this->model->where("score", true)->count();
        $count_penghasilan_score_true = $this->model->where("penghasilan", $penghasilan)->where("score", true)->count();
        $prob_penghasilan = $count_penghasilan_score_true / $count_score_true;

        $count_pengeluaran_score_true = $this->model->where("pengeluaran", $pengeluaran)->where("score", true)->count();
        $prob_pengeluaran = $count_pengeluaran_score_true / $count_score_true;

        $count_pekerjaan_score_true = $this->model->where("pekerjaan", $pekerjaan)->where("score", true)->count();
        $prob_pekerjaan = $count_pekerjaan_score_true / $count_score_true;

        $count_status_kawin_score_true = $this->model->where("status_kawin", $status_kawin)->where("score", true)->count();
        $prob_status_kawin = $count_status_kawin_score_true / $count_score_true;
        $score_true = $prob_penghasilan * $prob_pengeluaran * $prob_pekerjaan * $prob_status_kawin * ($count_score_true * $this->model->count());

        // false values
        $count_score_false = $this->model->where("score", false)->count();
        $count_penghasilan_score_false = $this->model->where("penghasilan", $penghasilan)->where("score", false)->count();
        $prob_penghasilan = $count_penghasilan_score_false / $count_score_false;

        $count_pengeluaran_score_false = $this->model->where("pengeluaran", $pengeluaran)->where("score", false)->count();
        $prob_pengeluaran = $count_pengeluaran_score_false / $count_score_false;

        $count_pekerjaan_score_false = $this->model->where("pekerjaan", $pekerjaan)->where("score", false)->count();
        $prob_pekerjaan = $count_pekerjaan_score_false / $count_score_false;

        $count_status_kawin_score_false = $this->model->where("status_kawin", $status_kawin)->where("score", false)->count();
        $prob_status_kawin = $count_status_kawin_score_false / $count_score_false;
        $score_false = $prob_penghasilan * $prob_pengeluaran * $prob_pekerjaan * $prob_status_kawin * ($count_score_false * $this->model->count());

        if($score_true > $score_false){
            $result = "Layak Meminjam";
        }else{
            $result = "Tidak Layak";
        }

        return Response::json(array('error' => 0, 'result' => $result));
    }

    public function detail($id)
    {
        try {
            $id = decodeids($id);
            $data = $this->model->sql()->findOrFail($id);
            return view($this->view.'.form.detail', compact('data', 'treerole'));
        } catch (\Exception $e) {
            abort(500);
        }
    }

    public function create()
    {
        try {
            $penghasilan = $this->library->getListPenghasilan();
            $pengeluaran = $this->library->getListPengeluaran();
            $pekerjaan = $this->library->getListPekerjaan();
            $status_kawin = $this->library->getListStatusKawin();
            return view($this->view.'.form.create', compact('penghasilan', 'pengeluaran', 'pekerjaan', 'status_kawin'));
        } catch (\Exception $e) {
            abort(500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->route($this->route.'.create')
                    ->withErrors($validator)
                    ->withInput();
            }

            $data = $this->model;
            $data->name = $request->name;
            $data->save();

            action_message('create', $this->menu);
            return json_encode(['redirect' => route($this->route.'.index')]);
        } catch (\Exception $e) {
            abort(500);
        }
    }

    public function edit($id)
    {
        try {
            $id = decodeids($id);
            $data = $this->model->findOrFail($id);
            return view($this->view.'.form.edit', compact('data'));
        } catch (\Exception $e) {
            abort(500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $id = decodeids($id);
            $data = $this->model->findOrFail($id);

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->route($this->route.'.edit', encodeids($id))
                    ->withErrors($validator)
                    ->withInput();
            }

            $data->name = $request->name;
            $data->update();

            action_message('update', $this->menu);
            return json_encode(['redirect' => route($this->route.'.index')]);
        } catch (\Exception $e) {
            abort(500);
        }
    }

    public function delete($id)
    {
        try {
            $id = decodeids($id);
            $data = $this->model->sql()->findOrFail($id);
            return view($this->view.'.form.delete', compact('data'));
        } catch (\Exception $e) {
            abort(500);
        }
    }

    public function destroy($id)
    {
        try {
            $id = decodeids($id);
            $data = $this->model->findOrFail($id);
            $data->delete();
            action_message('delete', $this->menu);
            return redirect()->route($this->route.'.index');
        } catch (\Exception $e) {
            abort(500);
        }
    }
}
