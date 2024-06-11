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
                <button>Mostrar comentarios</button>
                <br>
                <div class="comentarios">
                  <div class="comentario">
                    <div class="informacion">
                      <h4>Nombre del nutriologo</h4>
                      <p class="fecha">9 mayo, 2024</p>
                      </div>
                      <p>El paciente necesita mejorar su grasa corporal</p>
                    </div>
                      
                </div>
                      {{-- contenedor --}}
                      <input type="submit" value="Agregar comentario" class="agregar-alumno"/>
                    <form action="">
                      <input type="text" name="" id="">
                    </form>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>

<script>
  let id = {{$id}};
  let nombre = document.querySelector('.nombre');
  const url = `/director/controlCitas/${id}`;
  const datos_control_citas = document.querySelector('.datos_control_citas');

  fetch(url)
  .then(response => response.json())
  .then(data => {
      console.log(data)
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
</script>