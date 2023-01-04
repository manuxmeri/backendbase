<?php namespace App\Controllers\API;
use App\Models\PacientesModel;
use App\Models\ExamenesModel;
use CodeIgniter\RESTful\ResourceController;



class Examenes extends ResourceController
{
    public function __construct() {
        $this->model = $this->setModel(new ExamenesModel());
    }
    public function index()
    { 
       
        $examenes = $this->model->findAll();
       
        return $this->respond($examenes);
    }
    public function create()
    {
        try {
        $examen = $this->request->getJSON();
        if($this->model->insert($examen)):
            $examen->id = $this->model->insertId();
            return $this->respondCreated($examen);
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
            $examen = $this->model->find($id);

            if($examen == null)
            return $this->failNotFound('No se ha encontrado un cliente con el id:' .$id); 
          return $this->respond($examen);
            } catch (\Exception $e) {
                return $this->failServerError('Ha ocurrido un error en el servidor');
            }
    }
    public function update($id = null)
    {
        try {
            
            if($id == null)
            return $this->failValidationError('No se ha pasado un Id valido');
            $examen = $this->model->find($id);
            if($examen == null)
            return $this->failNotFound('No se ha encontrado un examen con el id:' .$id); 
            $examen = $this->request->getJSON();

            if($this->model->update($id,$examen)):
               $examen->id = $id;
                  return $this->respondUpdated($examen);
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
            $examenVerificado = $this->model->find($id);
            if($examenVerificado == null)
            return $this->failNotFound('No se ha encontrado un examen con el id:' .$id); 


            if($this->model->delete($id)):
                  return $this->respondDeleted($examenVerificado);
              else:
                return $this->failServerError('No se ha podido eliminar el registro');
              endif;
            } catch (\Exception $e) {
                return $this->failServerError('Ha ocurrido un error en el servidor');
            }
    }
   
    public function getExamenesrelaByPacientes($id = null)
    {
        try {
            $modelPacientes= new PacientesModel();
    
            if($id == null)
            return $this->failValidationError('No se ha pasado un Id valido');
    
            $paciente = $modelPacientes->find($id);
    
            if($paciente == null)
            return $this->failNotFound('No se ha encontrado un paciente con el id:' .$id); 
         $examenes = $this->model->Visitasrela($id);
            return $this->respond($examenes);
            } catch (\Exception $e) {
                return $this->failServerError('Ha ocurrido un error en el servidor');
            }
    
  
}
  
}