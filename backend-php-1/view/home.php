<section class="section">
    <div class="div-form">
        <form id="form" daction="" method="POST">
            <span id="message" class="message"></span>
            <input type="hidden" id="user-id" value="" />
            <div class="form-group">
                <label for="">Nombres</label>
                <input id="name" class="input" type="text" name="name" required />
            </div>
            <div class="form-group">
                <label for="">Apellidos</label>
                <input id="last-name" class="input" type="text" name="last-name" required />
            </div>
            <div class="form-group">
                <label for="">Edad</label>
                <input id="age" class="input" type="number" name="age" required />
            </div>
            <div class="form-group">
                <label for="">Fecha de Ingreso</label>
                <input id="start-date" class="input" type="date" name="start-date" required />
            </div>
            <div class="form-group">
                <label for="">Comentarios</label>
                <textarea id="comment" type="text" name="comment"></textarea>
            </div>
            <button type="button" id="send-form" onclick="send();">Enviar</button>
            <button type="button" id="clean-form" onclick="clean();">limpiar</button>
        </form>
    </div>
    <div class="div-grid">
        <h4>Empleados</h4>
        <table id="employees-table" cellspacing="0">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Edad</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody id="table-content"></tbody>
        </table>
    </div>
</section>