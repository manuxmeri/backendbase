<?php namespace App\Models;
use CodeIgniter\Model ;
    class PacientesModel extends Model{
        protected $table = 'tpaciente';
        protected $primaryKey = 'id';
        protected $returnType ='array';
        protected $allowedFields = ['nombre','apellido','direccion','fechanaci','edad'];

 
        protected $validationRules = [
          
            
            'nombre' => 'required|min_length[1]|max_length[50]',
            'apellido' => 'required|min_length[1]|max_length[50]',
            'direccion' => 'required|min_length[1]|max_length[50]',
            'fechanaci' => 'required|min_length[1]|max_length[50]',
            'edad' => 'required|numeric|min_length[1]|max_length[3]',
            
            
        ];
        protected $validationMessages = [
            'nombre' => [
                'required' => 'Estimado usuario, es necesario el campo nombre',
                'max_length' => 'Estimado usuario, ha excedido el tamaño permitido'
            ] ,
            'apellido' => [
                'required' => 'Estimado usuario, es necesario el campo apellido',
                'max_length' => 'Estimado usuario, ha excedido el tamaño permitido'
            ] ,
            'direccion' => [
                'required' => 'Estimado usuario, es necesario el campo direccion',
                'max_length' => 'Estimado usuario, ha excedido el tamaño permitido'
            ] ,
            'fechanaci' => [
                'required' => 'Estimado usuario, es necesario el campo de fecha de nacimiento',
                'max_length' => 'Estimado usuario, ha excedido el tamaño permitido'
            ] ,
            'edad' => [
                'required' => 'Estimado usuario, es necesario el campo edad', 
                'numeric' => 'Estimado usuario, solo se aceptan valores numericos',
                'max_length' => 'Estimado usuario, ha excedido el tamaño permitido'
            ] 
        ];
        protected $skypValidation = false;
    }
    