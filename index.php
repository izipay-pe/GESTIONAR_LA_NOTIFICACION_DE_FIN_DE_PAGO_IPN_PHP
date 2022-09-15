<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Notificaciones - IPN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.3.0/highlight.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
      function plantilla(atributo, valor){
        return `<p class='mb-1 text-light'><span class='text-info'>${atributo}: </span>${valor}</p>`;
      }
      $('pre code').each(function(i, block) {
        let json = JSON.parse(block.textContent);
        let content = this.parentElement.parentElement.parentElement;
        let html = "";

        Object.entries(json).forEach(([key, value]) => {
          html += plantilla(key,value)
        });
        if(json.hasOwnProperty('kr-answer')){
          content.children[0].firstElementChild.textContent = "API REST "
        }else{
          content.children[0].firstElementChild.textContent = "Formulario API V1, V2 "
        }
        this.outerHTML = html;
      });
    });
</script>
</head>
<body>
  <h2 class="text-center my-1">Notificaciones IPN</h2>

  <table class="table table-hover container mt-3">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Notificación</th>
        <th scope="col">Date</th>
        <th scope="col">...</th>
      </tr>
    </thead>
    <tbody>
      <?php
          $theFolder = "respuestasIPN/";

          if($handler = opendir($theFolder)){
            $count = 0;
            while(false !== ( $file = readdir($handler))){
              if($file !== "." && $file !== ".."){
                $count++;
                $archivo = file_get_contents($theFolder.$file);
                echo "<tr>
                        <th scope='row'>$count</td>
                        <td><a href='respuestasIPN/$file' target='_blank'>$file</td></a>
                        <td>".date("F d Y H:i:s.", filectime("respuestasIPN/$file"))."</td>
                        <td>
                          <button type='button' class='btn btn-danger' style='background-color:#FF4240' data-bs-toggle='modal' data-bs-target='#exampleModal$count' value='$file'>
                            Mostrar respuesta
                          </button>
                        </td>
                      </tr>
                      <div class='modal fade' id='exampleModal$count' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                        <div class='modal-dialog modal-dialog-scrollable'>
                          <div class='modal-content'>
                            <div class='modal-header btn-danger' style='background-color:#FF4240' >
                              <h5 class='modal-title text-light' id='exampleModalLabel'></h5>
                              <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <div class='modal-body bg-dark p-3'>
                            <pre><code class='json'>".$archivo."</code></pre>
                            </div>
                            <div class='modal-footer btn-danger' style='background-color:#FF4240' >
                              <button type='button' class='btn btn-success text-light' style='background-color:#00a09d' data-bs-dismiss='modal'>Close</button>
                            </div>
                          </div>
                        </div>
                      </div>"
                ;
              }
            }
            closedir($handler);
          }
      ?>
    </tbody>
  </table>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

</body>
</html>