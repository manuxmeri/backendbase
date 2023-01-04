<?php namespace App\Models;
use CodeIgniter\Model ;
    class ExamenesModel extends Model{
        protected $table = 'tExamen';
        protected $primaryKey = 'id';
        protected $returnType ='array';
        protected $allowedFields = ['fechaVExamen','hora','temperatura','peso','altura','sintomas','diagnostico','notas','fkPaciente'];


       
        
        
        protected $validationRules = [
          
            'fechaVExamen' => 'required|min_length[1]|max_length[50]',
            'hora' => 'required|min_length[1]|max_length[50]',
            'temperatura' => 'required|min_length[1]|max_length[50]',
            'peso' => 'required|min_length[1]|max_length[50]',
            'altura' => 'required|min_length[1]|max_length[50]',
            'sintomas' => 'required|min_length[1]|max_length[50]',
            'diagnostico' =>'required|min_length[1]|max_length[50]',
            'notas' => 'required|min_length[1]|max_length[50]',
            'fkPaciente' => 'required|numeric',
            
            
        ];
        protected $validationMessages = [
            'fechaVExamen' => [
                'required' => 'Estimado usuario, es necesario el campo fecha de examen',
                'max_length' => 'Estimado usuario, ha excedido el tamaño permitido'
            ] ,
            'hora' => [
                'required' => 'Estimado usuario, es necesario el campo hora',
                'max_length' => 'Estimado usuario, ha excedido el tamaño permitido'
            ] ,
            'temperatura' => [
                'required' => 'Estimado usuario, es necesario el campo temperatura',
                'max_length' => 'Estimado usuario, ha excedido el tamaño permitido'
            ] ,
            'peso' => [
                'required' => 'Estimado usuario, es necesario el campo de peso',
                'max_length' => 'Estimado usuario, ha excedido el tamaño permitido'
            ] ,
            'altura' => [
                'required' => 'Estimado usuario, es necesario el campo altura', 
                'numeric' => 'Estimado usuario, solo se aceptan valores numericos',
                'max_length' => 'Estimado usuario, ha excedido el tamaño permitido'
            ] ,
            'sintomas' => [
                'required' => 'Estimado usuario, es necesario el campo de sintomas',
                'max_length' => 'Estimado usuario, ha excedido el tamaño permitido'
            ] ,
            'diagnostico' => [
                'required' => 'Estimado usuario, es necesario el campo de diagnostico',
                'max_length' => 'Estimado usuario, ha excedido el tamaño permitido'
            ] ,
            'notas' => [
                'required' => 'Estimado usuario, es necesario el campo de notas',
                'max_length' => 'Estimado usuario, ha excedido el tamaño permitido'
            ] 
            
        ];
        protected $skypValidation = false;
   
          public function Visitasrela($tpacienteId = null){
            $builder = $this->db->table($this->table);
            //$builder ->select('tpaciente.id AS NumeroPaciente, tpaciente.nombre, tpaciente.apellido');
            $builder ->select('tExamen.id AS examen, tExamen.fechaVExamen,  tExamen.hora,tExamen.temperatura,tExamen.peso, tExamen.altura,tExamen.sintomas,tExamen.diagnostico,tExamen.notas');
            $builder->join('tpaciente','tExamen.fkPaciente = tpaciente.id');
       $builder->where('tpaciente.id',$tpacienteId);
            $query = $builder->get();
       return $query->getResult();
          }
    }