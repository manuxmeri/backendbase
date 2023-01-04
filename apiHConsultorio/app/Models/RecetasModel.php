<?php namespace App\Models;
use CodeIgniter\Model ;

    class RecetasModel extends Model{
        protected $table = 'treceta';
        protected $primaryKey = 'id';
        protected $returnType ='array';
        protected $allowedFields = ['fechaReceta','dosis','nota','fkPaciente','fkMedicamento'];
        protected $createdField = 'created_at';
        protected $updatedFiel = 'updated_at';
        
        
        protected $validationRules = [
          
            'fechaReceta' => 'required|min_length[1]|max_length[50]',
            'dosis' => 'required|min_length[1]|max_length[50]',
            'nota' => 'required|min_length[1]|max_length[50]',
            'fkPaciente' => 'required|numeric',
            'fkMedicamento' => 'required|numeric',

            
            
        ];
        protected $validationMessages = [
            'fechaReceta' => [
                'required' => 'Estimado usuario, es necesario el campo nombre',
                'max_length' => 'Estimado usuario, ha excedido el tamaño permitido'
            ] ,
            'dosis' => [
                'required' => 'Estimado usuario, es necesario el campo apellido',
                'max_length' => 'Estimado usuario, ha excedido el tamaño permitido'
            ] ,
            'nota' => [
                'required' => 'Estimado usuario, es necesario el campo direccion',
                'max_length' => 'Estimado usuario, ha excedido el tamaño permitido'
            ] ,
            'fkPaciente' => [
                'required' => 'Estimado usuario, es necesario el campo de fecha de nacimiento',
                'max_length' => 'Estimado usuario, ha excedido el tamaño permitido'
            ] ,
            'fkMedicamento' => [
                'required' => 'Estimado usuario, es necesario el campo edad', 
                'numeric' => 'Estimado usuario, solo se aceptan valores numericos',
                'max_length' => 'Estimado usuario, ha excedido el tamaño permitido'
            ] 
        ];
        protected $skypValidation = false;
     
          public function Recetasrela($tpacienteId = null){
            $builder = $this->db->table($this->table);
            //$builder ->select('tpaciente.id AS NumeroPaciente, tpaciente.nombre, tpaciente.apellido');
            $builder ->select('treceta.id AS receta, treceta.fechaReceta, treceta.dosis, treceta.nota');
            $builder ->select('tmedicamento.id AS medicamento, tmedicamento.nombre');
            $builder->join('tpaciente','treceta.fkPaciente = tpaciente.id');
            $builder->join('tmedicamento','treceta.fkMedicamento = tmedicamento.id');
       $builder->where('tpaciente.id',$tpacienteId);
            $query = $builder->get();
       return $query->getResult();
          }
    }
   