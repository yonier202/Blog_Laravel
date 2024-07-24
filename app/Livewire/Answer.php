<?php

namespace App\Livewire;

use App\Models\Answer as ModelsAnswer;
use Livewire\Component;

class Answer extends Component
{
    public $open = false;
    public $cant=0;
    public $question;
    public $answer_edit = [
        'id' => null,
        'body' => '',
    ];
    public $answer_created = [
        'open' => false,
        'body' => ''
    ];

    // public $answers;
    public $answer_to_answer =[
        'id' => null,
        'body' => '',
    ];

    // public function mount(){ //mount() se ejecuta automáticamente(ES COMO EL CONTRUCTOR).
    //     $this->getAnswer();
    // }

    // public function getAnswer(){
    //     $this->answers = $this->question->answers()->orderBy('id','asc')->get(); //traer las respuesta de cada pregunta
    // }
    public function getAnswersProperty(){
        return $this->question->answers()->orderBy('id','asc')
            // ->when(!$this->open, function ($query){ //si open es falso trae 0 respuestas(nada)
            //     $query->take(0);
            // })
            
            ->get() //traer las respuesta de cada pregunta
            ->take($this->cant * (-1)); // x -1 trae el ultimo
    }

    public function store(){
        $this->validate([
            'answer_created.body' => 'required'
        ]);

        $this->question->answers()->create([ //creamos atravez de la relación entre question y answer
            'body' => $this->answer_created['body'],
            'user_id' => auth()->id()
        ]);

        $this->cant+=1; //mostrar el comentario creado
        // $this->getAnswer();

        $this->reset('answer_created');
    }
    public function edit($answerId){
        // dd('se editara el componente con id ' . $questionId);
        $answer = ModelsAnswer::find($answerId);
        $this->answer_edit = [
            'id' => $answer->id,
            'body' => $answer->body,
        ];
    }

    public function destroy($answerId){
        // dd('se eliminara el componente con id'. $questionId);
        $answer = ModelsAnswer::find($answerId);
        $answer->delete();
        // $this->getAnswer(); //cargar las preguntas al montar el componente
        $this->reset('answer_edit');
    }

    public function cancel(){
        $this->reset('answer_edit');
    }
    public function update(){
        $this->validate([
            'answer_edit.body' => ['required'],
        ]);

        $answer = ModelsAnswer::find($this->answer_edit['id']);
        $answer->update([
            'body' => $this->answer_edit['body'],
        ]);
        // $this->getAnswer(); //cargar las preguntas al montar el componente //cargar las preguntas al montar el componente

        $this->reset('answer_edit');
    }

    public function answer_to_answer_store(){
        // dd($this->answer_to_answer['body']);
        $this->validate([
            'answer_to_answer.body' => ['required'],
        ]);
        $answer = $this->question->answers()->create([
            'body' => $this->answer_to_answer['body'],
            'user_id' => auth()->id(),
        ]);

        $this->reset('answer_to_answer');

        // $this->getAnswer(); //cargar las preguntas al montar el componente //cargar las preguntas al montar el componente
    }

    public function render()
    {
        return view('livewire.answer');
    }

    public function show_answer(){
        if ($this->cant < $this->question->answers()->count()) {
            $this->cant = $this->question->answers()->count();
        }else{
            $this->cant = 0;
        }
        // $this->open = !$this->open;
    }
    
}
