<script type="text/javascript">    
// Load the Visualization API and the piechart package.
    google.load('visualization', '1', {'packages':['corechart']});
      
    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);
    
    function drawChart() {
      var jsonData = $.ajax({
          url: "estadisticas_Data.php",
          dataType:"json",
          async: false
          }).responseText;
          
          
      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById('informe_general'));
      chart.draw(data, {width: 750, height: 400});
    }
</script> 
<script type="text/javascript">    
// Load the Visualization API and the piechart package.
    google.load('visualization', '1', {'packages':['corechart']});
      
    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);
    
    function drawChart() {
      var jsonData = $.ajax({
          url: "estadisticas_Data_clientes_pedidos.php",
          dataType:"json",
          async: false
          }).responseText;
          
          
      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById('informe_clientes_pedidos'));
      chart.draw(data, {width: 750, height: 400});
    }
</script> 
<script type="text/javascript">    
// Load the Visualization API and the piechart package.
    google.load('visualization', '1', {'packages':['corechart']});
      
    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);
    
    function drawChart() {
      var jsonData = $.ajax({
          url: "estadisticas_Data_masvistas_paginas.php",
          dataType:"json",
          async: false
          }).responseText;
          
          
      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById('informe_masvisitas_paginas'));
      chart.draw(data, {width: 750, height: 400});
    }
</script> 
<script type="text/javascript">    
// Load the Visualization API and the piechart package.
    google.load('visualization', '1', {'packages':['corechart']});
      
    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);
    
    function drawChart() {
      var jsonData = $.ajax({
          url: "estadisticas_Data_masvistas_noticias.php",
          dataType:"json",
          async: false
          }).responseText;
          
          
      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById('informe_masvisitas_noticias'));
      chart.draw(data, {width: 750, height: 400});
    }
</script> 


<h2>Estadísticas</h2><br />
<p class="semillas">Inicio > Estadísticas</p><br />

    

<h3>Informe general de contenido dentro del gestor</h3>
    <!--Div that will hold the pie chart-->
    <div id="informe_general"></div>  
    <br />
    
<h3>Informe general de clientes y pedidos</h3>
    <!--Div that will hold the pie chart-->
    <div id="informe_clientes_pedidos"></div>  
    <br />

<h3>Las páginas más vistas</h3>
    <!--Div that will hold the pie chart-->
    <div id="informe_masvisitas_paginas"></div>  
    <br />
    
<h3>Las noticias más vistas</h3>
    <!--Div that will hold the pie chart-->
    <div id="informe_masvisitas_noticias"></div>
    <br />
    
    
