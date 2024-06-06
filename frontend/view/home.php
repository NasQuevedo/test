<section class="container-fluid">
    <div class="row">
        <div class="col-sm-4">
        <h6 class="display-6">Crear</h6>
            <form id="form" daction="" method="POST">
                <span id="message" class="message"></span>
                <input type="hidden" id="user-id" value="" />
                <div class="mb-3 row">
                    <label for="name" class="col-sm-4 col-form-label">Nombres</label>
                    <div class="col-sm-8">
                        <input id="name" placeholder="Nombres" class="input form-control" type="text" name="name" required />
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="last-name" class="col-sm-4 col-form-label">Apellidos</label>
                    <div class="col-sm-8">
                        <input id="last-name" placeholder="Apellidos" class="input form-control" type="text" name="last-name" required />
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="age" class="col-sm-4 col-form-label">Edad</label>
                    <div class="col-sm-8">
                        <input id="age" placeholder="Edad" class="input form-control" type="number" name="age" required />
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="start-date" class="col-sm-4 col-form-label">Fecha de Ingreso</label>
                    <div class="col-sm-8">
                        <input id="start-date" placeholder="Fecha de ingreso" class="input form-control" type="date" name="start-date" required />
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="comment" class="col-sm-4 col-form-label">Comentarios</label>
                    <div class="col-sm-8">
                        <textarea id="comment" placeholder="comentarios" class="input form-control" type="text" name="comment" row="3"></textarea>
                    </div>
                </div>
                <button type="button" class="btn btn-primary"id="send-form" onclick="send();">Enviar</button>
                <button type="button" class="btn" id="clean-form" onclick="clean();">limpiar</button>
            </form>
        </div>
        <div class="col-sm-8">
            <h6 class="display-6">Empleados</h6>
            <table class="table table-hover" id="employees-table" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Edad</th>
                        <th>Fecha de Ingreso</th>
                        <th>Comentarios</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="table-content"></tbody>
            </table>
        </div>
    </div>
</section>