<?php namespace App\Models;
use CodeIgniter\Model ;
    class MedicamentosModel extends Model{
        protected $table = 'tmedicamento';
        protected $primaryKey = 'id';
        protected $returnType ='array';
        protected $allowedFields = ['nombre','capacidad'];

    
    
        
        
        protected $validationRules = [
          
            'nombre' => 'required|min_length[1]|max_length[50]',
            'capacidad' => 'required|min_length[1]|max_length[50]',
            
            
            
        ];
        protected $validationMessages = [
            'nombre' => [
                'required' => 'Estimado usuario, es necesario el campo nombre',
                'max_length' => 'Estimado usuario, ha excedido el tamaño permitido'
            ] ,
            'capacidad' => [
                'required' => 'Estimado usuario, es necesario el campo capacidad',
                'max_length' => 'Estimado usuario, ha excedido el tamaño permitido'
            ] 
            
        ];
        protected $skypValidation = false;
    }