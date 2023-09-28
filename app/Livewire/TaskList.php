<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

class TaskList extends Component
{
    public $tasks;
    public $name = '';

    function mount()  {
        $this->fetchTasks();
    }

    function fetchTasks() {
        $this->tasks = Task::all()->reverse();
    }

    function addTask() {
        if ($this->name != '') {
            $todo = new Task;
            $todo->name = $this->name;
            $todo->save();
            $this->name = '';
            $this->fetchTasks();
        }
    }

    function makedone(Task $task) {
        $task->status = 'closed';
        $task->save();
        $this->fetchTasks();
    }

    function remove(Task $task)  {

        $task->delete();
        $this->fetchTasks();
    }

    public function render()
    {
        return view('livewire.task-list');
    }
}
