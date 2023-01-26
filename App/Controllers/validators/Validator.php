<?php
class Validator{

    private $data;
    protected $erros=[];
    public function validates(array $data){
        $this->erros=[];
        $this->data=$data;
        
    }

    public function validate(string $field, string $methode, ...$parameters){
       if (!isset( $this->data[$field])) {
        $this->erros[$field]="Le champs $field n'est pas rempli";
       }else{
        call_user_func([$this, $methode], $field, ...$parameters);
       }
        
    }

    public function minLength(string $field, int $length ):bool{
        if (mb_strlen($field) < $length) {
            $this->erros[$field]="Le champs $field doit avoir plus de $length caractères";
            
            return false;
        }
        return true;
    }
    public function date(string $field ):bool{
        if (DateTime::createFromFormat('Y-m-d', $this->data[$field]) ===false) {
            $this->erros[$field]="Le champs $field ne semble pas valide";
            return false;
        }
        return true;

    }
    public function time(string $field ):bool{
        if (DateTime::createFromFormat('H:i', $this->data[$field]) ===false) {
            $this->erros[$field]="Le temps $field ne semble pas valide";
            return false;
        }
        return true;
    }
    public function beforeTime(string $startField, string $endField){
        if ($this->time($startField) && $this->time($endField)) {
           $time1= DateTime::createFromFormat('H:i', $this->data[$startField]);
           $time2= DateTime::createFromFormat('H:i', $this->data[$endField]);

           if ( $time1->getTimestamp() > $time2->getTimestamp()) {
            $this->erros[$startField]="Le temps de debut doit etre inférieure au temps de fin";
            return false;
           }
           
          return true;
        }
        return false;

    }
}