<!DOCTYPE html>
<html>
  <head>
  <style>
    * {
      font-size: 12px;
      font-family: 'Times New Roman';
    }

    td,
    th,
    tr,
    table {
      border-top: 1px solid black;
      border-collapse: collapse;
    }

    td.producto,
    th.producto {
      width: 75px;
      max-width: 75px;
    }

    td.precio,
    th.precio {
      width: 75px;
      max-width: 75px;
      word-break: break-all;
    }
    .centrado {
      text-align: center;
      align-content: center;
    }

    .ticket {
      width: 155px;
      max-width: 155px;
    }

    img {
      max-width: 150px;
      width: 150px;
    }
  </style>
  
  </head>
  <body>
    <div class="ticket">
      <img src="http://wificolombia.net/sitio/wp-content/uploads/2016/12/Logo_WiFiColombia.png" width="150px" alt="Logotipo">
      <p class="">
        Código Transacción: 
        <br>Cliente: %Cliente%
        <br>Cajero: %Cajero%
        <br>Fecha: %Fecha%
      </p>
      <table>
        <thead>
          <tr>
            <th class="producto">Plan</th>
            <th class="precio">Valor</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="centrado producto">%Plan%</td>
            <td class="centrado precio">%Valor%</td>
          </tr>
        </tbody>
      </table>
      <p class="">
        Líneas de atención y Soporte:
        <br>333 0 333 200 - 320 840 0756
      </p>
    </div>
  </body>
</html>