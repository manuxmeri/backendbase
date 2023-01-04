<?php namespace App\Controllers\API;
use App\Models\PacientesModel;
use App\Models\RecetasModel;
use CodeIgniter\RESTful\ResourceController;


class Recetas extends ResourceController
{
    public function __construct() {
        $this->model = $this->setModel(new RecetasModel());
    }
    public function index()
    { 
       
        $recetas = $this->model->findAll();
       
        return $this->respond($recetas);
    }
    public function create()
    {
        try {
        $receta = $this->request->getJSON();
        if($this->model->insert($receta)):
    
            return $this->respondCreated($receta);
        else:
             return $this->failValidationError($this->model->validation->listErrors());
        endif;
        } catch (\Exception $e) {
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
        

    }
    
    
    public function edit($id = null)
    {
        try {
            
            if($id == null)
            return $this->failValidationError('No se ha pasado un Id valido');
            $receta = $this->model->find($id);

            if($receta == null)
            return $this->failNotFound('No se ha encontrado un cliente con el id:' .$id); 
          return $this->respond($receta);
            } catch (\Exception $e) {
                return $this->failServerError('Ha ocurrido un error en el servidor');
            }
    }
    public function update($id = null)
    {
        try {
            
            if($id == null)
            return $this->failValidationError('No se ha pasado un Id valido');
            $recetaVerificado = $this->model->find($id);
            if($recetaVerificado == null)
            return $this->failNotFound('No se ha encontrado un receta con el id:' .$id); 
            $receta = $this->request->getJSON();

            if($this->model->update($id,$receta)):
               $receta->id = $id;
                  return $this->respondUpdated($receta);
              else:
                   return $this->failValidationError($this->model->validation->listErrors());
              endif;
            } catch (\Exception $e) {
                return $this->failServerError('Ha ocurrido un error en el servidor');
            }
    }

    public function delete($id = null)
    {
        try {
            
            if($id == null)
            return $this->failValidationError('No se ha pasado un Id valido');
            $recetaVerificado = $this->model->find($id);
            if($recetaVerificado == null)
            return $this->failNotFound('No se ha encontrado un receta con el id:' .$id); 


            if($this->model->delete($id)):
                  return $this->respondDeleted($recetaVerificado);
              else:
                return $this->failServerError('No se ha podido eliminar el registro');
              endif;
            } catch (\Exception $e) {
                return $this->failServerError('Ha ocurrido un error en el servidor');
            }
    }
    public function getRecetasrelaByPacientes($id = null)
    {
        try {
            $modelPacientes= new PacientesModel();
    
            if($id == null)
            return $this->failValidationError('No se ha pasado un Id valido');
    
            $paciente = $modelPacientes->find($id);
    
            if($paciente == null)
            return $this->failNotFound('No se ha encontrado un cliente con el id:' .$id); 
         $recetas = $this->model->Recetasrela($id);
            return $this->respond($recetas);
            } catch (\Exception $e) {
                return $this->failServerError('Ha ocurrido un error en el servidor');
            }
    }
}
