jQuery('select').on('change', function() {
    
    if(this.value == 'Vendedor') {
        $(".passwd-form").hide();
    } else {
        $(".passwd-form").show();
    }

});

$('#cant').on('change', function() {

    product_id = $('#idProducto').val();    
    modify_element($('#cant').val(), product_id); 

});

function modify_element(quantity_selected, product_id) {

  cell = $('#product-table-sell .change-on-decrement-' + product_id + '');
  cellvalue = cell.html().trim();
  original_value = cell.attr('original_quantity'); 
   
  if(quantity_selected != '') {

     operation = parseInt(original_value) - parseInt(quantity_selected);
     if(operation < 0 || operation > original_value) {
       id = $('#idProducto').val();   
       alert("Cantidad requerida del producto " + id + " no es posible");
       $('#cant').val('');   
     } else {
       cell.html(operation);  
     }
     
  }  else cell.html(original_value); 

}

$(function () {
    var previous;

    $("#idProducto").on('focus', function () {
        previous = this.value;
    }).change(function() {
 
        cell = $('#product-table-sell .change-on-decrement-'+previous+'');
        cell.html(cell.attr('original_quantity'));
        $('#cant').val('');

    });
}); 

/* 
  Colocamos en el input de cantidad en la vista orden del vendedor, la cantidad del producto
  elegido por su id
*/
$("#idProducto").click(function() { 
   previous = this.value; 
   c = $('.change-on-decrement-'+previous+'').html();            
   $('#cant').val(parseInt(c)); 
});

/*Se muestra al cliente y su ciudad según su id*/
$("#idCliente").on('change', function() {

   var element = $(this).find('option:selected');
   var myTag = element.attr("nombre_persona");
   $('#cliente').val(myTag);

});

$("#idCliente").on('change', function(){

   var element = $(this).find('option:selected');
   var myTag = element.attr("ciudad_persona");
   $('#ciudad').val(myTag); 

}); 

// Agregar los datos del cliente en un popup
$('#btn-pop').click(function() {

  $('#nom_pop').val($('#cliente').val());
  $('#ciudad_pop').val($('#ciudad').val());
  if($('#idCliente').val() == "Registrar cliente") $('.num_pop').hide();
  else { $('.num_pop').show(); $('#idcli_pop').val($('#idCliente').val()); }

});
