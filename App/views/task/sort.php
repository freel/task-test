<form action="/" method="post">
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="sort">Sort field</label>
            <select id="sort" name="sort" class="form-control">
                <option value="id" <?php if ($this->model->sort == 'id') echo "selected" ?>>Id</option>
                <option value="user" <?php if ($this->model->sort == 'user') echo "selected" ?>>Name</option>
                <option value="email" <?php if ($this->model->sort == 'email') echo "selected" ?>>Email</option>
                <option value="status" <?php if ($this->model->sort == 'status') echo "selected" ?>>Status</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="order">Order</label>
            <select id="order" name="order" class="form-control">
                <option value="1" <?php if ($this->model->order) echo "selected" ?>>Direct</option>
                <option value="0" <?php if (!$this->model->order) echo "selected" ?>>Reverse</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Sort</button>
    </div>
</form>
