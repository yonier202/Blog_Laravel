<?php

namespace App\Livewire;

use App\Events\CommentCreated;
use Livewire\Component;
use App\Models\Question as ModelQuestion;

class Question extends Component
{
    public $model;
    public $message;
    // public $questions;
    public $cant = 10;
    public $question_edit = [
        'id' => null,
        'body' => '',
    ];
    public function render()
    {
        return view('livewire.question');
    }

    public function getQuestionsProperty(){ //propiedad computada
        return $this->model->questions()->orderBy('created_at', 'desc')
            ->take($this->cant)
            ->get();
    }
    public function store(){
        // dd('se procesara el formulario');

        if (auth()->id()) { //validar si esta autenticado
            $this->validate([
                'message' => ['required'],
             ]);
             $question = $this->model->questions()->create([ //guardar en la bd atrvez de la relacion
                 'body' => $this->message,
                 'user_id' => auth()->id(),
             ]);
     
             // $this->getQuestions(); //cargar las preguntas al montar el componente
              
             $this->message = ''; //retornar a vacio
     
             CommentCreated::dispatch($question); //disparar evento
        }else{
            return redirect()->route('login');
        }
    }

    // public function getQuestions(){
    //     $this->questions = $this->model->questions()->orderBy('created_At', 'desc')
    //         ->take($this->cant)
    //         ->get();
    // }

    // public function mount(){
    //     $this->getQuestions(); //cargar las preguntas al montar el componente
    // }
    public function edit($questionId){
        // dd('se editara el componente con id ' . $questionId);
        $quetion = ModelQuestion::find($questionId);
        $this->question_edit = [
            'id' => $quetion->id,
            'body' => $quetion->body,
        ];
    }

    public function destroy($questionId){
        // dd('se eliminara el componente con id'. $questionId);
        $question = ModelQuestion::find($questionId);
        $question->delete();
        // $this->getQuestions(); //cargar las preguntas al montar el componente
        $this->reset('question_edit'); 
    }

    public function cancel(){
        $this->reset('question_edit');
    }
    public function update(){
        $this->validate([
            'question_edit.body' => ['required'],
        ]);

        $question = ModelQuestion::find($this->question_edit['id']);
        $question->update([
            'body' => $this->question_edit['body'],
        ]);
        // $this->getQuestions(); //cargar las preguntas al montar el componente

        $this->reset('question_edit'); 
    }

    public function show_more_question(){
        $this->cant += 10;
        // $this->getQuestions(); //cargar las preguntas al montar el componente
    }
}
