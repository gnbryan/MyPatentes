<?php $a = $_POST["nomb"]; ?>
<html>
  <head>
    <script src="http://www.google.com/jsapi" type="text/javascript"></script>
    <style type="text/css" media="screen">
      table {
        background-color: white;
        color: black;
        font-family: Arial, sans-serif;
        font-size: small;
      }
      
      .info {
        color: #676767;
      }
      
      #content {
        width:690px;
        margin:auto;
      }
    </style>
    <script src="http://ajax.googleapis.com/ajax/libs/prototype/1.6.0.2/prototype.js"></script>
    <title>Buscador de Patentes</title>
  </head>
  <body>
    <div id="content">
      <br/><br/>
      <div id="results" style="width:690px;padding:5px; 10px;"></div>
    </div>
    
    <script type="text/javascript" charset="utf-8">
    google.load('search', '1.0');

    var psearch = null;
    var searchform = null;

    function populateRestrict() {
      // Setup the select box for patent restriction
      var sel = document.getElementById('restrict');
      var types = [google.search.PatentSearch.TYPE_ISSUED_PATENTS,
                   google.search.PatentSearch.TYPE_APPLICATIONS,
                   google.search.PatentSearch.TYPE_ANY_STATUS];
      var typeNames = ['Patentes expedidas',
                       'Patentes registradas',
                       'Ambas'];
      for (var i=0; i < types.length; i++) {
        var option = document.createElement('option');
        option.value = types[i];
        option.innerHTML = typeNames[i];
        sel.appendChild(option);
      }
    }

    function populateSort() {
      // Setup the select box for sort restriction
      var sel = document.getElementById('sort');
      var types = [google.search.Search.ORDER_BY_RELEVANCE,
                   google.search.Search.ORDER_BY_DATE,
                   google.search.Search.ORDER_BY_ASCENDING_DATE];
      var typeNames = ['Ordenar por Relevancia',
                       'Ordenar por Fecha Descendente',
                       'Ordenar por Fecha Ascendente'];
      for (var i=0; i < types.length; i++) {
        var option = document.createElement('option');
        option.value = types[i];
        option.innerHTML = typeNames[i];
        sel.appendChild(option);
      }
    }

    function getSelVals() {
      var restrict = document.getElementById('restrict').value;
      var sort = document.getElementById('sort').value;
      return {'restrict' : restrict, 'sort' : sort};
    }

    function searchComplete(searcher) {
    // Aquí es donde generamos la salida de los resultados. Las propiedades
       // Disponible aquí son cosas como:
       // Searcher.results [i]. UnescapedUrl
       // Searcher.results [i]. Título
       // Buscar la lista completa aquí http://code.google.com/apis/ajaxsearch/documentation/reference.html # _class_GpatentResult
      var results = document.getElementById('results');
      var table = document.createElement('table');
      var tbody = document.createElement('tbody');

      results.innerHTML = '';
      for (var i=0; i < searcher.results.length; i++) {
        var tr = document.createElement('tr');
        //var td1 = document.createElement('td');
        var td2 = document.createElement('td');
        
        var thumbLink = document.createElement('a');
        var thumb = document.createElement('img');
        thumb.style.border = '1px solid #7777CC';
        thumbLink.href = searcher.results[i].unescapedUrl;
        thumb.src = searcher.results[i].tbUrl;
        thumb.width = '75';
        thumb.height = '100';
        thumbLink.className = 'lbOn';
        thumbLink.appendChild(thumb);
        //td1.appendChild(thumbLink);
        
        var linkContainer = document.createElement('div');
        var link = document.createElement('a');
        linkContainer.style.height =  '1.3em';
        linkContainer.style.overflow = 'hidden';
        td2.style.verticalAlign = 'top';
        td2.style.padding = '10px 15px 15px';
        td2.style.textAlign = 'left';
        link.href = searcher.results[i].unescapedUrl;
        link.className = 'lbOn';
        link.innerHTML = searcher.results[i].titleNoFormatting;
        linkContainer.appendChild(link);
        
        var info = document.createElement('div');
        info.className = 'info';
        if(searcher.results[i].patentStatus == 'issued') {
          info.innerHTML = 'U.S. Pat. ';
        } else {
          info.innerHTML = 'U.S. Pat. App ';
        }
        
        var date = new Date(searcher.results[i].applicationDate).toUTCString();
        var day = date.match(/[\d]{2}/);
        var month = date.match(/[a-zA-Z]{3}[ ]{1}/g);
        var year = date.match(/[\d]{4}/);

        date.toLocaleString().match(/[a-zA-Z]* [\d]* [\d]{4}/);
        info.innerHTML += searcher.results[i].patentNumber;
        info.innerHTML += ' - ' + month + day + ', ' + year;


        if (searcher.results[i].assignee) {
          info.innerHTML += ' - ' + searcher.results[i].assignee;
        }

        var snippet = document.createElement('div');
        snippet.innerHTML = searcher.results[i].content;

        td2.appendChild(linkContainer);
        td2.appendChild(info);
        td2.appendChild(snippet);
        
        //tr.appendChild(td1);
        tr.appendChild(td2);
        
        tbody.appendChild(tr);
      }
      table.appendChild(tbody);
      results.appendChild(table);
    }

    function load() {
      populateRestrict();
      populateSort();
      
      searchform = new google.search.SearchForm(false, document.getElementById('searchForm'));
    // Establecer, así que cuando se hace clic en el formulario que llama formSubmit, que se
       // Crea el psearch ejecutar la búsqueda
      searchform.setOnSubmitCallback(this, formSubmit);

      psearch = new google.search.PatentSearch();
      psearch.setResultSetSize(google.search.Search.LARGE_RESULTSET);
    // Establecer la devolución de llamada de modo que cuando los resultados se obtendrán en una búsqueda
       // Podemos generar la salida para ellos
      psearch.setSearchCompleteCallback(this, searchComplete, [psearch]);
      
      // Busqueda por defecto
      searchform.input.value = '<?php echo $a; ?>';
      psearch.execute('<?php echo $a; ?>');
    }

    function formSubmit(form) {
      var svals = getSelVals();
      psearch.setRestriction(google.search.Search.RESTRICT_TYPE, svals.restrict);
      psearch.setResultOrder(svals.sort);
      psearch.execute(form.input.value);
    }

    google.setOnLoadCallback(load);
    </script>
  </body>
</html>