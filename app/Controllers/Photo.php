<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Photo as ModelsPhoto;

class Photo extends BaseController
{
    public function __construct()
    {
        $this->model = new ModelsPhoto();
    }

    public function index()
    {
        $data['photos'] = $this->model->findAll();

        return view('photo/index', $data);
    }

    public function new()
    {
        return view('photo/new');
    }

    public function create()
    {
        $validated = $this->validate([
            'photo' => [
                'uploaded[photo]',
                'mime_in[photo,image/jpg,image/jpeg,image/gif,image/png]',
                'max_size[photo,4096]',
            ],
        ]);

        if ($validated) {
            $photo = $this->request->getFile('photo');
            // uploaded image saved to public/img/uploads
            $photo->move('img/uploads/', $photo->getClientName());

            $data = [
                'name' => $photo->getClientName(),
                'type' => $photo->getClientMimeType(),
            ];

            $this->model->insert($data);

            return redirect()->route('photos');
        } else {
            return redirect()->back()->withInput()->with('error', 'Please select a valid photo!');
        }
    }

    public function download($id)
    {
        $data = $this->model->find($id);

        // response will download file from public/img/uploads
        return $this->response->download('img/uploads/' . $data->name, null);
    }

    public function delete($id)
    {
        $this->model->delete($id);

        return redirect()->route('photos');
    }
}
