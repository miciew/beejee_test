<?php


namespace Miciew\Controllers;


use Miciew\DB\DB;
use Miciew\Task;
use Miciew\Views\View;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends BaseController
{
    public function index( Request $request )
    {
        $orderBy = strtolower($request->get('orderBy', 'desc'));
        $orderCollumn = $request->get('orderCollumn', 'id');
        $limit = $request->get('limit');

        $tasks = Task::findAll($orderBy, $orderCollumn, $limit);

        $orderBy = $orderBy === 'desc' ? 'asc' : 'desc';

        $this->render('index', [
            'tasks' => $tasks,
            'limit' => $limit,
            'orderBy' => strtolower($orderBy)
        ]);
    }
}