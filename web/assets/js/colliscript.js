$(document).ready(function () {
  $('#data_table_simple').DataTable({
    "language": {
      "url": "../../assets/datatable/language/spanish.json"
    }
  });

  $(document).on('click', '.colli_ajax_modal', function () {
    var contenido = jQuery(this).attr('data-destino');
    var url = jQuery(this).attr('data-href');

    var contenido = jQuery(this).attr('data-destino');
    var url = jQuery(this).attr('data-href');

    jQuery(contenido).modal('show', {backdrop: 'static'});
    jQuery(contenido).on('hidden.bs.modal', function () {
      jQuery(contenido + ' .modal-content').html('Cargando Información ...');
    });
    jQuery.ajax({
      type: 'GET',
      url: url,
      dataType: 'html',
      cache: false,
      beforeSend: function () {
      },
      complete: function () {
      },
      success: function (data) {
        jQuery(contenido + ' .modal-content').html(data);
      }
    });
  });
});