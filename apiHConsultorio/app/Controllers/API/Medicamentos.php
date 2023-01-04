<?php namespace App\Controllers\API;
use App\Models\MedicamentosModel;
use CodeIgniter\RESTful\ResourceController;



class Medicamentos extends ResourceController
{
    public function __construct() {
        $this->model = $this->setModel(new MedicamentosModel());
    }
    public function index()
    { 
       
        $medicamentos = $this->model->findAll();
       
        return $this->respond($medicamentos);
    }
    public function create()
    {
        try {
        $medicamento = $this->request->getJSON();
        if($this->model->insert($medicamento)):
    
            return $this->respondCreated($medicamento);
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
            $medicamento = $this->model->find($id);

            if($medicamento == null)
            return $this->failNotFound('No se ha encontrado un cliente con el id:' .$id); 
          return $this->respond($medicamento);
            } catch (\Exception $e) {
                return $this->failServerError('Ha ocurrido un error en el servidor');
            }
    }
    public function update($id = null)
    {
        try {
            
            if($id == null)
            return $this->failValidationError('No se ha pasado un Id valido');
            $medicamentoVerificado = $this->model->find($id);
            if($medicamentoVerificado == null)
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
            $medicamentoVerificado = $this->model->find($id);
            if($medicamentoVerificado == null)
            return $this->failNotFound('No se ha encontrado un paciente con el id:' .$id); 


            if($this->model->delete($id)):
                  return $this->respondDeleted($medicamentoVerificado);
              else:
                return $this->failServerError('No se ha podido eliminar el registro');
              endif;
            } catch (\Exception $e) {
                return $this->failServerError('Ha ocurrido un error en el servidor');
            }
    }
  
  
}