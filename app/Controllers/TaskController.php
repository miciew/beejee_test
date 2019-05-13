<?php

namespace Miciew\Controllers;


use Miciew\Task;
use Symfony\Component\HttpFoundation\Request;

class TaskController extends IndexController
{
    public function store( Request $request )
    {
        $request->request->set('description', htmlspecialchars($request->get('description')));
        $request->request->set('title', htmlspecialchars($request->get('title')));

        $request->request->set('status', $request->get('status', 0));
        $task = Task::create(
            $request->request->all()
        );

        $this->redirect('/');
    }

    public function updateTaskStatus( Request $request )
    {
        /** @var Task $task */
        $task = Task::findByPk(intval($request->get('id')));

        $task->status = intval( ! boolval($task->status) );

        $task->save();

        $this->redirect('/');
    }

    public function updateTask( Request $request )
    {
        if( ! auth()->isLoggedIn() )
            $this->redirect('/');


        $task = Task::findByPk(intval($request->get('id')));

        $task->title = $request->get('title', $task->title);
        $task->status = intval($request->get('status', $task->status));
        $task->description = htmlspecialchars($request->get('description', $task->description));

        $task->save();

        $this->redirect('/');
    }
    public function editeTask( Request $request )
    {
        if( ! auth()->isLoggedIn() )
        {
            $this->redirect('/');
        }


        $task = Task::findByPk(intval($request->get('id')));

        $this->render('edit', [
            'task' => $task
        ]);
    }

    public function deleteTask( Request $request )
    {
        if( ! auth()->isLoggedIn() )
        {
            $this->redirect('/');
        }

        /** @var Task $task */
        $task = Task::findByPk( intval($request->get('id')) );

        $task->delete();

        $this->redirect('/');
    }

    public function statusStore( Request $request )
    {
        TaskStatus::create(
            $request->query->all()
        );

        $this->redirect('/');
    }
}