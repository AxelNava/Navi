<x-app-layout>
  <style>
      .agregar-alumno {
          background-color: #618ef2;
          border: none;
          border-radius: 15px;
          color: white;
          padding: 10px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          font-size: 16px;
          margin: 20px 2px;
          cursor: pointer;
      }

      table {
          border-spacing: 0;
          border-collapse: separate;
          border-radius: 10px;
          border: 1px solid black;
      }

      table th,
      table td {
          border: 1px solid black;
      }

      table th,
      table td {
          padding-inline: 1em;
      }
      .informacion{
        display: flex;
        gap:10px;
      }
      .fecha{
        color:rgb(51, 51, 246);
      }
      .comentario{
        border: 1px solid black;
        padding: 10px;
        margin: 10px 0;
        border-radius: 10px;
      }
  </style>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Control de citas') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900">
                {{-- <h2>ID PACIENTE: {{$id}}</h2> --}}
                <h2 class="nombre"></h2>
                <button style="display: block" id="triggerComentarios">Prueba btn</button>
                <br>
                <table>
                    <tr>
                        <th class='header_title'>Fecha Paciente</th>
                        <th class='header_title'>Peso</th>
                        <th class='header_title'>IMC</th>
                        <th class='header_title'>Masa grasa corporal (kg)</th>
                        <th class='header_title'>% grasa corporal</th>
                        <th class='header_title'>Masa muscular (kg)</th>
                        <th class='header_title'>Agua corporal</th>
                        <th class='header_title'>Circunferencia de cintura</th>
                        <th class='header_title'>Circunferencia de cadera</th>
                        <th class='header_title'>Fecha próxima cita</th>
                    </tr>
                    <tbody class="datos_control_citas">
                        
                    </tbody>
                </table>
                <br>
                <br>
                <button class="comentarios-btn">Mostrar comentarios</button>
                <br>
                <div class="comentarios">
                  
                      
                </div>
                      {{-- contenedor --}}
                      <form id="comentarioForm" action="{{route('agregar_comentario')}}" method="POST">
                        @csrf
                        <input type="hidden" id="id_paciente" name="id_paciente">
                        <input type="text" id="comentario" name="comentario">
                        <input type="submit" value="Agregar comentario" class="agregar-alumno"/>
                      </form>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>

<script>
  let id = {{$id}};
  let mostrarComentariosBtn = document.querySelector('.comentarios-btn');
  let comentarios = document.querySelector('.comentarios');
  let nombre = document.querySelector('.nombre');
  let triggerComentarios = document.getElementById('triggerComentarios');
  const url = `/director/controlCitas/${id}`;
  const datos_control_citas = document.querySelector('.datos_control_citas');
  let id_paciente;
  fetch(url)
  .then(response => response.json())
  .then(data => {
    id_paciente = data.data[0].id_paciente;
      document.getElementById('id_paciente').value = id_paciente; 
      nombre.innerHTML = `Nombre: ${data.data[0].nombre}`;
      data.data.forEach(dato => {
          const tr = document.createElement('tr');
          tr.innerHTML = `
              <td>${dato.fecha_cita}</td>
              <td>${dato.peso}</td>
              <td>${dato.IMC}</td>
              <td>${dato.masa_grasa_corporal}</td>
              <td>${dato.porcentaje_grasa_corporal}</td>
              <td>${dato.masa_muscular_kg}</td>
              <td>${dato.agua_corpolar}</td>
              <td>${dato.circunferencia_cintura}</td>
              <td>${dato.circunferencia_cadera}</td>
              <td>${dato.fecha_prox_cita}</td>
          `;
          datos_control_citas.appendChild(tr);
      });
  });

  triggerComentarios.addEventListener('click', () => {
    fetch(`/director/comentario/${id_paciente}`)
    .then(response => response.json())
    .then(data => {
      mostrarComentariosBtn.innerHTML = `Mostrar comentarios (${data.data.length})`;
      //limpia el contenedor antes de agregar los nuevos comentarios
      comentarios.innerHTML = '';
      let html = '';
      data.data.forEach(item => {
          console.log(item.comentario);
          html += `
            <div class="comentario">
              <div class="informacion">
                <h4>COMENTARIO:</h4>
              </div>
              <p>${item.comentario}</p>
            </div>
          `;
        });
        comentarios.innerHTML = html;
    });
  });

  setTimeout(() => {
    triggerComentarios.click();
  }, 500);

</script>