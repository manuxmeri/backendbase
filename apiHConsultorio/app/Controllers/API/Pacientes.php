<?php namespace App\Controllers\API;
use App\Models\PacientesModel;
use CodeIgniter\RESTful\ResourceController;



class Pacientes extends ResourceController
{
    public function __construct() {
        $this->model = $this->setModel(new PacientesModel());
    }
    public function index()
    { 
       
        $pacientes = $this->model->findAll();
       
        return $this->respond($pacientes);
    }
    public function create()
    {
        try {
        $paciente = $this->request->getJSON();
        if($this->model->insert($paciente)):
            $paciente->id = $this->model->insertId();
            return $this->respondCreated($paciente);
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
            $paciente = $this->model->find($id);

            if($paciente == null)
            return $this->failNotFound('No se ha encontrado un paciente con el id:' .$id); 
          return $this->respond($paciente);
            } catch (\Exception $e) {
                return $this->failServerError('Ha ocurrido un error en el servidor');
            }
    }
    public function update($id = null)
    {
        try {
            
            if($id == null)
            return $this->failValidationError('No se ha pasado un Id valido');
            $pacienteVerificado = $this->model->find($id);
            if($pacienteVerificado == null)
            return $this->failNotFound('No se ha encontrado un paciente con el id:' .$id); 
            $paciente = $this->request->getJSON();

            if($this->model->update($id,$paciente)):
               $paciente->id = $id;
                  return $this->respondUpdated($paciente);
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
            $pacienteVerificado = $this->model->find($id);
            if($pacienteVerificado == null)
            return $this->failNotFound('No se ha encontrado un paciente con el id:' .$id); 


            if($this->model->delete($id)):
                  return $this->respondDeleted($pacienteVerificado);
              else:
                return $this->failServerError('No se ha podido eliminar el registro');
              endif;
            } catch (\Exception $e) {
                return $this->failServerError('Ha ocurrido un error en el servidor');
            }
    }
}