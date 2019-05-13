<form class="" role="form" action="/tasks/update?id=<?=$this->task->id;?>" method="post">
    <div class="form-group">
        <input type="text" name="title" class="form-control" id="title" value="<?=$this->task->title;?>" placeholder="Add todo">
    </div>
    <div class="form-group">
        <select class="form-control" name="status">
            <option value="0" <?=$this->task->status == 0 ? 'selected' :'';?>>Актуальная</option>
            <option value="1" <?=$this->task->status == 1 ? 'selected' :'';?>>Завершена</option>
        </select>
    </div>
    <div class="form-group">
        <textarea name="description" class="form-control" placeholder="description"> value="<?=$this->task->description;?>"</textarea>
    </div>
    <input type="submit" class="btn btn-primary" id="add-todo-button" value="Update">
</form>