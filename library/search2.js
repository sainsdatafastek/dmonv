 var $rows = $('#fbody tr');
     $('#search').keyup(function() {
         var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();

         $rows.show().filter(function() {
             var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
             return !~text.indexOf(val);
         }).hide();
     });

	 $('#FID_PELANGGAN').change(function() {
         var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
         $rows.show().filter(function() {
             var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
             return !~text.indexOf(val);
         }).hide();
     });