<?php

namespace App\Livewire;

use Livewire\Component;

class Question extends Component
{
    public $model;
    public $message;
    public $questions;
    public function render()
    {
        return view('livewire.question');
    }
    public function store(){
        // dd('se procesara el formulario');

        $this->validate([
           'message' => ['required', 'min:5'],
        ]);
        $this->model->questions()->create([ //guardar en la bd atrvez de la relacion
            'body' => $this->message,
            'user_id' => auth()->id(),
        ]);

        $this->getQuestions(); //cargar las preguntas al montar el componente
         
        $this->message = ''; //retornar a vacio
    }

    public function getQuestions(){
        $this->questions = $this->model->questions()->orderBy('created_At', 'desc')->get();
    }

    public function mount(){
        $this->getQuestions(); //cargar las preguntas al montar el componente
    }
}
