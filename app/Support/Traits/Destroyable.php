<?php

namespace App\Support\Traits;

use Illuminate\Http\Request;

trait Destroyable
{
    public function destroy(Request $request)
    {
        // Permanent Delete
        if ($request->has('permanently')) {
            foreach ($request->input('id') as $id) {
                $this->model::withTrashed()->find($id)->forceDelete();
            }

            return redirect()->route($this->modelTag . '.dashboard.trash');
        }

        // Trash
        foreach ($request->input('id') as $id) {
            $this->model::find($id)->delete();
        }

        return redirect()->route($this->modelTag . '.dashboard.index');
    }

    public function restore(Request $request)
    {
        $this->model::onlyTrashed()->find($request->input('id'))->restore();

        return redirect()->back();
    }
}
