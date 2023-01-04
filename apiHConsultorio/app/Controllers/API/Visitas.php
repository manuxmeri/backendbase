<?php namespace App\Controllers\API;
use App\Models\PacientesModel;
use App\Models\VisitasModel;
use CodeIgniter\RESTful\ResourceController;



class Visitas extends ResourceController
{
    public function __construct() {
        $this->model = $this->setModel(new VisitasModel());
    }
    public function index()
    { 
       
        $visitas = $this->model->findAll();
       
        return $this->respond($visitas);
    }
    public function create()
    {
        try {
        $visita = $this->request->getJSON();
        if($this->model->insert($visita)):
    
            return $this->respondCreated($visita);
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
            $visita = $this->model->find($id);

            if($visita == null)
            return $this->failNotFound('No se ha encontrado un cliente con el id:' .$id); 
          return $this->respond($visita);
            } catch (\Exception $e) {
                return $this->failServerError('Ha ocurrido un error en el servidor');
            }
    }
    
    public function update($id = null)
    {
        try {
            
            if($id == null)
            return $this->failValidationError('No se ha pasado un Id valido');
            $visita = $this->model->find($id);
            if($visita == null)
            return $this->failNotFound('No se ha encontrado un visita con el id:' .$id); 
            $visita = $this->request->getJSON();

            if($this->model->update($id,$visita)):
               $visita->id = $id;
                  return $this->respondUpdated($visita);
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
            $visitaVerificado = $this->model->find($id);
            if($visitaVerificado == null)
            return $this->failNotFound('No se ha encontrado un visita con el id:' .$id); 


            if($this->model->delete($id)):
                  return $this->respondDeleted($visitaVerificado);
              else:
                return $this->failServerError('No se ha podido eliminar el registro');
              endif;
            } catch (\Exception $e) {
                return $this->failServerError('Ha ocurrido un error en el servidor');
            }
    }
    public function getVisitasrelaByPacientes($id = null)
    {
        try {
            $modelPacientes= new PacientesModel();
    
            if($id == null)
            return $this->failValidationError('No se ha pasado un Id valido');
    
            $paciente = $modelPacientes->find($id);
    
            if($paciente == null)
            return $this->failNotFound('No se ha encontrado un cliente con el id:' .$id); 
         $visitas = $this->model->Visitasrela($id);
            return $this->respond($visitas);
            } catch (\Exception $e) {
                return $this->failServerError('Ha ocurrido un error en el servidor');
            }
    }
  
}