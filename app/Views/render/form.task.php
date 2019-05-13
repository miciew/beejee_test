<h1>TODO</h1>

<form class="" role="form" action="/tasks/create" method="post">
    <div class="form-group">
        <input type="text" name="username" class="form-control" id="username" placeholder="user name">
    </div>
    <div class="form-group">
        <input type="text" name="email" class="form-control" id="email" placeholder="email">
    </div>
    <div class="form-group">
        <input type="text" name="title" class="form-control" id="title" placeholder="Add todo">
    </div>
    <div class="form-group">
        <textarea name="description" class="form-control" placeholder="description"></textarea>
    </div>
    <input type="submit" class="btn btn-primary" id="add-todo-button" value="Add">
</form>