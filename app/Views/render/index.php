
<?php include __DIR__ . '/form.task.php'; ?>

<div class="card">
        <table class="table">
            <thead class="thead-light">
            <tr>
                <th scope="col">
                    <a href="/?orderCollumn=id&orderBy=<?=$this->orderBy;?>">#</a>
                </th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">
                    <a href="/?orderCollumn=username&orderBy=<?=$this->orderBy;?>"">Autor</a>
                </th>
                <th>

                    <a href="/?orderCollumn=email&orderBy=<?=$this->orderBy;?>"">email</a>
                </th>
                <th>
                    Actions
                </th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ( $this->tasks as $task ): ?>
                    <tr>
                        <th scope="row">
                            <span class="btn btn-<?=$task->status ? 'success glyphicon glyphicon-ok':'warning glyphicon glyphicon-random';?>"></span>

                            <label class="custom-control-label" for="task-<?=$task->id;?>">
                        </th>
                        <td><?= $task->title; ?></td>
                        <td><?= $task->description; ?></td>
                        <td><span class="badge badge-light"><?=$task->username;?></span></td>
                        <td><span class="badge badge-light"><?=$task->email;?></span></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="/tasks/edit?id=<?=$task->id;?>" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="/tasks/delete?id=<?=$task->id;?>" class="btn btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
</div>

<script>
    $(function () {
        toogleTaskStatus();
    });
</script>