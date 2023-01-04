<?php namespace App\Models;
use CodeIgniter\Model ;
    class VisitasModel extends Model{
        protected $table = 'tvisitaMedica';
        protected $primaryKey = 'id';
        protected $returnType ='array';
        protected $allowedFields = ['diagnosticoEnfermedad','fecha','hora','fkPaciente'];
        protected $createdField = 'created_at';
        protected $updatedFiel = 'updated_at';
        
        
        protected $validationRules = [
          
            'diagnosticoEnfermedad' => 'required|min_length[1]|max_length[50]',
            'fecha' => 'required|min_length[1]|max_length[50]',
            'hora' => 'required|min_length[1]|max_length[50]',
            'fkPaciente' => 'required|numeric',            
        ];
        protected $validationMessages = [
            'diagnosticoEnfermedad' => [
                'required' => 'Estimado usuario, es necesario el campo nombre',
                'max_length' => 'Estimado usuario, ha excedido el tamaño permitido'
            ] ,
            'fecha' => [
                'required' => 'Estimado usuario, es necesario el campo apellido',
                'max_length' => 'Estimado usuario, ha excedido el tamaño permitido'
            ] ,
            'hora' => [
                'required' => 'Estimado usuario, es necesario el campo direccion',
                'max_length' => 'Estimado usuario, ha excedido el tamaño permitido'
            ] ,
            'fkPaciente' => [
                'required' => 'Estimado usuario, es necesario el campo de fecha de nacimiento',
                'max_length' => 'Estimado usuario, ha excedido el tamaño permitido'
            ] 
        ];
        protected $skypValidation = false;
        public function Visitasrela($tpacienteId = null){
            $builder = $this->db->table($this->table);
            //$builder ->select('tpaciente.id AS NumeroPaciente, tpaciente.nombre, tpaciente.apellido');
            $builder ->select('tvisitaMedica.id AS visitan, tvisitaMedica.diagnosticoEnfermedad, tvisitaMedica.fecha, tvisitaMedica.hora');
            $builder->join('tpaciente','tvisitaMedica.fkPaciente = tpaciente.id');
       $builder->where('tpaciente.id',$tpacienteId);
            $query = $builder->get();
       return $query->getResult();
          }
    }